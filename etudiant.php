<?php 
include_once 'includes/session.php';
include_once ('db/conn.php');
include_once 'controller/EtudiantController.php'; 
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/output.css">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <title><?php echo $full_name ?></title>
    <style>
        input:focus,textarea:focus,select:focus{
            outline:none;
        }
    </style>
</head>
<body class="bg-blue-400">
    <header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/ESTS-INS" class="flex items-center">
                <img src="img/logo.png" class="mr-3 h-6 sm:h-9" alt="EST SAFI Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">EST SAFI</span>
            </a>
            <h1><?php echo $full_name ?></h1>
            <div class="flex items-center lg:order-2">
                
                <a href="logout.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 uppercase">Déconnecter</a>
            </div>
        </div>
    </nav>
</header>
<div class="container mx-auto mt-5 py-3 ">

    <form class="w-full  mx-auto " enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <!-- info bac -->
        <h3 class="text-center text-xl font-semibold mb-3">les information personnel </h3>
        <div class="flex flex-wrap  w-full  md:justify-start lg:justify-center items-start ">
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="CNE" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">CNE ou Code Massar :</label>
                <input type="text" name="CNE" id="CNE" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="F13257780" required>
            </div>
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="CIN" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">CIN :</label>
                <input type="text" name="CIN" id="CIN" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="DJ8877" required>
            </div>
           <div class="md:w-1/4 w-full  flex items-center m-2  ">
                <label for="ville" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Payee :</label>
                <select id="ville" name="payee" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                    <option selected>choisez votre Payee</option>
                    <option value="maroc">Maroc</option>
                    <option value="mali">Mali</option>
                    <option value="sinigla">Sinigal</option>
                    <option value="Negeria">Negeria</option>
                </select>
            </div>
           <div class="md:w-1/4 w-full  flex items-center m-2  ">
                <label for="ville" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Ville :</label>
                <select id="ville" name="ville" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                    <option selected>choisez votre ville</option>
                    <option value="SAFI">SAFI</option>
                    <option value="MARRAKECH">MARRAKECH</option>
                    <option value="ESSAOUIRA">ESSAOUIRA</option>
                    <option value="AGADIR">AGADIR</option>
                </select>
            </div>
            
            <div class="md:w-1/4 w-full  flex items-center m-2  ">
                <label for="ville" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 ">Nationalité :</label>
                <select id="ville" name="nationalite" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                    <option selected>choisez votre nationalité</option>
                    <option value="maroccain">maroccain</option>
                    <option value="malaoui">malaoui</option>
                   
                </select>
            </div>
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="telephone" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 ">telephone :</label>
                <input type="phone" name="telephone" id="telephone" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="+212XXXXXXX" required>
            </div>
            
        </div>

        
  
        <!-- info bac -->
        
        <!-- info bac -->
            <h3 class="text-center text-xl font-semibold mb-3">les information de bac </h3>
            <div class="flex flex-wrap  w-full  md:justify-start lg:justify-center items-start ">
                
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="typeBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Type de Bac :</label>
                    <select id="typeBac" name="type_bac" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>choisez votre type de Bac</option>
                        <option value="1">Sc.Math</option>
                        <option value="2">Sc.Physique</option>
                        <option value="3">Sc.SVT</option>
                        <option value="4">Electrique</option>
                        <option value="5">Mecanique</option>
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="RegBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Region de Bac :</label>
                    <select id="RegBac" name="region_bac" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>choisez Region de Bac</option>
                        <option value="MARRAKECH SAFI">MARRAKECH SAFI</option>
                        <option value="CASA SETTAT">CASA SETTAT</option>
                        <option value="BENI MELLAL KHNIFRA">BENI MELLAL KHNIFRA</option>
                        <option value="FES MEKNES">FES MEKNES</option>
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="AnneeBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Annee de Bac :</label>
                    <select id="AnneeBac" name="annee_bac" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>choisez l'annee de Bac</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="national" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne de l'examen national :</label>
                    <input type="number" step="0.01" min="0" max="20" name="national" id="national" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="+212XXXXXXX" required>
                </div>
                <div     class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="regional" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne de l'examen regional :</label>
                    <input type="number" step="0.01" min="0" max="20" name="regional" id="regional" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="+212XXXXXXX" required>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="cc" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne des controls continue :</label>
                    <input type="number" step="0.01" min="0" max="20" name="cc" id="cc" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="+212XXXXXXX" required>
                </div>
        </div>
      
        <!-- file upload -->
            <h3 class="text-center text-xl font-semibold mb-3 capitalize">charger les copies de </h3>
            <div class="flex flex-wrap  w-full md:justify-start lg:justify-center items-start ">
                
                <div class="md:w-1/4 w-full  flex items-center mx-2  ">
                    <label  class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">relvet regional:</label>
                    <input type="file" name="File_R" accept=".jpeg,.jpg,.png">
                </div>
                <div class="md:w-1/4 w-full  flex items-center my-2  ">
                    <label  class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">relvet bac :</label>
                   <input type="file" name="File_NB" accept=".jpeg,.jpg,.png">
                </div>
                <div class="md:w-1/4 w-full  flex items-center my-2  ">
                    <label  class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">original bac:</label>
                    <input type="file" name="File_B" accept=".jpeg,.jpg,.png">
                </div>
                
        </div>
        <!-- info est -->
            <h3 class="text-center text-xl font-semibold mb-3 capitalize">les choix des filiers </h3>
            <div class="flex flex-wrap  w-full md:justify-start lg:justify-center items-start ">
                
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="choix1" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">choix 2:</label>
                    <select id="choix1" name="choix1" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>liste des choix</option>
                        <option value="1">Ginie informatique</option>
                        <option value="2">Technique de management</option>
                       
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="choix2" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">choix 1:</label>
                    <select id="choix2" name="choix2" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>liste des choix</option>
                        <option value="1">Ginie informatique</option>
                        <option value="2">Technique de management</option>
                        
                    </select>
                </div>
                <!-- <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="choix3" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">3 choix :</label>
                    <select id="choix3" name="choix3" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>liste des choix</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div> -->
                
        </div>
        <div class="flex flex-wrap  w-full md:justify-start lg:justify-center items-start ">
    <button type="submit" class="text-white md:w-1/3 w-full my-3 uppercase mx-auto bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">validier l'inscription</button>
        </div>
</form>

</div>