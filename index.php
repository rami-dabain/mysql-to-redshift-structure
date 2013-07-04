<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set("error_log", "error.log");
include 'config.php';
require 'mysql_breakdown/mysql_breakdown_my.php';

$tablesToCopy = array(
    'customer',
    'customer_wishlist',
    'newsletter_subscription',
    'sales_order',
    'sales_order_item',
    'catalog_simple',
    'catalog_config',
    'catalog_brand',
    'catalog_category',
    'catalog_stock',
    'cod_location',
);

$myTables = new mysql_breakdown_my($_MYSQL["host"], $_MYSQL["port"], $_MYSQL["user"], $_MYSQL["pass"], $_MYSQL["db"]);
$myTables->setTables($tablesToCopy);
$tables = $myTables->breakdown();

$rs = pg_connect("host=" . $_PGSQL["host"] . " port=" . $_PGSQL["port"] . " dbname=" . $_PGSQL["db"] . " user=" . $_PGSQL["user"] . " password=" . $_PGSQL["pass"] . "") or die("Could not connect to RedShift --> " . pg_last_error($rs));
$success = 0;
$failure = 0;

foreach ($tables as $table) {
    $table->convert('mysql', 'redshift');
    $query = $table->buildQuery('"');
    try {
        $result = @pg_query($rs, "DROP TABLE " . $table->table_name);
    } catch (Exception $e) {
        
    }
    $result = pg_query($rs, $query);
    if (!$result) {
        error_log(' ******** RedShift query failed ******** ' . "\n\n" . $query);
        $failure++;
    } else {
        $success++;
    }
}


