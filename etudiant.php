<?php 
include_once 'includes/session.php';
include_once ('db/conn.php');
include_once 'controller/EtudiantController.php';

$current =getdate()['year'];
$next = $current - 1;

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
<?php
$today = date("Y-m-d");
$dateLimit = $home_info->get_setting_value('date_limit_inscrp')['val'];
if($dateLimit<$today):
  echo '<div class="p-4 mb-4 text-sm text-yellow-500 text-center bg-yellow-200 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
  <span class="font-medium">les inscreptions sont fermer!</span> 
</div>';
else:
?>
<div class="container mx-auto mt-5 py-3 ">

    <form class="w-full  mx-auto " enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <!-- info bac -->
        <h3 class="text-center text-xl font-semibold mb-3">les information personnel </h3>
        <div class="flex flex-wrap  w-full  md:justify-start lg:justify-center items-start ">
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="CNE" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">CNE ou Code Massar :</label>
                <input type="text" value="<?php echo isset($rowEtudian['CNE']) ? $rowEtudian['CNE'] : '' ?>" name="CNE" id="CNE" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="F13257780" required>
            </div>
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="CIN" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">CIN :</label>
                <input type="text" name="CIN"  value="<?php echo isset($rowEtudian['CIN']) ? $rowEtudian['CIN'] : '' ?>" id="CIN" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="DJ8877" required>
            </div>
           <div class="md:w-1/4 w-full  flex items-center m-2  ">
                <label for="region" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Payee :</label>
                <!-- TODO:  traitemnet for dynamique -->
                <select required id="region-etd"  name="region"  value="<?php echo isset($rowEtudian['region']) ? $rowEtudian['region'] : '' ?>" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                     <option >choisez votre region</option>
                    <?php foreach($regions as $region): ?>
                        <?php if(isset($rowEtudian['region']) && $rowEtudian['region']==$region['id'] ): ?>
                            <option selected value="<?php echo $region['id'];?>"><?php echo $region['region'];?></option>
                            <?php else:?> 
                                <option value="<?php echo $region['id'];?>"><?php echo $region['region'];?></option>
                            <?php endif; ?>
                       
                    <?php endforeach;?>
                </select>
            </div>
           <div class="md:w-1/4 w-full  flex items-center m-2  ">
                <label for="ville" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Ville :</label>
                <select required id="ville-etd" name="ville"   class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                    <option selected>choisez votre ville</option>
                    <?php foreach($villes as $ville): ?>
                        <?php if(isset($rowEtudian['ville']) && $ville['id']==$rowEtudian['ville']): ?>
                            <option selected value="<?php echo $ville['id'];?>"><?php echo $ville['ville'];?></option>
                        <?php else:?>
                            <option  value="<?php echo $ville['id'];?>"><?php echo $ville['ville'];?></option>
                        <?php endif;?>    
                    <?php endforeach;?>

                </select>
            </div>
            
            <div class="md:w-1/4 w-full  flex items-center m-2  ">
            <label for="dateNaiss" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 ">Dade de naissance :</label>
                <input type="date" name="dateNaiss"  value="<?php echo isset($rowEtudian['dateNaiss']) ? $rowEtudian['dateNaiss'] : '' ?>" id="dateNaiss" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="50000" required>
            </div>
            <div class="md:w-1/4 w-full  flex items-center m-2 ">
                <label for="telephone" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 ">telephone :</label>
                <input type="phone" name="telephone"  value="<?php echo isset($rowEtudian['telephone']) ? $rowEtudian['telephone'] : '' ?>" id="telephone" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="+212XXXXXXX" required>
            </div>
            
        </div>

        
  
        <!-- info bac -->
        
        <!-- info bac -->
            <h3 class="text-center text-xl font-semibold mb-3">les information de bac </h3>
            <div class="flex flex-wrap  w-full  md:justify-start lg:justify-center items-start ">
                
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="typeBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Type de Bac :</label>
                    <select required id="typeBac" name="type_bac"  value="<?php echo isset($rowEtudian['CNE']) ? $rowEtudian['CNE'] : '' ?>" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option>choisez votre type de Bac</option>
                        <!-- TODO : dynamique -->
                        <?php foreach($typebac as $tbac): ?>
                            <?php if(isset($rowEtudian['type']) && $rowEtudian['type']==$tbac['IDType'] ): ?>
                                <option selected value="<?php echo $tbac['IDType'];?>"><?php echo $tbac['initiule'];?></option>
                            <?php else:?>
                                <option value="<?php echo $tbac['IDType'];?>"><?php echo $tbac['initiule'];?></option>
                            <?php endif; ?>
                       
                    <?php endforeach;?>
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="RegBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Region de Bac :</label>
                    <select required id="RegBac" name="region_bac"  value="<?php echo isset($rowEtudian['CNE']) ? $rowEtudian['CNE'] : '' ?>" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option selected>choisez Region de Bac</option>
                        <?php foreach($regions as $region): ?>
                            <?php if(isset($rowEtudian['RegBac']) && $rowEtudian['RegBac']==$region['id'] ): ?>
                                <option selected value="<?php echo $region['id'];?>"><?php echo $region['region'];?></option>
                            <?php else:?>
                                <option value="<?php echo $region['id'];?>"><?php echo $region['region'];?></option>
                            <?php endif; ?>
                            
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="AnneeBac" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">Annee de Bac :</label>
                    <select required id="AnneeBac" name="annee_bac"  value="" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option >choisez l'annee de Bac</option>
                        <?php
                        if(isset($rowEtudian['annee'])){
                            if($current==$rowEtudian['annee']){
                                echo '<option selected value="'.$current.'">'.$current.' </option>';
                                echo '<option  value="'.$next.'">'.$next.' </option>';
                            }else{
                                echo '<option selected value="'.$next.'">'.$next.' </option>';
                                echo '<option  value="'.$current.'">'.$current.' </option>';
                            }
                        }else{
                            echo '<option  value="'.$next.'">'.$next.' </option>';
                            echo '<option  value="'.$current.'">'.$current.' </option>';
                        }
                        ?>
                        
            
                        
                        
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="national" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne de l'examen national :</label>
                    <input  type="number"  value="<?php echo isset($rowEtudian['NoteNational']) ? $rowEtudian['NoteNational'] : '' ?>" step="0.01" min="0" max="20" name="national" id="national" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="XX.XX" required>
                </div>
                <div     class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="regional" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne de l'examen regional :</label>
                    <input  type="number"  value="<?php echo isset($rowEtudian['NoteRegional']) ? $rowEtudian['NoteRegional'] : '' ?>" step="0.01" min="0" max="20" name="regional" id="regional" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="XX.XX" required>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2 ">
                    <label for="cc" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">moyenne des controls continue :</label>
                    <input  type="number"   value="<?php echo isset($rowEtudian['moycc']) ? $rowEtudian['moycc'] : '' ?>" step="0.01" min="0" max="20" name="CC" id="cc" class=" w-2/3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="XX.XX" required>
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
                    <label for="choix1" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">choix 1:</label>
                    <select required id="choix1" name="choix1" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option>liste des choix</option>
                        <?php foreach($feliers as $fl): 
                             if(isset($etd_choix[0])){
                                if($etd_choix[0]['IDFelier']==$fl['IDFelier']){
                                    echo '<option selected value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                                }else{
                                    echo '<option  value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                                }
                            }else{
                                echo '<option  value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                            } 
                            endforeach;?>
                    </select>
                </div>
                <div class="md:w-1/4 w-full  flex items-center m-2  ">
                    <label for="choix2" class=" w-1/3 block mx-2 text-sm font-medium text-gray-900 dark:text-white">choix 2:</label>
                    <select id="choix2" name="choix2" class="w-2/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 ">
                        <option >liste des choix</option>
                        <?php foreach($feliers as $fl): 
                             if(isset($etd_choix[1])){
                                if($etd_choix[1]['IDFelier']==$fl['IDFelier']){
                                    echo '<option selected value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                                }else{
                                    echo '<option  value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                                }
                            }else{
                                echo '<option  value="' . $fl['IDFelier'] . '">'.$fl['filier'].'</option>';
                            } 
                            endforeach;?>
                        
                    </select>
                </div>
                
                
        </div>
        <div class="flex flex-wrap  w-full md:justify-start lg:justify-center items-start ">
        
        <?php
        
        if(isset($rowEtudian['nbEdit'])){
            $nb = $home_info->get_setting_value('limit_edit')['val'];
            if($rowEtudian['nbEdit']<$nb){
                
                echo '<button type="submit" class="text-white md:w-1/3 w-full my-3 uppercase mx-auto bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">modifier</button>'; 
                 
            }else{
                echo '<button disabled type="submit" class="text-white md:w-1/3 w-full my-3 uppercase mx-auto bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">modifier</button>';
                
            }
             }else{
                    echo '<button  type="submit" class="text-white md:w-1/3 w-full my-3 uppercase mx-auto bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center   ">valider votre inscreption</button>';
             } ?>
       
        </div>
</form>

</div>

<?php
endif;
require_once 'includes/footer.php'; ?>