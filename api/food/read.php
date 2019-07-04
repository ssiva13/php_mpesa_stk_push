<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type, X-Requested-With, Authorization');

include_once '../../config/database.php';
include_once '../../model/food.php';


$database = new Database();
$db = $database->connect();

$food = new Food($db);

$food->id = $_GET['id'];

if (isset($food->id)) {
    $food->read_single();
    $food_entry = array(
        "id" =>  $food->id,
        "name" => $food->name,
        'Amount' => $food->Amount
    );

    echo json_encode($food_entry);
} else {
    $result = $food->read();
    $num = $result->rowCount();


    $foods = array();
    $foods['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $food_entry = array(
            'id' => $id,
            'name' => $name,
            'Amount' => $Amount
        );

        array_push($foods['data'], $food_entry);
    }

    echo json_encode($foods);
}
