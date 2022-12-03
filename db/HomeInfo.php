<?php

class HomeInfo{

    private $db;

        //constructor pour initialiser db pour acceder a la base de donnes
    function __construct($conn){
        $this->db = $conn;
    }

    //get all villes
    public function getVilles(){
        try{
            $sql = "select id,ville from ville";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }
    //get all villes by Region
    public function getVillesByRegion($region){
        try{
            $sql = "select id,ville from ville  WHERE region=:r";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":r", $region,PDO::PARAM_INT );
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }
    //get all Regions
    public function getRegions(){
        try{
            $sql = "select id,region from region";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }
    //get all TypeBac
    public function getTypeBac(){
        try{
            $sql = "select IDType,initiule from typebac";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }



}