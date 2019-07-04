<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../config/database.php';
include_once '../../model/purchase.php';

$database = new Database();
$db = $database->connect();
$purchase = new Purchase($db);

//$data = json_decode(file_get_contents("php://input"));

if(empty($_POST['phone_number'])){
    echo json_encode(
        array('message' => 'Empty fields')
    );
    http_response_code(500);
}
else{
    


$purchase->phone_number = $_POST['phone_number'];
$purchase->food_id = $_POST['food_id'];
$purchase->Amount = $_POST['Amount'];
$purchase->food_name = $_POST['food_name'];



if($purchase->create()) {
    echo json_encode(
        array('message' => $purchase)
    );
    http_response_code(200);
    
} else {
    echo json_encode(
        array('message' => 'An error occurred')
    );
    http_response_code(500);
}

}