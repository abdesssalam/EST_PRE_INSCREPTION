<?php
require_once('../includes/session.php');
require_once('../db/conn.php');
if(isset($_POST['print'])){
    $fl = $_POST['phase_filier_DUT'];
    $liste;
    $name;
    if($_POST['liste']=='attend'){
        $liste = $phase->get_list_att($fl);
        $name = 'list_attende_' . str_replace(' ', '_', $liste[0]['felier']).getdate()['mday'].'_'.getdate()['mon'].'_'.getdate()['year']; 
    }else{
        $liste = $phase->get_list_principale($fl);
        //foreach update insception 

        for($i=0;$i<count($liste);$i++){
            if($inscreption->set_etd_admis($liste[$i]['IDEtudiant'], $liste[$i]['IDFelier'])==false){
                return;
            };
            unset($liste[$i]['IDFelier']);
            unset($liste[$i]['IDEtudiant']);
        }
        $name = 'list_principale_' . str_replace(' ', '_', $liste[0]['felier']).getdate()['mday'].'_'.getdate()['mon'].'_'.getdate()['year']; 
    }
   
    
    

    $filename = $name.'.csv';
    
    header('Content-Type:text/csv;');
    header('Content-Encoding:UTF-8');
    header("Content-Disposition:attachement;filename=$filename");
  
    $output = fopen("php://output","w");
    $header = array_keys($liste[0]);   
    ob_end_clean();
    echo "\xEF\xBB\xBF";
    fputcsv($output, $header);
    foreach($liste as $etd){
        
        fputcsv($output, $etd);
       
    }
   
    fclose($output);
}

?>