<?php
define('DEBUG', true);

define('CWD', __DIR__);
define('INCLUDES', CWD . '/Pearl');
define('CACHE_DIR', CWD . '/Cache/');
define('VIEWS_DIR', INCLUDES . '/Views/');
define('LOGS_DIR', CWD . '/Logs/');
define('UPLOADS_DIR', '/assets/Uploads/');
define('JOBS_DIR', CWD . '/Crons/');
define('SITE_URL', 'http://127.0.0.1');
define('JOBS_URL', SITE_URL . '/runJob/');
define('ASE_URL', '/theallseeingeye');

define('ALLOWED_ASE_IPS', ['127.0.0.1', '::1', '0.0.0.0']);

define('PASS_BLOW', 'Odb9Gk4E9i8sAJLlgLMXZ1gpht4grzB7Sc6ZD1dDZbxalIBH');

define('MYSQL_SETTINGS', [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'testphpcidadao',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_general_ci',
    'prefix' => '',
]);
