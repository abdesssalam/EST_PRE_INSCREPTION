<?php
     require_once 'includes/header.php';
    require_once ('db/conn.php');
    require_once ('controller/LoginController.php');
?>
<div class="container mx-auto mt-5 py-3 ">

<?php
    if($loginErr): ?>
    <div class="p-4 w-1/2 md:w-1/4 mx-auto mb-4 text-center text-sm text-red-700 bg-red-100 rounded-lg " role="alert">
        <span class="font-medium">invalide compte!!</span> 
    </div>
    <?php endif;?>
<div class="flex justify-center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="w-1/2 md:w-1/3">
    <div class="mb-2">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
        <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="exemple@ests.edu" required>
    </div>
    <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Mot de pass</label>
        <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
    </div>
    <button type="submit" class="text-white md:w-full mx-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">connecter a votre compte</button>
    <div class="w-full  mt-2 p-2 border-2  border-blue-800 rounded-md  flex flex-col items-center md:justify-center md:flex-row">
    <span class="md:w-11/12 my-1 md:mr-1 ">vous n'avez déjà un copmte</span>
    <a class="text-white md:w-full mx-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   " href="login.php">créez votre compte</a>
</div>

</form>
</div>

</div>
<?php  require_once 'includes/footer.php'; ?>