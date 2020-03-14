<?php

use Pearl\Core;
include 'Settings.php';
include CWD . '/vendor/autoload.php';
$core = new Core();
$core->getRoute()->renderPage();


