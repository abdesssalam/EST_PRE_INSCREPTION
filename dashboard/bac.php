<?php 
$title = "les type bac";
require_once('header.php');
$types_bac = $home_info->getTypeBac();
$filiers = $felier->getAllFiliers();

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['add'])){
        if($felier->add_filier_bac($_POST)){
            echo '<div class="p-4 mb-4 text-center text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">operation done </span> 
          </div>';
        }
    }
    if(isset($_POST['edit'])){
        if($felier->edit_filier_bac($_POST)){
            echo '<div class="p-4 mb-4 text-center text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">operation done </span> 
          </div>';
        }
    }
}
$rowF;
if(isset($_GET['editfilier']) && isset($_GET['bac'])){
    $rowF = $felier->get_filierTypeBac_by_bac_dut($_GET['bac'], $_GET['editfilier']);
}

?>
<!-- conent -->
<div class="bg-green-200 w-10/12 mx-auto my-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="flex flex-col items-stretch mx-2 ">
        
        <div class="my-2 flex content-around ">
            <label class="font-medium text-lg capitalize  w-1/3" for="filier">filier DUT :</label>
            <select id="dut-filier" name="filier" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
               <option >liste des choix</option>
               <?php foreach($filiers as $fl): 
                if(isset($rowF) && $rowF['IDFelier']==$fl['IDFelier']){
                   
                        echo '<option selected value="'.$fl['IDFelier'].'">'.$fl['filier'].'</option>';
                    
                }else{
                    echo '<option  value="'.$fl['IDFelier'].'">'.$fl['filier'].'</option>';
                }
                
                endforeach; ?>      
            </select>
        </div>
        <div class="my-2 flex content-around ">
            <label class="font-medium text-lg capitalize  w-1/3" for="departement">les feliers de bac</label>
            <select  id="departement" name="type" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
               <option selected>liste des choix</option>
               <?php foreach($types_bac as $tb): 
                if(isset($rowF) && $rowF['IDType']==$tb['IDType']){
                    echo '<option selected value="'.$tb['IDType'].'">'.$tb['initiule'].'</option>';
                }else{
                    echo '<option  value="'.$tb['IDType'].'">'.$tb['initiule'].'</option>';
                }
                
                 endforeach; ?>      
            </select>
        </div>
        <div class="my-2 flex content-around ">
        <label class="font-medium text-lg  capitalize w-1/3" for="NB_MAX">Nombre Max</label>
         
        <select class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5" type="number" name="NB">
            <option>les persontages</option>
            <?php for($i=10;$i<100;$i=$i+5){
                if(isset($rowF) && $i==$rowF['nb']){
                    echo '<option selected value="'.$i.'">'.$i.'</option>';
                }else{
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
                
            } ?>
        </select>
        </div>
        <div class="w-9 mx-auto">
            <?php if(isset($rowF)){
                echo '<input class="text-white bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="edit" value="modifier">';
                
            }else{
                echo '<input class="text-white bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" name="add" value="souvgarder">';
            } ?>
            
            
         </div>
    </form>
    </div>
    
    <div class="w-10/12 mx-auto py-3 overflow-hidden ">
 <h2 class="text-center font-bold text-xl capitalize">Liste des filiers </h2>
 <div class="overflow-x-auto  overflow-y-scroll relative mt-4" style="height: 180px ;">
    <table class="w-full text-sm  text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                     bac
                </th>
                <th scope="col" class="py-3 px-6">
                    filier
                </th>
                <th scope="col" class="py-3 px-6">
                    Nombre Max
                </th>
                <th scope="col" class="py-3 px-6">
                     
                </th>
            </tr>
        </thead>
        <tbody id="table-filiers" >
         
        </tbody>
    </table>
</div>
</div>
 
    


<?php require_once('footer.php') ?>
