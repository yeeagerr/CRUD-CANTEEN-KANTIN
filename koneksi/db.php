<?php

$server = "localhost";
$user = "root";
$password = "";
$name = "db_kantin";

try {
    $conn = mysqli_connect($server, $user, $password, $name);
} catch (mysqli_sql_exception) {
    echo "Something went wrong";
}
