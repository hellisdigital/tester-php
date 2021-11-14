<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki użytkowników</title>

    <!-- bootstrap  -->
    <script type="javascript" src="../libs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../libs/bootstrap.min.css">

    <link rel="stylesheet" href="../css/userStyle.css">

</head>

<body>
    <div class="root">

        <nav class="navbar navbar-expand-lg navbar-dark">

            <a href="#" class="navbar-brand">Panel użytkownika</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="game.php">Zagraj</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scores.php">Wyniki</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Wyloguj</a>
                    </li>

                </ul>

            </div>
        </nav>

        <div class="tableDiv">

            <h3>10 Użytkowników Z Najlepszymi Wynikami</h3>

            <table border=1 class="table table-striped table-bordered">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nazwa Użytkownika</th>
                        <th scope="col">Ilość Odpowiedzi Poprawnych</th>
                        <th scope="col">Ilość Odpowiedzi Niepoprawnych</th>
                        <th scope="col">Procent Odpowiedzi Poprawnych</th>
                    </tr>
                </thead>

                <?php

                // połączenie z bazą danych
                $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');

                // komenda sql do wyliczenia procentowej ilości poprawnych odpowiedzi udzielanych przez użytkownika
                $getUsers = "SELECT * FROM `users` WHERE isAdmin=0 ORDER BY correctCount/(incorrectCount+correctCount) DESC ";
                $usersScores = $mysqli->query($getUsers) or die('Problem z bazą danych');


                while ($rec = $usersScores->fetch_array()) {

                    // kiedy użytkownik nie udzielił żadnych odpowiedzi
                    if ($rec['correctCount'] + $rec['incorrectCount'] == 0) {
                        $correctProcentage = 'brak odpowiedzi';
                    } else {
                        $correctProcentage = $rec['correctCount'] / ($rec['correctCount'] + $rec['incorrectCount']) * 100;
                        $correctProcentage = $correctProcentage . '%';
                    }


                    // wyświetlamy tabelę za pomocą echo
                    echo '<tr>';
                    echo '<td>' . $rec['login'] . '</td>';
                    echo '<td>' . $rec['correctCount'] . '</td>';
                    echo '<td>' . $rec['incorrectCount'] . '</td>';
                    echo '<td>' . $correctProcentage . '</td>';
                    echo '</tr>';
                }
                ?>

            </table>

        </div>

    </div>

</body>

</html>