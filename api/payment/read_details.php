<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type, X-Requested-With, Authorization');

include_once '../../config/database.php';
include_once '../../model/malipo.php';


$database = new Database();
$db = $database->connect();

$payment = new Malipo($db);

$result = $payment->read_details();

$num = $result->rowCount();

$row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);

    //echo $CallBackURL;