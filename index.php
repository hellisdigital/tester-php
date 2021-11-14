<?php

//rozpoczęcie sesji php
session_start();

// połączenie z bazą danych
require('examplePassword.php');
$mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

//$mysqli->set_charset('utf8mb4');
echo '<script type="text/javascript">console.log("połączono z bazą danych");</script>';

// w przypadku sesji ustawionej na zmienną adminSession zwracamy panel admina
if (isset($_SESSION['adminSession'])) {
    return header('location: admin/scores.php');
}

// w przypadku id użytkownika zwracamy stronę użytkownika
if (isset($_SESSION['userId'])) {
    return header('location: user/scores.php');
}

// W przypadku zapytania post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_GET['action']) {

            // w przypadku otrzymania akcji "login"
        case 'login':

            // $_POST['name'] 
            $login = $_POST['loginInput'];
            print_r($login);

            $hashedPassword = hash('sha256', $_POST['passwordInput']);

            $searchUser = "SELECT * FROM `users` WHERE login = '$login' LIMIT 1";
            $search_result = $mysqli->query($searchUser) or die('Problem z bazą danych');

            if ($rec = $search_result->fetch_array()) {

                if ($hashedPassword == $rec['password']) {
                    echo '<script type="text/javascript">console.log("poprawne hasło");</script>';

                    if ($rec['isAdmin'] == 1) {

                        $_SESSION['adminSession'] = true;
                        header('location: admin/scores.php');
                    } else {

                        $_SESSION['userId'] = $rec['id'];
                        header('location: user/scores.php');
                    }
                } else {

                    echo '<script type="text/javascript">alert("Niepoprawne hasło")</script>';
                    break;
                }
            } else {

                echo '<script type="text/javascript">alert("Użytkownik nie istnieje")</script>';
                break;
            }
            break;

            // w przypadku otrzymania akcji "register"
        case 'register':

            $loginRegister = $_POST['loginInputRegister'];
            $passwordRegister = $_POST['passwordInputRegister'];
            $passwordRegisterValidate = $_POST['passwordInputRegisterValid'];

            if (strlen($loginRegister) < 6) {

                echo '<script type="text/javascript">alert("Login powinnien składać się z przynajmniej 6 znaków")</script>';
                break;
            }

            if (strlen($passwordRegister) < 6) {

                echo '<script type="text/javascript">alert("Hasło powinno składać się z przynajmniej 6 znaków")</script>';
                break;
            }

            if ($passwordRegister !=  $passwordRegisterValidate) {
                echo '<script type="text/javascript">alert("Hasła nie są takie same")</script>';
                break;
            }

            $searchUser = "SELECT * FROM `users` WHERE login = '$loginRegister' LIMIT 1";
            $search_result = $mysqli->query($searchUser) or die('Problem z bazą danych');

            if ($search_result->fetch_array()) {

                echo '<script type="text/javascript">alert("Nazwa użytkownika: ' . $loginRegister . ' jest zajęta")</script>';
                break;
            } else {

                $hashedPassword = hash('sha256', $passwordRegister);
                $addUser = "INSERT INTO `users` (login, password, isAdmin, correctCount, incorrectCount) VALUES ('$loginRegister', '$hashedPassword', 0,0,0)";

                if ($mysqli->query($addUser) == true) {

                    echo '<script type="text/javascript">alert("Konto: ' . $loginRegister . ' utworzone. Możesz się teraz zalogować")</script>';
                    break;
                }
            }

            break;
    }
}

?>



<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie Do Strony</title>

    <!-- bootstrap  -->
    <script type="javascript" src="libs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="libs/bootstrap.min.css">

    <link rel="stylesheet" href="css/loginStyle.css">

</head>


<body>

    <div class="background d-flex justify-content-center align-items-center h-100">

        <div class="mainBox row">

            <div class="loginBox col-sm">

                <h4>Zaloguj się</h4>

                <form action="?action=login" method="POST">

                    <div class="mb-3">

                        <label for="loginInput" class="form-label">Login</label>
                        <input id="loginInput" type="text" class="form-control" name="loginInput" required>
                    </div>
                    <div class="mb-3">

                        <label for="passwordInput" class="form-label">Hasło</label>
                        <input id="passwordInput" type="password" class="form-control" name="passwordInput" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj</button>

                </form>

            </div>

            <div class="registerBox col-sm">

                <h4>Zarejstruj się</h4>

                <form action="?action=register" method="POST">

                    <div class="mb-3">

                        <label for=loginInputRegister" class="form-label">Login</label>
                        <input id="loginInputRegister" type="text" class="form-control" name="loginInputRegister" required>
                    </div>
                    <div class="mb-3">

                        <label for=passwordInputRegister" class="form-label">Hasło</label>
                        <input id="passwordInputRegister" type="password" class="form-control" name="passwordInputRegister" required>
                    </div>
                    <div class="mb-3">

                        <label for=passwordInputRegisterValid" class="form-label">Powtórz Hasło</label>
                        <input id="passwordInputRegisterValid" type="password" class="form-control" name="passwordInputRegisterValid" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zarejstruj</button>

                </form>

            </div>
        </div>
    </div>

</body>

</html>