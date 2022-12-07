<?php
$title = "statistique";
require_once('header.php');

$rows = $home_info->get_statistics();


?>
<!-- conent -->

    <div class="flex  w-full h-5/6 flex-wrap justify-start items-start">
        <?php foreach($rows as $row): ?>
        <div class="bg-blue-600  flex justify-between items-center py-2 px-4 m-2">
            <i class="fa-solid fa-graduation-cap text-white text-2xl mx-2"></i>
            <div class="text-white uppercase">
                <h3><?php echo  $row['intitilue'] ?></h3>
                <h4><?php echo $row['NBR'] ?> <span>inscreption</span> </h4>   
            </div>
            
        </div>
        <?php endforeach;?>    
        
    </div>


<?php require_once('footer.php') ?>

   