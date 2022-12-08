<?php 
$title = "les comptes non inscrire";
require_once('header.php');
$rows = $auth->get_comptes_non_inscrire();;
?>
<!-- conent -->
   <div class="w-11/12 mx-auto py-2">
      <h3 class="text-center font-bold text-xl capitalize">liste des comptes non inscrire</h3>
      <div class="overflow-x-auto  overflow-y-scroll relative mt-4" style="height: 450px ;">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Full name
                </th>
                <th scope="col" class="py-3 px-6">
                    email
                </th>
                <th scope="col" class="py-3 px-6">
                    date de creation
                </th>
                <th scope="col" class="py-3 px-6">
                    
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
                    <?php echo $row['email']; ?>
                </td>
                <td class="py-4 px-6">
                    <?php echo $row['created']; ?>
                </td>
                <td class="py-4 px-6 ">
                    <a class="text-sm text-red-600" href="<?php echo 'contacts.php?delete='.$row['idUser']; ?>">suprimmer</a> 
                </td>
               
            </tr>
         <?php endforeach; ?>
           
        </tbody>
    </table>
   </div>
   </div>


<?php require_once('footer.php') ?>
