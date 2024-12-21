<?php

ini_set('display_errors',1);
ini_set('error_reporting',1);

session_start();

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'helpers.php';
