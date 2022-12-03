<?php

class Phase{
    private $db;
    function __construct($conn){
        $this->db = $conn;
    }

    // get all phase
    public function getPhases(){
        try {
            $sql = "select title,dateDebut,dateFin from phase where YEAR(dateFin)=YEAR(CURRENT_DATE)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addPhase($data){
        try{
            $sql="INSERT INTO phase(title,descreption,dateDebut,dateFin) values(:title,:Desc,:dateD,:dateF)";
            $smt=$this->db->prepare($sql);
            $smt->bindparam(':title',$data['title']);
            $smt->bindparam(':Desc',$data['descreption']);
            $smt->bindparam(':dateD',$data['ddebut']);
            $smt->bindparam(':dateF',$data['dfin']);
            
            $smt->execute();
            return true;
            
        }catch(PDOException $e){
            echo $e->getMessage().' <br> ligne '.$e->getLine();
            return false;
        }
    }
}