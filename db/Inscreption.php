<?php
    class Inscreption{
        // database object
        private $db;

        //constructor pour initialiser db pour acceder a la base de donnes
        function __construct($conn){
            $this->db = $conn;
        }

        
        public function add($data,$ID){
            try{
                // begin transact
                $this->db->beginTransaction();

                $sql="INSERT INTO etudiant(IDEtudiant,CNE,CIN,ville,telephone,nationalite,payee) values(:ID,:CNE,:CIN,:V,:T,:N,:P)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':CNE',$data['CNE'],PDO::PARAM_STR);
                $stmt->bindParam(':CIN',$data['CIN'],PDO::PARAM_STR);
                $stmt->bindParam(':V',$data['ville'],PDO::PARAM_STR);
                $stmt->bindParam(':T',$data['telephone'],PDO::PARAM_STR);
                $stmt->bindParam(':N',$data['nationalite'],PDO::PARAM_STR);
                $stmt->bindParam(':P',$data['payee'],PDO::PARAM_STR);
                $stmt->execute();

                $sql="INSERT INTO bac(IDEtudiant,annee,region,NoteNational,NoteRegional,type,moycc) values(:ID,:A,:R,:NN,:NR,:T,:CC)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':T',$data['type_bac'],PDO::PARAM_INT);
                $stmt->bindParam(':A',$data['annee_bac'],PDO::PARAM_STR);
                $stmt->bindParam(':R',$data['region_bac'],PDO::PARAM_STR);
                $stmt->bindParam(':NN',$data['national'],PDO::PARAM_STR);
                $stmt->bindParam(':NR',$data['regional'],PDO::PARAM_STR);
                $stmt->bindParam(':CC',$data['CC'],PDO::PARAM_STR);
                $stmt->execute();


                $sql="INSERT INTO insception(IDEtidiant,IDFelier) values (:ID,:F)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':F',$data['choix1'],PDO::PARAM_INT);
                $stmt->execute();
                $sql="INSERT INTO insception(IDEtidiant,IDFelier) values (:ID,:F)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':F',$data['choix2'],PDO::PARAM_INT);
                $stmt->execute();
                // commit transact
               
                    if($this->addFile('File_R','regional',$data['CNE'])==false){
                        $this->db->rollBack();
                        return false;
                    }
                    if($this->addFile('File_NB','notes',$data['CNE'])==false){
                        $this->db->rollBack();
                        return false;
                    }
                    if($this->addFile('File_B','bac',$data['CNE'])==false){
                        $this->db->rollBack();
                        return false;
                    }
                    
                
                $this->db->commit();
                return true;
            

            } catch (PDOException $e) {
                $this->db->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
        }

        public function show($id){
            try{
            $sql = "SELECT UT.nom,UT.prenom,ED.CNE,ED.CIN,ED.ville,ED.telephone,ED.nationalite,ED.payee FROM `utilisateur` as UT JOIN etudiant as ED on UT.idUser=ED.IDEtudiant JOIN insception as INS on INS.IDEtidiant=ED.IDEtudiant where INS.IDEtidiant =:ID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(":ID", $id);
            $stmt->execute();
            return  $stmt->fetch();
            
            }catch (PDOException $e) {
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
        }

        public function checkIn($id){
            try{
            $sql = "SELECT COUNT(*) as NBR from etudiant WHERE IDEtudiant=:ID";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":ID", $id);
                $stmt->execute();
                return  $stmt->fetch();
            }catch (PDOException $e) {
                $this->db->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
        }

        public function all(){
            try{
            $sql = "select UT.nom,UT.prenom,TC.initiule as bac ,F.intitilue as filier from utilisateur UT JOIN etudiant ED on UT.idUser=ED.IDEtudiant join bac BC on BC.IDEtudiant=ED.IDEtudiant join typebac TC on TC.IDType=BC.type join insception EC on EC.IDEtidiant=ED.IDEtudiant join felier F on F.IDFelier=EC.IDFelier";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

            }catch (PDOException $e) {
                
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
        }

        
       
        
        public function addFile($file,$path,$name){
            $target_dir = "uploads/".$path."/";
            $target_file = $target_dir .$name.'__'.basename($_FILES[$file]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
            $check = getimagesize($_FILES[$file]["tmp_name"]);
            if($check!==false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
                
            }
            if($_FILES[$file]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                return false;
                // if everything is ok, try to upload file
            }else {
                if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
                    echo "ok";
                    return true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return false;
                }
        
            }
        }

        
        
    }
?>