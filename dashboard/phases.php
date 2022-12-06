<?php 
$title = "géstion des phases";
require_once('header.php');
$rows = $inscreption->all();
$types_bac = $home_info->getTypeBac();
$filiers = $felier->getAllFiliers();
?>
<!-- conent -->
<div class="bg-green-200 w-10/12 mx-auto my-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="flex flex-col items-stretch mx-2 ">
        
        <div class="my-2 flex content-around ">
            <label class="font-medium text-lg capitalize  w-1/3" for="departement">filier DUT :</label>
            <select id="departement" name="filier_DUT" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
               <option >liste des choix</option>
               <?php foreach($filiers as $fl): ?>
               <option value="<?php echo $fl['IDFelier'] ?>">
                  <?php echo $fl['filier'] ?>   
               </option>
                <?php endforeach; ?>      
            </select>
        </div>
        <div class="my-2 flex content-around ">
            <label class="font-medium text-lg capitalize  w-1/3" for="departement">choisir la liste</label>
            <select id="liste" name="liste" class="w-2/3 bg-white border border-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
               
               <option value="principale">Principale</option>
               <option value="attend">Attend</option>
                    
            </select>
        </div>
        
        <div class="w-9 mx-auto">
            <input class="text-white bg-green-500 py-2 px-3 font-semibold my-2 cursor-pointer rounded-md uppercase hover:text-gray-600" type="submit" value="imprimer">
         </div>
    </form>
 


    </div>
   <div class="w-11/12 mx-auto py-2">
      <h3 class="text-center font-bold text-xl capitalize">liste des inscriptions</h3>
      <div class="overflow-x-auto relative mt-4">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Full name
                </th>
                <th scope="col" class="py-3 px-6">
                    Bac
                </th>
                <th scope="col" class="py-3 px-6">
                    filier
                </th>
                
            </tr>
        </thead>
        <tbody> 
         <?php foreach($rows as $row): ?> 
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">     
               <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php echo $row['prenom'] . ' ' . $row['nom']; ?>
                </th>
                <td class="py-4 px-6">
                    <?php echo $row['bac']; ?>
                </td>
                <td class="py-4 px-6">
                    <?php echo $row['filier']; ?>
                </td>
               
            </tr>
         <?php endforeach; ?>
           
        </tbody>
    </table>
   </div>
   </div>
 
    


<?php require_once('footer.php') ?>
