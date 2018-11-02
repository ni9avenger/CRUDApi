<?php

include "includes/connection.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$table_name = isset($_REQUEST['t']) ? $_REQUEST['t'] : '';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

switch($request_method){
    case "get":
    case "post":
    case "put":
    case "delete":
    default:
        
}