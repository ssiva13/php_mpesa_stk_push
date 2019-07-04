<?php


class Database
{
    //DB Params
    /******CHANGE THESE PARAMS AS PER YOUR ENVIRONMENT**********/
    private $host = 'localhost';
    private $db_name = 'mpesa_int';
    private $username = 'work';
    private $password = 'work';
    /******CHANGE THESE PARAMS AS PER YOUR ENVIRONMENT**********/

    private $conn;

    //DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          echo 'Connection failed: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
