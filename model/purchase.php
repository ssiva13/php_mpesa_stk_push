<?php
class Purchase{
    private $conn;
    private $table = 'purchases';


    public $food_id;
    public $phone_number;
    public $Amount;
    public $food_name;
    
    public function __construct($db){
        $this->conn = $db;
    }

    public function readAll(){

        $query = 'SELECT * FROM ' . $this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
        SET
        Amount = :Amount,
        phone_number = :phone_number,
        food_name= :food_name,
        food_id = :food_id
        ';
        $stmt = $this->conn->prepare($query);

        $this->Amount = htmlspecialchars(strip_tags($this->Amount));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->food_id = htmlspecialchars(strip_tags($this->food_id));
        $this->food_name = htmlspecialchars(strip_tags($this->food_name));

        $stmt->bindParam(':Amount', $this->Amount);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':food_id', $this->food_id);
        $stmt->bindParam(':food_name', $this->food_name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


}