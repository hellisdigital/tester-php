<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>

    <!-- bootstrap  -->
    <script type="javascript" src="../libs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../libs/bootstrap.min.css">

    <link rel="stylesheet" href="../css/adminStyle.css">

</head>

<body>
    <div class="root">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <a href="#" class="navbar-brand">Panel Administratora</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Użytkownicy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="questions.php">Pytania</a>
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

            <h3>10 Użytkowników z najlepszymi wynikami</h3>

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

                // wykonanie komendy
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

            <h3>10 Najtrudniejszych Pytań</h3>

            <table border=1 class="table table-striped table-bordered">

                <thead class="thead-dark">
                    <tr>
                        <th>Treść Pytania</th>
                        <th>Odpowiedż Poprawna</th>
                        <th>Ilość Odpowiedzi Poprawnych</th>
                        <th>Ilość Odpowiedzi Niepoprawnych</th>
                        <th>Procent Odpowiedzi Poprawnych</th>
                    </tr>
                </thead>

                <?php

                // połączenie z bazą danych
                $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');

                // komenda sql do wyliczenia procentowej ilość poprawnych odpowiedzi
                //$getQuestions = "SELECT * FROM `que` WHERE incorrectAnswers+correctAnswers!=0 ORDER BY correctAnswers/(incorrectAnswers+correctAnswers) , incorrectAnswers DESC LIMIT 10  ";
                $getQuestions = "SELECT * FROM `que` ORDER BY correctAnswers/ISNULL(incorrectAnswers+correctAnswers) , incorrectAnswers DESC LIMIT 10  ";

                // wykonanie komendy
                $queScores = $mysqli->query($getQuestions) or die('Problem z bazą danych');

                // dla każdego rekordu 
                while ($rec = $queScores->fetch_array()) :
                    // jeśli suma wszystkich odpowiedzi wynosi 0 ustawiamy zmienną na brak odpowiedzi
                    if ($rec['correctAnswers'] + $rec['incorrectAnswers'] == 0) {
                        $correctProcentage = 'brak odpowiedzi';
                    }
                    // w innych wypadkach dodajemy do 
                    else {
                        $correctProcentage = $rec['correctAnswers'] / ($rec['correctAnswers'] + $rec['incorrectAnswers']) * 100;
                        $correctProcentage = $correctProcentage . '%';
                    }
                ?>

                    <!-- nie pamiętam gdzie to znalazłem ale też działa chyba na lekcji było pokazywane -->

                    <tr>
                        <td><?= $rec['content'] ?></td>
                        <td><?= $rec['answer' . $rec['correctAnswer'] . ''] ?></td> <!-- generuje answer1 itd -->
                        <td><?= $rec['correctAnswers'] ?></td>
                        <td><?= $rec['incorrectAnswers'] ?></td>
                        <td><?= $correctProcentage ?></td>
                    </tr>

                <?php endwhile; ?>

        </div>
    </div>
</body>

</html>