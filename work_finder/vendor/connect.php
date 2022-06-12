<?php
function get_connection() : mysqli
{
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'work_finder';
    return new mysqli($host, $user, $pass, $db);
}

$mysqli = get_connection();

if(!$mysqli){
    die('Ошибка соединения'.mysqli_error($mysqli));
}