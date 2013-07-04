<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set("error_log", "error.log");
include 'config.php';
require 'mysql_breakdown/mysql_breakdown_my.php';

$x = new mysql_breakdown_my($_MYSQL["host"], $_MYSQL["port"], $_MYSQL["user"], $_MYSQL["pass"], $_MYSQL["db"]);
$x->breakdown();