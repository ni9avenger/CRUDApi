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
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        parse_str(file_get_contents("php://input"),$data);
        $sql = "INSERT INTO $table_name VALUES (null,'{$data['name']}','{$data['price']}','{$data['description']}')";
        $rs = mysqli_query($conn,$sql);
        if($rs > 0){
            http_response_code(201);
            echo json_encode(array("message" => "Product was created.", "type" => "success"));        
        }else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create product.", "type" => "warning"));        
        }
        break;
    case "put":
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        parse_str(file_get_contents("php://input"),$data);
        $sql = "UPDATE $table_name SET name = '{$data['name']}',price = '{$data['price']}',description = '{$data['description']}' WHERE id = '{$data['id']}'";
        $rs = mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            http_response_code(200);
            echo json_encode(array("message" => "Product was updated.", "type" => "success"));        
        }else{
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update product.", "type" => "warning"));        
        }
        break;
    case "delete":
    default:
        
}