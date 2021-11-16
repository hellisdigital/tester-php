<?php session_start() ?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie Do Strony</title>

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/loginStyle.css">

</head>



<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Komunikat!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    safsf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>

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


    <script src="js/createModal.js"></script>
</body>

</html>


<?php

//rozpoczęcie sesji php
//session_start();

// połączenie z bazą danych
require('examplePassword.php');
$mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

//$mysqli->set_charset('utf8mb4');
echo '<script type="text/javascript">console.log("połączono z bazą danych");</script>';

// w przypadku sesji ustawionej na zmienną adminSession zwracamy panel admina
if (isset($_SESSION['adminSession'])) {
    echo '<script type="text/JavaScript"> 
            window.location.href = "admin/scores.php";
            </script>';
}

// w przypadku id użytkownika zwracamy stronę użytkownika
if (isset($_SESSION['userId'])) {
    echo '<script type="text/JavaScript"> 
            window.location.href = "user/scores.php";
            </script>';
}

// W przypadku zapytania post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_GET['action']) {

            // w przypadku otrzymania akcji "login"
        case 'login':


            // $_POST['name'] 
            $login = $_POST['loginInput'];

            // hasło hashowane sha256
            $hashedPassword = hash('sha256', $_POST['passwordInput']);

            // sprawdzamy czy użytkownik istnieje
            $searchUser = "SELECT * FROM `users` WHERE login = '$login' LIMIT 1";
            $search_result = $mysqli->query($searchUser) or die('Problem z bazą danych');

            if ($rec = $search_result->fetch_array()) {

                // sprawdzamy czy hasło się zgadza
                if ($hashedPassword == $rec['password']) {

                    echo '<script type="text/javascript">console.log("poprawne hasło");</script>';


                    // sprawdzamy czy użytkownik jest adminem
                    if ($rec['isAdmin'] == 1) {
                        flush();
                        $_SESSION['adminSession'] = true;
                        echo '<script type="text/JavaScript"> 
                        window.location.href = "admin/scores.php";
                        </script>';
                    } else {
                        $_SESSION['userId'] = $rec['id'];
                        echo '<script type="text/JavaScript"> 
                        window.location.href = "user/scores.php";
                        </script>';
                    }
                } else {

                    // jeśli użytkownik podał nieprawidłowe hasło wyświetlamy komunikat
                    //echo '<script type="text/javascript">alert("Niepoprawne hasło")</script>';
                    echo  '<script type="text/javascript"> 
                            document.getElementsByClassName("modal-body")[0].innerHTML = "Niepoprawne hasło";
                            myModal.show();
                            </script>';
                    break;
                }
            } else {

                // jeśli użytkownik nie istnieje wyświetlamy komunikat
                echo  '<script type="text/javascript"> 
                document.getElementsByClassName("modal-body")[0].innerHTML = "Użytkownik o podanej nazwie nie istnieje";
                myModal.show();
                </script>';
                //echo '<script type="text/javascript">alert("Użytkownik nie istnieje")</script>';
                break;
            }
            break;

            // w przypadku otrzymania akcji "register"
        case 'register':

            $loginRegister = $_POST['loginInputRegister'];
            $passwordRegister = $_POST['passwordInputRegister'];
            $passwordRegisterValidate = $_POST['passwordInputRegisterValid'];

            // login ma mniej niż 6 znaków
            if (strlen($loginRegister) < 6) {

                echo  '<script type="text/javascript"> 
                document.getElementsByClassName("modal-body")[0].innerHTML = "Login powinnien składać się z przynajmniej 6 znaków";
                myModal.show();
                </script>';

                break;
            }

            // hasło ma mniej niż 6 znaków
            if (strlen($passwordRegister) < 6) {

                //echo '<script type="text/javascript">alert("Hasło powinno składać się z przynajmniej 6 znaków")</script>';
                echo  '<script type="text/javascript"> 
                document.getElementsByClassName("modal-body")[0].innerHTML = "Hasło powinno składać się z przynajmniej 6 znaków";
                myModal.show();
                </script>';
                break;
            }

            // hasła się nie zgadzają
            if ($passwordRegister !=  $passwordRegisterValidate) {
                // echo '<script type="text/javascript">alert("Hasła nie są takie same")</script>';
                echo  '<script type="text/javascript"> 
                document.getElementsByClassName("modal-body")[0].innerHTML = "Hasła nie są takie same";
                myModal.show();
                </script>';
                break;
            }

            // szukamy użytkownika z taką samą nazwą 
            $searchUser = "SELECT * FROM `users` WHERE login = '$loginRegister' LIMIT 1";
            $search_result = $mysqli->query($searchUser) or die('Problem z bazą danych');

            // jeśli wynik zwróci użytkownika => użytkownik istnieje, nie możemy go zarejstrować po raz drugi
            if ($search_result->fetch_array()) {

                echo  '<script type="text/javascript"> 
                document.getElementsByClassName("modal-body")[0].innerHTML = "Nazwa użytkownika: ' . $loginRegister . ' jest zajęta";
                myModal.show();
                </script>';
                //echo '<script type="text/javascript">alert("Nazwa użytkownika: ' . $loginRegister . ' jest zajęta")</script>';
                break;
            } else {

                // wstawiamy rekord użytkownika
                $hashedPassword = hash('sha256', $passwordRegister);
                $addUser = "INSERT INTO `users` (login, password, isAdmin, correctCount, incorrectCount) VALUES ('$loginRegister', '$hashedPassword', 0,0,0)";

                // jeśli operacja się powiedzie wyświetlamy komunikat
                if ($mysqli->query($addUser) == true) {

                    echo  '<script type="text/javascript"> 
                    document.getElementsByClassName("modal-body")[0].innerHTML = "Konto: ' . $loginRegister . ' utworzone. Możesz się teraz zalogować";
                    myModal.show();
                    </script>';
                    //echo '<script type="text/javascript">alert("Konto: ' . $loginRegister . ' utworzone. Możesz się teraz zalogować")</script>';
                    break;
                }
            }
            break;
    }
}
?>