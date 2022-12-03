<?php

class Departement{

    private $db;

    function __construct($conn){
        $this->db = $conn;
    }

    public function getAllDepartement(){
        try{
            // intitule + ID car on va utiliser ID dans select options
            $sql="select * from deparetement";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage().' <br> ligne '.$e->getLine();
            return false;
        }
    }
}