<?php

class Phase{
    private $db;
    function __construct($conn){
        $this->db = $conn;
    }

    // list principale

    public function get_list_principale($fl){
        try{
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
                $sql = "SELECT e.CNE,ut.nom,ut.prenom ,t.initiule as bac ,fl.intitilue as felier from etudiant as e JOIN utilisateur as ut on e.IDEtudiant=ut.idUser JOIN bac as b on b.IDEtudiant=e.IDEtudiant join typebac as t on t.IDType=b.type JOIN insception AS ic on ic.IDEtidiant=e.IDEtudiant JOIN felier as fl on fl.IDFelier=ic.IDFelier WHERE ic.IDFelier=:F and b.type=:T order by b.noteG limit {$fb['nb']}";
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
    
}