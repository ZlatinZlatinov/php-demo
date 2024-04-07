<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <title>Document</title>
</head>

<body>
    <?php
    require("./views/components/header.php");
    ?>

    <?php

    $request = $_SERVER['REQUEST_URI'];
  
    $viewDir = '/views/';

    switch ($request) {
        case '/app-demo/':
        case '/app-demo/home':
            require __DIR__ . $viewDir . 'home.php';
            break;

        case '/app-demo/about':
            require __DIR__ . $viewDir . 'about.php';
            break;

        case '/app-demo/catalog':
            require __DIR__ . $viewDir . 'catalog.php';
            break;

        case '/app-demo/create':
            require __DIR__ . $viewDir . 'create.php';
            break;

        case '/app-demo/login':
            require __DIR__ . $viewDir . 'login.php';
            break;

        case '/app-demo/register':
            require __DIR__ . $viewDir . 'register.php';
            break; 

            case '/app-demo/logout':
                session_destroy(); 
                header("Location: ./home");
                break;
        default:
            http_response_code(404);
            require __DIR__ . $viewDir . '404.php';
    }
    ?>
</body>

</html>