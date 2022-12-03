<?php

class Filier{
    private $db;

    function __construct($conn){
        $this->db = $conn;
    }

    // get all filiers

    public function getAllFiliers(){
        try{
            $sql="SELECT F.IDFelier,F.intitilue as filier ,D.intitilue as dep, F.nbMax from felier as F JOIN deparetement as D on F.IDDept=D.IDDept";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage().' <br> ligne '.$e->getLine();
            return false;
        }
        
    }

    public function getFilierByID($id){
        try{
            $sql="select * from felier where IDFelier=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id',$id);
            $stmt->execute();
            $result = $stmt->fetch();
            
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage().' <br> ligne '.$e->getLine();
            return false;
        }
    }
    // add new filier

    public function addFilier($data){
        try{
            $sql="INSERT INTO felier(intitilue,IDDept,nbMax) values(:intitule,:Dep,:nbMax)";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':intitule',$data['label']);
            $smt->bindParam(':Dep',$data['departement']);
            $smt->bindParam(':nbMax',$data['NB_MAX'],PDO::PARAM_INT);
            $smt->execute();
            return true;
            
        }catch(PDOException $e){
            echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium">'.$e->getMessage().'</span> 
          </div>';
           
            return false;
        }
    }

    //update filier

    public function editFilier($id,$data){
        try{
            $sql="UPDATE  felier SET intitilue=:intitule,IDDept=:Dep,nbMax=:nbMax WHERE IDFelier=:id";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':intitule',$data['label']);
            $smt->bindParam(':Dep',$data['departement'],PDO::PARAM_INT);
            $smt->bindParam(':nbMax',$data['NB_MAX'],PDO::PARAM_INT);
            $smt->bindParam(':id',$id,PDO::PARAM_INT);
            $smt->execute();
            return true;
            
        }catch(PDOException $e){
            echo '<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium">'.$e->getMessage().'</span> 
          </div>';
           
            
            echo $e->getMessage().' <br> ligne '.$e->getLine();
            return false;
        }
    }


}