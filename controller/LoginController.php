<?php

$loginErr = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $res=$auth->login($_POST);
    
   if($res){
        $_SESSION['ID'] = $res['idUser'];
        if($res['role']=="1"){
            header("location:etudiant.php");
        }else if($res['role']=="2"){
            header("location:dashboard/index.php");
        }
   }else{
        $loginErr=1;
    }
 }


?>