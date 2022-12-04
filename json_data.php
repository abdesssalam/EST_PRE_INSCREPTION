<?php
include_once 'includes/session.php';
include_once ('db/conn.php');
if(isset($_GET['reg_id'])){
    echo json_encode($home_info->getVillesByRegion($_GET['reg_id']));
}
if(isset($_GET['choix_id'])){
   

    echo json_encode($home_info->filtredFiliers($_GET['choix_id']));
}

?>