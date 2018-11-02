<?php

include "includes/connection.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$table_name = isset($_REQUEST['t']) ? $_REQUEST['t'] : '';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$request_method = strtolower($_SERVER['REQUEST_METHOD']);

switch($request_method){
    case "get":
        if($id != 0){
            $sql = "SELECT * FROM $table_name WHERE id = '$id'";
            $rs = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
            if(sizeof($rs) > 0)
                echo json_encode($rs);
            else
                echo json_encode(array("message" => "No products found."));
        }else{
            $sql = "SELECT * FROM $table_name";
            $rs = mysqli_fetch_all(mysqli_query($conn,$sql),MYSQLI_ASSOC);
            echo json_encode($rs);
        }
        break;
    case "post":
    case "put":
    case "delete":
    default:
        
}