<!DOCTYPE html>
<html lang="pl">

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

        <div class="answers">

            <table class="table table-striped table-bordered">

                <thead class="thead-dark">

                    <tr>
                        <th scope="col">Pytanie</th>
                        <th scope="col">Odpowiedź A</th>
                        <th scope="col">Odpowiedź B</th>
                        <th scope="col">Odpowiedź C</th>
                        <th scope="col">Odpowiedź D</th>
                        <th scope="col">Twoja Odpowiedź</th>
                        <th scope="col">Poprawna Odpowiedź</th>
                    </tr>

                </thead>

                <?php
                session_start();

                // połączenie z bazą danych
                require('../examplePassword.php');
                $mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

                // pytania które wylosował użytkownik oraz jego odpowiedzi
                $userQuestions = $_SESSION['questions'];
                $answers = $_SESSION['userAnswers'];

                foreach ($userQuestions as $index => $questionId) {

                    echo '<script type="text/javascript">console.log("odpowiedź ' . $questionId . '");</script>';
                    echo '<script type="text/javascript">console.log("odpowiedź ' . $answers[$index] . '");</script>';

                    // jeśli znajdziemy taki rekord oznacza to że użytkownik poprawnie odpowiedział na pytanie
                    $checkIfCorrect = "SELECT * FROM `que` WHERE id=$questionId AND correctAnswer='$answers[$index]'";
                    $correct = $mysqli->query($checkIfCorrect);

                    if ($rec = $correct->fetch_array()) {

                        echo '<tr class="correct">
                                <td class="color">' . $rec['content'] . '</td>
                                <td class="color">' . $rec['answerA'] . '</td>
                                <td class="color">' . $rec['answerB'] . '</td>
                                <td class="color">' . $rec['answerC'] . '</td>
                                <td class="color">' . $rec['answerD'] . '</td>
                                <td>' . $answers[$index] . '</td>
                                <td class="correctAnswer">' . $rec['correctAnswer'] . '</td>
                            </tr>';
                    } else {

                        // w przypadku niepoprawnej odpowiedzi wysyłamy zapytanie o pytanie z id i wyświetlamy
                        $getQuestion = "SELECT * FROM `que` WHERE id=$questionId";
                        $question = $mysqli->query($getQuestion);

                        while ($rec = $question->fetch_array()) {
                            echo '<tr class="incorrect">
                                    <td class="color">' . $rec['content'] . '</td>
                                    <td class="color">' . $rec['answerA'] . '</td>
                                    <td class="color">' . $rec['answerB'] . '</td>
                                    <td class="color">' . $rec['answerC'] . '</td>
                                    <td class="color">' . $rec['answerD'] . '</td>
                                    <td>' . $answers[$index] . '</td>
                                    <td class="correctAnswer">' . $rec['correctAnswer'] . '</td>
                                </tr>';
                        }
                    }
                }

                ?>

                <table>
        </div>

    </div>

</body>