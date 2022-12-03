<?php 
$title = "les inscréptions reçu";
require_once('header.php');
$rows = $inscreption->all();
?>
<!-- conent -->
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
