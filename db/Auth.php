<?php

class Auth{


     // database object
     private $db;

     //constructor pour initialiser db pour acceder a la base de donnes
     function __construct($conn){
         $this->db = $conn;
     }

    //  login
     public function login($data){
        try{
            $sql="select idUser,role,password from utilisateur where email=?";
            $stm=$this->db->prepare($sql);
            $stm->bindValue(1,$data['email'],PDO::PARAM_STR);
            $stm->execute();
            $result=$stm->fetch();
            if($result){
                if(password_verify($data['password'],$result['password'])){
                $user = array("idUser" => $result['idUser'],"role"=>$result['role']);
                 return $user;
            }
            }
            
        } catch (PDOException $e) {
                echo $e->getMessage().'<br>';
                echo $e->getLine();
                return false;
        }
     }

     //get user info
     public function getUser($id){
        try{
            $sql="select nom,prenom from utilisateur where idUser=?";
            $stm=$this->db->prepare($sql);

            $stm->bindValue(1,$id,PDO::PARAM_INT);
            
           $stm->execute();
            $result=$stm->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage().'<br>';
            echo $e->getLine();
            return false;
    }
     }
    //  add utilisateur
    public function addUtilisateur($data) {
        if($data['nom']=="" || $data['prenom']=="" || $data['email']=="" || $data['sexe']=="" || $data['password']=="" ){
            echo '<div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                <span class="font-medium">Saisir votre information personnel S.V.P!</span> 
                    </div>';
                return false;
        }
        if($data['password']!=$data['password_conf']){
            echo '<div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
            <span class="font-medium">mot de pass pas les même</span> 
                </div>';
            return false;
        }
        try {
            $role=1;
            $pass = password_hash($data['password'], PASSWORD_DEFAULT);
            // define sql statement pour l'execution
            $sql = "INSERT INTO
             utilisateur (nom,prenom,email,password,role,sexe)
              VALUES (?,?,?,?,?,?)";
            //preparer  sql statement 
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(1,  $data['nom'],PDO::PARAM_STR);
            $stmt->bindValue(2,  $data['prenom'],PDO::PARAM_STR);
            $stmt->bindValue(3,  $data['email'],PDO::PARAM_STR);
           // $stmt->bindValue(4,  $data['password'],PDO::PARAM_STR);
            $stmt->bindValue(4,  $pass,PDO::PARAM_STR);
            $stmt->bindValue(5, $role,PDO::PARAM_INT);
            $stmt->bindValue(6, $data['sexe'],PDO::PARAM_STR);
            
            // execute statement
            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getLine();
            return false;
        }
    }

    //edit utilisateur
    public function editUtilisateur($id,$data){
        try{  
              $sql = "UPDATE `Utilisateur` SET `nom`=:nom,`prenom`=:prenom,`email`=:email,`password`=:password,`telephone`=:telephone WHERE idUser = :id ";
              $stmt = $this->db->prepare($sql);
            
              $stmt->bindparam(':id',  $data['id'],PDO::PARAM_INT);
              $stmt->bindparam(':nom',  $data['nom'],PDO::PARAM_STR);
              $stmt->bindparam(':prenom',  $data['prenom'],PDO::PARAM_STR);
              $stmt->bindparam(':email',  $data['email'],PDO::PARAM_STR);
              $stmt->bindparam(':password',  $data['password'],PDO::PARAM_STR);
              $stmt->bindparam(':telephone',  $data['telephone'],PDO::PARAM_STR);
              
              // execute statement
              $stmt->execute();
              return true;
          }catch (PDOException $e) {
              echo $e->getMessage();
              return false;
          }
      }

      public function get_comptes_non_inscrire($nb){
        try{
            $sql = "SELECT idUser,nom,prenom,email,created FROM utilisateur WHERE role=1 and DATEDIFF(CURRENT_DATE(), created)>:NB and idUser not in (SELECT IDEtudiant FROM etudiant) ORDER by created ASC ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':NB',  $nb,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e) {
              echo $e->getMessage();
              return false;
          }
      }

      public function delete_user($ID){
        try{
            $sql = "DELETE FROM utilisateur where idUser=:ID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':ID',  $ID,PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
      }




}

?>