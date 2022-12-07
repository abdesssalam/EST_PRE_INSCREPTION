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
            $sql = "select id,UPPER(ville) as ville from ville order by ville";
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
            $sql = "select id,region from region order by region";
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
    public function getTypeBacFiltred($ID){
        try{
            $sql = "select IDType,initiule from typebac WHERE IDType not in(SELECT IDType FROM filiertypebac WHERE IDFelier=:ID)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':ID',$ID,PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }
    

   public function filtredFiliers($id){
    try{
            $sql = "select IDFelier,intitilue from felier where IDFelier!=:ID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":ID",$id,PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
    }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
   }

   public function get_statistics(){
    try{
        $sql = "SELECT intitilue,COUNT(*) as NBR FROM felier as f JOIN  insception as ic on f.IDFelier=ic.IDFelier GROUP by intitilue";
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

   public function get_settings(){
    try{
        $sql = "SELECT s_key,label,type,val from settings";
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

   public function get_setting_value($key){
    try{
        $sql = "SELECT val from settings where s_key=:k";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":k", $key, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result; 
    }catch (PDOException $e) {
        echo $e->getMessage();
        echo $e->getLine();
        return false;
    }
   }

   public function update_settings($data){
    try{
            $settings = $this->get_settings();
            foreach($settings as $st){
              $sql = "update settings set val=:v where s_key=:k";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":v", $data[$st['s_key']],PDO::PARAM_STR);  
                $stmt->bindParam(":k", $st['s_key'],PDO::PARAM_STR);
                $stmt->execute();  
            }
            return true;
        
    }catch (PDOException $e) {
        echo $e->getMessage();
        echo $e->getLine();
        return false;
    }
   }

    



}