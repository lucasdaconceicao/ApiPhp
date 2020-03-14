<?php

namespace Pearl\Libs;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Collection;

class Cron
{

    public static function closeConnection(int $job): void
    {
        ignore_user_abort(true);
        set_time_limit(0);
        ob_end_clean();
        header('Connection: close');
        ignore_user_abort(true);
        ob_start();

        echo('Started cron ' . $job);

        $size = ob_get_length();
        header("Content-Length: $size");
        header('Content-Encoding: none');
        ob_end_flush();
        flush();
    }

    public static function runCron(): void
    {
        $jobs = Manager::table('crons')->where('enabled', 1)->orderBy('prio')->get();

        if ($jobs->isEmpty()) {
            return;
        }

        foreach ($jobs as $job) {
            if (self::getNextExec($jobs) <= time()) {
                self::asyncCurl(JOBS_URL . $job['id']);
            }
        }
    }

    private static function getNextExec(Collection $data): int
    {
        return $data['last_exec'] + $data['exec_every'];
    }

    private static function asyncCurl(string $url)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);  // Follow the redirects (needed for mod_rewrite)
        curl_setopt($c, CURLOPT_HEADER, false);         // Don't retrieve headers
        curl_setopt($c, CURLOPT_NOBODY, true);          // Don't retrieve the body
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);  // Return from curl_exec rather than echoing
        curl_setopt($c, CURLOPT_FRESH_CONNECT, true);   // Always ensure the connection is fresh
        curl_setopt($c, CURLOPT_NOSIGNAL, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 1);

        return curl_exec($c);
    }

    public static function executeJob(int $jobId): void
    {
        $file_name = Manager::table('crons')->where('id', 1)->get(['scriptfile'])->first();

        $path = JOBS_DIR . $file_name;

        if (!file_exists($path)) {
            echo "Could'nt execute cron $file_name";
            return;
        }

        include $path;

        Manager::connection()->update("UPDATE crons SET last_exec = ? WHERE id = ?", [$jobId]);
    }
}