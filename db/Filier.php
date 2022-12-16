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

    public function editFilier($data){
        try{
            $sql="UPDATE  felier SET intitilue=:intitule,IDDept=:Dep,nbMax=:nbMax WHERE IDFelier=:id";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':intitule',$data['label']);
            $smt->bindParam(':Dep',$data['departement'],PDO::PARAM_INT);
            $smt->bindParam(':nbMax',$data['NB_MAX'],PDO::PARAM_INT);
            $smt->bindParam(':id',$data['edit'],PDO::PARAM_INT);
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
    public function deleteFilier($data){
        try{
            $sql="DELETE FROM insception WHERE IDFelier=:id";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':id',$data['edit'],PDO::PARAM_INT);
            $smt->execute();
            $sql="DELETE FROM filiertypebac WHERE IDFelier=:id";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':id',$data['edit'],PDO::PARAM_INT);
            $smt->execute();
            $sql="DELETE FROM felier WHERE IDFelier=:id";
            $smt=$this->db->prepare($sql);
            $smt->bindParam(':id',$data['edit'],PDO::PARAM_INT);
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

    public function add_filier_bac($data){
        try{
            $sql = "INSERT INTO filiertypebac(IDFelier,IDType,nb) VALUES(:F,:T,:N)";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":F", $data['filier'], PDO::PARAM_INT);
            $stmt->bindParam(":T", $data['type'], PDO::PARAM_INT);
            $stmt->bindParam(":N", $data['NB'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage() . '--- line :' . $e->getLine();
        }
    }
    public function edit_filier_bac($data){
        try{
            $sql = "UPDATE filiertypebac set nb=:N where IDFelier=:F and IDType=:T";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":F", $data['filier'], PDO::PARAM_INT);
            $stmt->bindParam(":T", $data['type'], PDO::PARAM_INT);
            $stmt->bindParam(":N", $data['NB'], PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage() . '--- line :' . $e->getLine();
        }
    }

    public function get_filiersBac($filier){
        try{
        $sql = "select ft.IDFelier,tb.IDType,tb.initiule as bac,nb ,fl.intitilue as filier FROM filiertypebac as ft JOIN typebac  as tb on tb.IDType=ft.IDType join felier fl on fl.IDFelier=ft.IDFelier where ft.IDFelier=:ID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":ID", $filier, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage() . '--- line :' . $e->getLine();
        }
    }
    public function filter_choix_by_bac($idtype){
        try{
            $sql = "select IDFelier,intitilue as filier from felier WHERE IDFelier in (SELECT IDFelier from filiertypebac where IDType=:T)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":T", $idtype, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }

    public function get_filierTypeBac_by_bac_dut($bac,$filier){
        try{
            $sql = "select ft.IDFelier,tb.IDType,tb.initiule as bac,nb ,fl.intitilue as filier FROM filiertypebac as ft JOIN typebac  as tb on tb.IDType=ft.IDType join felier fl on fl.IDFelier=ft.IDFelier where ft.IDFelier=:F and ft.IDType=:T";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":F", $filier, PDO::PARAM_INT);
            $stmt->bindParam(":T", $bac, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }


}