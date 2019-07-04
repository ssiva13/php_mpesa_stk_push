<?php

//getting the access token-----------------------------------------------------------
require_once('accesstoken.php');


//call express api-------------------------------------------------------------------------
$initiate_stk_push_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';


//getting the payment variables------------------------------------------------------
include_once('read_details.php');

//getting the timestamp format

$Timestamp = date('YmdHis'); 
//$Timestamp = '20180409093002';

//encoding the password string from database
$passwordstring = $BusinessShortCode.$passkey.$Timestamp;
$password = base64_encode($passwordstring);

// get the callback url

//$CallBackURL = "http://localhost/mpesa/callback/callback.php";
$CallBackURL = "https://crime-lex.org/database/callback.php";
//$data = json_decode(file_get_contents("php://input"));

//get
//$phone_number = $data->phone_number;
//$Amount = $data->Amount;

$Amount = $_POST['Amount'];
$phone_number = $_POST['phone_number'];

if(empty($phone_number)){
  echo "Missing Phone Number";
}
if(empty($Amount)){
  echo "\nAmount Missing \n";
}
else{
//setting custom header
$stkheader = ['Content-Type:application/json','Authorization:Bearer '.$token];

$curl = curl_init($initiate_stk_push_url);
curl_setopt($curl, CURLOPT_URL, $initiate_stk_push_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); 


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => $BusinessShortCode,
  'Password' => $password,
  'Timestamp' => $Timestamp,
  'TransactionType' => $TransactionType ,
  'Amount' => $Amount,
  'PartyA' => $phone_number,
  'PartyB' => $BusinessShortCode,
  'PhoneNumber' => $phone_number,
  'CallBackURL' => $CallBackURL,
  'AccountReference' => $AccountReference,
  'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
//echo "\n".$data_string. "\n";

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
//print_r($curl_response);

echo $curl_response;
//curl_close($initiate_stk_push_url);
}
