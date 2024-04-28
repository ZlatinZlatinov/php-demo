<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Captcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Php Demo</title>
</head>

<body>
    <?php
    require("./views/components/header.php");
    ?>

    <?php

    $request = parse_url($_SERVER['REQUEST_URI'])["path"];
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

        case '/app-demo/details':
            require __DIR__ . $viewDir . 'details.php';
            break;

        case '/app-demo/create':
            if (isset($_SESSION["isLogged"])) {
                require __DIR__ . $viewDir . 'create.php';
            } else {
                require __DIR__ . $viewDir . 'login.php';
            }

            break; 

            case '/app-demo/edit':
                if (isset($_SESSION["isLogged"])) {
                    require __DIR__ . $viewDir . 'edit.php';
                } else {
                    require __DIR__ . $viewDir . 'login.php';
                }
    
                break;

        case '/app-demo/login':
            if (isset($_SESSION["isLogged"])) {
                require __DIR__ . $viewDir . 'home.php';
            } else {
                require __DIR__ . $viewDir . 'login.php';
            }

            break;

        case '/app-demo/register':
            if (isset($_SESSION["isLogged"])) {
                require __DIR__ . $viewDir . 'home.php';
            } else {
                require __DIR__ . $viewDir . 'register.php';
            }

            break; 

        case '/app-demo/email-verification/':
            require __DIR__ . $viewDir . 'verifyEmail.php';
            break;
        case '/app-demo/logout':
            if (isset($_SESSION["isLogged"])) {
                session_destroy();
                header("Location: ./home");
            } else {
                require __DIR__ . $viewDir . 'home.php';
            }

            break;
        default:
            http_response_code(404);
            require __DIR__ . $viewDir . '404.php';
    }
    ?>
</body>

</html>