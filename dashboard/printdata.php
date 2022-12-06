<?php
require_once('header.php');
if(isset($_POST['print'])){
    $fl = $_POST['phase_filier_DUT'];
    $list_principale = $phase->get_list_principale($fl);


    $filename = 'principale.csv';
    
    header('Content-Type:text/csv;');
    header('Content-Encoding:UTF-8');
    header("Content-Disposition:attachement;filename=$filename");
  
    $output = fopen("php://output","w");
    // fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
    $header = array_keys($list_principale[0]);
    
    ob_end_clean();
    echo "\xEF\xBB\xBF";
    fputcsv($output, $header);
    foreach($list_principale as $etd){
        
        fputcsv($output, $etd);
       
    }
   
    fclose($output);
}

?>