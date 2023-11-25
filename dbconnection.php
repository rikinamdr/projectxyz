<?php
/**
 * requirement
 * -Appache
 * MySQL
 */
$host = 'localhost';
$dbuser = 'root';
$dbpwd = '';
$dbname = 'db_project';

$connc = new mysqli($host, $dbuser, $dbpwd, $dbname );
if (!$connc){
    die ("Database connection error");
}