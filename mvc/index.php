<?php
    session_start();
    require __DIR__.'/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    require "includes/database.php";
    require "includes/fonction.php";
    require "config/config.php";

    $errors = [];
    if(isset($_GET['deconnect']))
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
        ){
        if (isset($_SESSION['auth'])) {
            if (isset($_GET['component'])) {
                $componentName = cleanString($_GET['component']);
                if (file_exists("controller/$componentName.php")) {
                    require "controller/$componentName.php";
                }
            }
        } else {
            require 'controller/login.php';
        }
        exit();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
            integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <title>Géolocalisation</title>
    <link
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            rel="stylesheet"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
            crossorigin=""
    >
    <script
            src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""
    >
    </script>
</head>
<body>
<?php
    require '_partials/errors.php';

    if(isset($_SESSION['auth'])){
        require "_partials/navbar.php";
        if(isset($_GET['component'])){
            $componentName= cleanString($_GET['component']);
            if(file_exists("controller/$componentName.php")){
                require "controller/$componentName.php";
            }
        }
    }else {
        require 'controller/login.php';
    }
    require "_partials/errors.php";
?>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>
</body>
</html>