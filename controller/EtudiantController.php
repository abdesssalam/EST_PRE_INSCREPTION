<?php

//dynamique page
$full_name="";
$rowEtudian;
if(isset($_SESSION['ID'])){
   $data = $auth->getUser($_SESSION['ID']);
    $full_name=$data['prenom'].' '.$data['nom'];
    $etd = $inscreption->checkIn($_SESSION['ID']);
    $etd_choix = $inscreption->showChoix($_SESSION['ID']);
    $action = "ADD";

    if($etd["NBR"]>0){
        $action = "EDIT";
        $rowEtudian = $inscreption->showEtudiant($_SESSION['ID']);
        
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($action=="ADD"){
          $inscreption->add($_POST, $_SESSION['ID']);  
        }
        if($action=="EDIT"){
            if($inscreption->editInscreption($_SESSION['ID'], $_POST)){
                echo'<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <span class="font-medium">Bien Modifier!</span> 
                    </div>';
            }
        }
        
    }
}
$villes = $home_info->getVilles();
$regions = $home_info->getRegions();
$typebac = $home_info->getTypeBac();
$feliers = $felier->getAllFiliers();



// else{
//     header("location:login.php");
// }

/*
    TODO: add etudiant info to db
*/



?>