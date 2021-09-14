<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
use Symfony\Config\MonologConfig;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$address = 'siilearningplatform.sii.pl';
$today = date("Y-m-d");
$time = date('H:i');

$logger = new Logger('status');
$logger->pushHandler(new StreamHandler('Status_Log_' . $today . '.log', Logger::DEBUG));

if (fsockopen($address, 80)) {
    $mesage = 'Ok: '.$address . ' with time: ' . $time;
    echo('Reports Online');
    $logger->critical($mesage);
} else {
    echo('Reports Offline');
    $logger->critical('No connection');
}
