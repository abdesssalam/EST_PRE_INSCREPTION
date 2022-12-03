<?php
     require_once 'includes/header.php';
    require_once ('db/conn.php');

//traiter les donnes
$err = 1;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       if($auth->addUtilisateur($_POST)){
        $err = 0;
       }
    }

    
  
?>

<div class="container mx-auto mt-5 py-3 ">

<?php if(!$err):?>
<div class="p-4 w-1/4 mx-auto mb-4 text-center text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
  <span class="font-medium">Votre compte a été bien ajouter!!</span> 
</div>
<?php endif;?>
<div class="flex justify-center">
<form class="w-1/3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="flex mb-4 w-full">
    <div class="w-1/2 mr-1">
        <label class="block text-grey-darker text-sm font-medium mb-2" for="first_name">Prenom</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="prenom" id="first_name" type="text" placeholder="Votre prenom">
    </div>
    <div class="w-1/2 ml-1">
        <label class="block text-grey-darker text-sm font-medium mb-2" for="last_name">Nom</label>
         <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="nom" id="last_name" type="text" placeholder="Votre nom">
    </div>
    </div>
  <div class="mb-2">
    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre email</label>
    <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="exemple@ests.edu" required>
  </div>
  <div class="mb-2">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Votre Mot de pass</label>
    <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  <div class="mb-2">
    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repetez Mot de pass</label>
    <input type="password" name="password_conf" id="repeat-password" class="shadow-sm mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  <div class="w-full  flex items-center mb-2  ">
    <label for="sexe" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Sexe:</label>
    <select name="sexe" id="sexe" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
        <option selected>Sexe</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
        
    </select>
    </div>
  
  
<button type="submit" class="text-white md:w-full mx-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">créez votre compte</button>
<div class="w-full mt-2 py-2 flex flex-col items-center md:flex-row">
    <span class="w-11/12 md:mr-1">vous avez déjà un copmte</span>
    <a class="text-white md:w-full mx-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   " href="login.php">connecter a votre compte</a>
</div>

</form>
</div>

</div>
<?php  require_once 'includes/footer.php'; ?>