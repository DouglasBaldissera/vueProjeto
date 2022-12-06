<?php
class Model
{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'testingdb';
    private $conn;
 
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
 
    public function store($name, $email)
    {
        $stmt = $this->conn->prepare("INSERT INTO `vueuser` (`name`, `email`) VALUES ('$name', '$email')");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findAll()
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `vueuser` ORDER BY `id` ASC");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
 
        return $data;
    }
 
    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `vueuser` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findOne($id)
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `vueuser` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
 
        return $data;
    }
 
    public function update($id, $name, $email)
    {
        $stmt = $this->conn->prepare("UPDATE `vueuser` SET `name` = '$name', `email` = '$email' WHERE `id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
}