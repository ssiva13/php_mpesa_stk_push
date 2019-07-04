<?php

$consumerKey = "963uNSjDSnR0NzNwvlRELgThojI1PIle";
$consumerSecret = "S2wqt7aPv2M1JhSw";


$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$curl_access_token = curl_init($access_token_url);

curl_setopt($curl_access_token, CURLOPT_URL, $access_token_url);
$credentials = base64_encode($consumerKey. ':' .$consumerSecret);

//setting a custom header
$header = ['Authorization: Basic '.$credentials];

curl_setopt($curl_access_token, CURLOPT_HTTPHEADER, $header); 
curl_setopt($curl_access_token, CURLOPT_HEADER, false);
curl_setopt($curl_access_token, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_access_token, CURLOPT_SSL_VERIFYPEER, false);

$curl_access_token_response = curl_exec($curl_access_token);

$result =  json_decode($curl_access_token_response);

$token = $result->access_token;
//echo $token. "\n";
curl_close($curl_access_token);

?>