<?php

class Post{
    private $db;

    //constructor pour initialiser db pour acceder a la base de donnes
    function __construct($conn){
        $this->db = $conn;
    }

    function add($title,$ctc,$rate){
        try{
            $sql = "INSERT INTO POST (title,content,rate) VALUES (:t,:c,:r)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("t", $title, PDO::PARAM_STR);
            $stmt->bindParam("c", $ctc, PDO::PARAM_STR);
            $stmt->bindParam("r", $rate, PDO::PARAM_STR);
            $stmt->execute();
            return true;

        }catch (PDOException $e) {
                
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
    }
}