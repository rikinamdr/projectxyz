<?php

$db_server = "mysql";
$db_user = "root";
$db_pass = "root";
$db_name = "db_xyz";

try{
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name );
    
}catch(mysqli_sql_exception){
    echo "could not connect";
}

?>