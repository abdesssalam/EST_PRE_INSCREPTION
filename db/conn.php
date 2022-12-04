<?php 

$host= 'localhost';
$db = 'gestion_pre_inscreption';
$user = 'root'; 
$pass = '';
$charset= 'utf8mb4';

// add autoload
spl_autoload_register(function($class){
    if(file_exists('db/'.$class.'.php')){
        require_once 'db/'.$class.'.php';
    }
    
});

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());        
    }

    require_once 'inscreption.php';
    require_once 'Phase.php';
    require_once 'Departement.php';
    require_once 'Auth.php';
    require_once 'Filier.php';
    require_once 'HomeInfo.php';
    
    $inscreption = new Inscreption($pdo);
    $phase=new Phase($pdo);
    $departement=new Departement($pdo);
    $auth=new Auth($pdo);
    $felier = new Filier($pdo);
    $home_info = new HomeInfo($pdo);
   // $post=new Post($pdo);

    // $user->insertUser("admin","1234soyfrancisco");
?>


