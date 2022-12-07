<?php
    class Inscreption{
        // database object
        private $db;

        //constructor pour initialiser db pour acceder a la base de donnes
        function __construct($conn){
            $this->db = $conn;
        }
        function clean_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        
        public function add($data,$ID){
            try{
                // begin transact
                $this->db->beginTransaction();

                $sql="INSERT INTO etudiant(IDEtudiant,CNE,CIN,ville,telephone,codePostal) values(:ID,:CNE,:CIN,:V,:T,:N)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':CNE',$data['CNE'],PDO::PARAM_STR);
                $stmt->bindParam(':CIN',$data['CIN'],PDO::PARAM_STR);
                $stmt->bindParam(':V',$data['ville'],PDO::PARAM_INT);
                $stmt->bindParam(':T',$data['telephone'],PDO::PARAM_STR);
                $stmt->bindParam(':N',$data['codePostal'],PDO::PARAM_STR);
                
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


                $sql="INSERT INTO insception(IDEtidiant,IDFelier,choix) values (:ID,:F,1)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':F',$data['choix1'],PDO::PARAM_INT);
                $stmt->execute();
                $sql="INSERT INTO insception(IDEtidiant,IDFelier,choix) values (:ID,:F,2)";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':F',$data['choix2'],PDO::PARAM_INT);
                $stmt->execute();
                // commit transact
                /*
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
                    
                */
                $this->db->commit();
                return true;
            

            } catch (PDOException $e) {
                $this->db->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
        }

        public function editInscreption($ID,$data){
            try{
                $this->db->beginTransaction();
                //table : etudiant
                $sql = "UPDATE etudiant SET CNE=:CNE,CIN=:CIN,telephone=:T,ville=:V,codePostal=:N WHERE IDEtudiant=:ID";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':CNE',$data['CNE'],PDO::PARAM_STR);
                $stmt->bindParam(':CIN',$data['CIN'],PDO::PARAM_STR);
                $stmt->bindParam(':V',$data['ville'],PDO::PARAM_INT);
                $stmt->bindParam(':T',$data['telephone'],PDO::PARAM_STR);
                $stmt->bindParam(':N',$data['codePostal'],PDO::PARAM_STR);
                $stmt->execute();

                //table : bac
                $sql = "UPDATE bac SET annee=:A,NoteNational=:NN,NoteRegional=:NR,type=:T,moycc=:CC,region=:R WHERE IDEtudiant=:ID";
                $stmt=$this->db->prepare($sql);
                $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                $stmt->bindParam(':T',$data['type_bac'],PDO::PARAM_INT);
                $stmt->bindParam(':A',$data['annee_bac'],PDO::PARAM_STR);
                $stmt->bindParam(':R',$data['region_bac'],PDO::PARAM_STR);
                $stmt->bindParam(':NN',$data['national'],PDO::PARAM_STR);
                $stmt->bindParam(':NR',$data['regional'],PDO::PARAM_STR);
                $stmt->bindParam(':CC',$data['CC'],PDO::PARAM_STR);
                $stmt->execute();
               
                //les choix
                $etd_choix = $this->showChoix($_SESSION['ID']);
                if($etd_choix[0]['IDFelier']!=$data['choix1']){
                    if($etd_choix[1]['IDFelier']==$data['choix2'] && $data['choix1']==$data['choix12']){
                        echo "les choix doit être different";
                        $this->db->rollBack();

                    }else{
                        $sql = " UPDATE insception set IDFelier=:F where IDEtidiant=:ID and choix=1";
                        $stmt=$this->db->prepare($sql);
                        $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                        $stmt->bindParam(':F',$data['choix1'],PDO::PARAM_INT);
                        $stmt->execute();   
                    }
                    
                }
                if($etd_choix[1]['IDFelier']!=$data['choix2']){
                    if($etd_choix[0]['IDFelier']==$data['choix1'] && $data['choix1']==$data['choix12']){
                        echo "les choix doit être different";
                        $this->db->rollBack();

                    }else{
                        $sql = " UPDATE insception set IDFelier=:F where IDEtidiant=:ID and choix=1";
                        $stmt=$this->db->prepare($sql);
                        $stmt->bindParam(':ID',$ID,PDO::PARAM_INT);
                        $stmt->bindParam(':F',$data['choix2'],PDO::PARAM_INT);
                        $stmt->execute();
                    }
                    
                }
                
                $this->db->commit();
                return true;
            }catch (PDOException $e) {
                $this->db->rollBack();
                echo $e->getMessage();
                echo $e->getLine();
                return false;
            }
            
        }

        public function show($id){
            try{
            $sql = "SELECT UT.nom,UT.prenom,ED.CNE,ED.CIN,ED.ville,ED.telephone,ED.nationalite,ED.payee FROM utilisateur as UT JOIN etudiant as ED on UT.idUser=ED.IDEtudiant JOIN insception as INS on INS.IDEtidiant=ED.IDEtudiant where INS.IDEtidiant =:ID";
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
                $stmt->bindparam(":ID", $id,PDO::PARAM_INT);
                $stmt->execute();
                return  $stmt->fetch();
            }catch (PDOException $e) {
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

        public function showChoix($ID){
            try{
                $sql = "SELECT IDEtidiant,IDFelier,choix FROM insception WHERE IDEtidiant=:ID";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":ID", $ID,PDO::PARAM_INT);
                $stmt->execute();
                return  $stmt->fetchAll();

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
            if(!file_exists($_FILES[$file]['tmp_name']) || !is_uploaded_file($_FILES[$file]['tmp_name'])) {
                echo '<div class="p-4 mb-4 text-sm text-center text-red-700 bg-red-100  dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">charger les fichies S.V.P!</span> 
              </div>';
                //error file
                return false;
            }
            $check = getimagesize($_FILES[$file]["tmp_name"]);
            if($check!==false) {
                // echo "File is an image - " . $check["mime"] . ".";
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
                    // echo "ok";
                    return true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return false;
                }
        
            }
        }


        //show etudiant info
        public function showEtudiant($id){
            try{
                $sql = "SELECT nbEdit,CNE,CIN,telephone,codePostal ,v.id as ville,v.region,b.annee ,b.region as RegBac, b.NoteNational,b.NoteRegional,b.moycc,b.type FROM etudiant as ed JOIN ville as v on ed.ville=v.id JOIN bac as b on b.IDEtudiant=ed.IDEtudiant WHERE ed.IDEtudiant=:ID";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch();
                
            }catch (PDOException $e) {
                
                echo $e->getMessage();
                echo $e->getLine();
                return false;
                
            }
        }



        public function set_etd_admis($et,$fl){
            try{
            $sql = "update insception set admis=1 where IDEtidiant=:E and IDFelier=:F";
            $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":E", $et, PDO::PARAM_INT);
                $stmt->bindParam(":F", $fl, PDO::PARAM_INT);
                $stmt->execute();
                return true;
            }catch (PDOException $e) {
                
                echo $e->getMessage();
                echo $e->getLine();
                return false;
                
            }
        }

       

        
        
    }
?>