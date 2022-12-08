<?php
$title = "statistique et parammeters";
require_once('header.php');

$rows = $home_info->get_statistics();
$settings = $home_info->get_settings();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if($home_info->update_settings($_POST)){
        echo '<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">les modification bien effectuer!</span> 
      </div>';
    }
}

?>
<!-- conent -->

    <div >
        <div class="flex  w-11/12 mx-auto h-5/6 flex-wrap justify-start items-start">
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
        <hr class="bg-gray-600 h-1">
        <div class="flex flex-col justify-center mx-auto w-11/12 ">
            <h1 class="text-center uppercase">parametters</h1>
            <form action="" method="post" class="w-full flex flex-col items-center">
                <?php foreach($settings as $st): ?>
                    <div class="my-2 flex content-around focus:outline-none w-full">
                        <label class="font-medium text-lg capitalize  w-1/3" for=""><?php echo $st['label'] ?></label>
                        
                        <input class="p-1 rounded-sm w-2/3" value="<?php echo $st['val'] ?>" type="<?php echo $st['type'] ?>" name="<?php echo $st['s_key'] ?>"  >
                        
                    </div>
                <?php endforeach; ?>    
                <button type="submit" class="self-center text-white md:w-1/3 w-full  my-3 uppercase mx-auto bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">souvgarder</button>
            </form>
        </div>  
        
    </div>


<?php require_once('footer.php') ?>

   