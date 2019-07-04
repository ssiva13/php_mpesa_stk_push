<?php

class Malipo
{
    private $conn;
    private $table = 'payment_data';

    public $BusinessShortCode;
    public $passkey;
    public $TransactionType;
    public $CallBackURL;
    public $AccountReference;
    public $TransactionDesc;

    

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read_details(){
        

        $query = 'SELECT * FROM ' . $this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }
}
