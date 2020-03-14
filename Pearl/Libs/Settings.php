<?php

namespace Pearl\Libs;

use Pearl\Models\Website\Setting;

class Settings
{
    private static $data;

    public static function init(): void
    {
        self::$data = Setting::all()->pluck('value','key')->toArray();
    }

    public static function getSettings(): array
    {
        return self::$data;
    }

    public static function getData(string $key): ?string
    {
        return self::$data[$key] ?? null;
    }
}