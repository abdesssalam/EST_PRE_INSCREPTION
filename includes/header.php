<?php include_once 'includes/session.php'; ?>
<?php include_once 'config.php'; ?>

<?php



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
    <title>Home page</title>
    <style>
        input:focus,select:focus{
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
            <div class="flex items-center lg:order-2">
                <a href="login.php" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800 uppercase">connecter</a>
                <a href="inscrire.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 uppercase">Inscrire</a>
            </div>
        </div>
    </nav>
</header>