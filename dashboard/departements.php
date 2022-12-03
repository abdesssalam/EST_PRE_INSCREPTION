
<?php
$title = "les déparetements";
require_once('header.php'); 

$data=$departement->getAllDepartement();

?>
<!-- conent -->

<div class="overflow-x-auto relative my-7 ">
    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-green-400 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    les déparetements
                </th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($data as $row):?> 
            <tr class="bg-green-300 text-gray-500 border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">
                   <?php echo $row['intitilue'];?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>


<?php require_once('footer.php') ?>
