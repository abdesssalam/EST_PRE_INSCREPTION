<?php

class Phase{
    private $db;
    function __construct($conn){
        $this->db = $conn;
    }

    // list principale

    public function get_list_principale($fl){
        try{

            //get nombre max de felier
            $sql = "SELECT nbMax from felier WHERE IDFelier=:F";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam("F", $fl, PDO::PARAM_INT);
            $stmt->execute();
            $fll= $stmt->fetch();
            //get type bac associated with this feilier
            $sql1 = "select IDType,nb from filiertypebac where IDFelier=:FL";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("FL", $fl, PDO::PARAM_INT);
            $stmt1->execute();
            $row1= $stmt1->fetchAll();

            /**
             * SELECT e.CNE,ut.nom,ut.prenom ,t.initiule as bac ,fl.intitilue as felier from etudiant as e JOIN utilisateur as ut on e.IDEtudiant=ut.idUser JOIN bac as b on b.IDEtudiant=e.IDEtudiant join typebac as t on t.IDType=b.type JOIN insception AS ic on ic.IDEtidiant=e.IDEtudiant JOIN felier as fl on fl.IDFelier=ic.IDFelier WHERE ic.IDFelier=1 and b.type=1 order by b.NoteNational
             */
            $res = array();
            
            for($i=0; $i<count($row1);$i++){
                $fb = $row1[$i];
                $nbr = floor( $fll['nbMax']*($fb['nb']/100));
                $sql = "SELECT fl.IDFelier, e.IDEtudiant, e.CNE,ut.nom,ut.prenom ,t.initiule as bac ,fl.intitilue as felier from etudiant as e JOIN utilisateur as ut on e.IDEtudiant=ut.idUser JOIN bac as b on b.IDEtudiant=e.IDEtudiant join typebac as t on t.IDType=b.type JOIN insception AS ic on ic.IDEtidiant=e.IDEtudiant JOIN felier as fl on fl.IDFelier=ic.IDFelier WHERE ic.admis=0 AND ic.IDFelier=:F and b.type=:T order by b.noteG  DESC limit {$nbr}";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('T', $fb['IDType'], PDO::PARAM_INT);
                $stmt->bindParam('F', $fl, PDO::PARAM_INT);
                $stmt->execute();
                $res =array_merge($res, $stmt->fetchAll());
                
            };
                //get admis choix 1
            return $res;

        }catch(PDOException $e){
            echo $e->getMessage() . '--- line :' . $e->getLine();
            return false;
        }
    }

    public function get_list_att($fl){
        //get nombre max de felier
        $sql = "SELECT nbMax from felier WHERE IDFelier=:F";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("F", $fl, PDO::PARAM_INT);
        $stmt->execute();
        $fll= $stmt->fetch();

        $sql1 = "select IDType,nb from filiertypebac where IDFelier=:FL";
        $stmt1 = $this->db->prepare($sql1);
        $stmt1->bindParam("FL", $fl, PDO::PARAM_INT);
        $stmt1->execute();
        $row1= $stmt1->fetchAll();
        
        $res = array();
            
            for($i=0; $i<count($row1);$i++){
                $fb = $row1[$i];
           
                $nbr = floor( $fll['nbMax']*($fb['nb']/100));
              
                
                $sql = "SELECT e.CNE,ut.nom,ut.prenom ,t.initiule as bac ,fl.intitilue as felier from etudiant as e JOIN utilisateur as ut on e.IDEtudiant=ut.idUser JOIN bac as b on b.IDEtudiant=e.IDEtudiant join typebac as t on t.IDType=b.type JOIN insception AS ic on ic.IDEtidiant=e.IDEtudiant JOIN felier as fl on fl.IDFelier=ic.IDFelier WHERE ic.admis=0 AND ic.IDFelier=:F and b.type=:T order by b.noteG  DESC";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam('T', $fb['IDType'], PDO::PARAM_INT);
                $stmt->bindParam('F', $fl, PDO::PARAM_INT);
                $stmt->execute();
                $resq = $stmt->fetchAll();
        
                $resq = array_slice($resq, $nbr);
                
                $res =array_merge($res, $resq);
                
            };
                //get admis choix 1
        
            return $res;

    }
    
}