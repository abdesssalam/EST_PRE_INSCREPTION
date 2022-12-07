<?php 
$title = "les filièrs";
require_once('header.php');

//get data
/**
 * dynamique drop down
 */
$deps=$departement->getAllDepartement();

/**
 * for table
 * 
 */

$listFilier = $felier->getAllFiliers();

//add filier to database
if($_SERVER['REQUEST_METHOD']=="POST"){
   if(isset($_POST['action'])){
      if($felier->editFilier($_POST)){
         echo '<div class="p-4 mb-4 w-2/3 mx-auto text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
       <span class="font-medium">filier a été bien modifer!</span> 
     </div>';
      }
   }else{

   
   if($felier->addFilier($_POST)){
      echo '<div class="p-4 mb-4 w-2/3 mx-auto text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
       <span class="font-medium">filier a été bien ajouter!</span> 
     </div>';
   }
}
}
$inputValues = array();
if(isset($_GET['edit'])){
   $cuttent = $felier->getFilierByID($_GET['edit']);
   $inputValues['IDFelier'] = $cuttent['IDFelier'];
   $inputValues['label'] = $cuttent['intitilue'];
   $inputValues['deparetemrent'] = $cuttent['IDDept'];
   $inputValues['nbMax'] = $cuttent['nbMax'];
  
}
?>
<!-- conent -->

<div class="bg-green-200 w-10/12 mx-auto my-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="flex flex-col items-stretch mx-2 ">
        <div class="my-2 flex content-around focus:outline-none">
            <label class="font-medium text-lg capitalize  w-1/3" for="">Label filier :</label>
            <?php if(count($inputValues)==0): ?>
            <input class="p-1 rounded-sm w-2/3" type="text" name="label">
            <?php else : ?>
               <input class="p-1 rounded-sm w-2/3" value="<?php echo $inputValues['label'] ?>" type="text" name="label">
            <?php endif;?>
        </div>
        <div class="my-2 flex content-around ">
            <label class="font-medium text-lg capitalize  w-1/3" for="departement">Deparetement</label>
            <select id="departement" name="departement" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
            <?php if(count($inputValues)==0): ?>
               <option selected>liste des choix</option>
               <?php foreach($deps as $dep): ?>
               <option value="<?php echo $dep['IDDept'] ?>">
                  <?php echo $dep['intitilue'] ?>   
               </option>
                <?php endforeach; ?>      
                <?php else: ?>
                  <?php foreach($deps as $dep): ?>
                     <?php if($dep['IDDept']==$inputValues['deparetemrent']): ?>
                        <option selected value="<?php echo $dep['IDDept']?>">
                           <?php echo $dep['intitilue'] ?>   
                        </option>
                     <?php else : ?>
                        <option  value="<?php echo $dep['IDDept']?>">
                           <?php echo $dep['intitilue'] ?>   
                        </option>
                     <?php endif;?>   
                  <?php endforeach; ?> 
                <?php endif; ?>  
            </select>
        </div>
        <div class="my-2 flex content-around ">
        <label class="font-medium text-lg  capitalize w-1/3" for="NB_MAX">Nombre Max</label>
        <?php if(count($inputValues)==0): ?>
         <input class="p-1 rounded-sm w-2/3" type="number" name="NB_MAX">
         <?php else : ?>
            <input class="p-1 rounded-sm w-2/3" value="<?php echo $inputValues['nbMax'] ?>" type="text" name="NB_MAX">
         <?php endif;?>
         
           
        </div>
        <div class="w-9 mx-auto">
         <?php if(isset($_GET['edit'])): ?>
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="edit" value="<?php echo $_GET['edit'] ?>">
            <input class="text-white bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="modifier">
         <?php else:?>   
            <input class="text-white bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="ajouter">
         <?php endif;?>
         </div>
        
    </form>
 </div>
 <div class="w-10/12 mx-auto py-3 overflow-hidden ">
 <h2 class="text-center font-bold text-xl capitalize">Liste des filiers </h2>
 <div class="overflow-x-auto relative mt-3 mx-4 h-1/3 ">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                     filier
                </th>
                <th scope="col" class="py-3 px-6">
                    Deparetement
                </th>
                <th scope="col" class="py-3 px-6">
                    Nombre Max
                </th>
                <th scope="col" class="py-3 px-6">
                     
                </th>
            </tr>
        </thead>
        <tbody >
         <?php foreach($listFilier as $row): ?>
            <tr class="bg-white border-b ">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                    <?php echo $row['filier'] ?>
                </th>
                <td class="py-4 px-6">
                  <?php echo $row['dep'] ?>
                </td>
                <td class="py-4 px-6">
                  <?php echo $row['nbMax'] ?>
                </td>
                <td class="py-4 px-6">
                   <a class="text-blue-600 w-full" href="filiers.php?edit=<?php echo $row['IDFelier'] ?>">Modifier</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>


<?php require_once('footer.php') ?>
