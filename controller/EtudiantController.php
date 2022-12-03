<?php

//dynamique page
$full_name="";
if(isset($_SESSION['ID'])){
   $data = $auth->getUser($_SESSION['ID']);
    $full_name=$data['prenom'].' '.$data['nom'];
    
}
// else{
//     header("location:login.php");
// }

/*
    TODO: add etudiant info to db
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inscreption->add($_POST, $_SESSION['ID']);
}

?>