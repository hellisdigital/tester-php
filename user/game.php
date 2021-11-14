<?php

session_start();

// połączenie z bazą danych
require('../examplePassword.php');
$mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_GET['action'] == "checkAnswers") {

        // id użytkownika
        $userId = $_SESSION['userId'];

        // wszystkie numery pytań do sprawdzenia
        $questionsDecoded = json_decode($_POST['questionsIds']);

        // array z odpowiedziamy użytkownika (do sprawdzania wyświetlania odpowiedzi)
        $userAnswers = array();

        // zmienne do przechowywania ilości odpowiedzi poprawnych / niepoprawnych użytkownika
        $correctUserAnswers = 0;
        $incorrectUserAnswers = 0;

        //echo '<script type="text/javascript">console.log("połączono z bazą danych' . $userId . '");</script>';

        foreach ($questionsDecoded as $questionId) {

            //echo '<script type="text/javascript">console.log("pytanie' . $questionId . '");</script>';


            // dodajemy do tablicy odpowiedź użytkownika 
            $radioAnswer = $_POST["inlineRadioOptions" . $questionId];
            array_push($userAnswers, $radioAnswer);

            //echo '<script type="text/javascript">console.log("odpowiedź ' . $radioAnswer . '");</script>';

            // jeśli znajdziemy taki rekord oznacza to że użytkownik poprawnie odpowiedział na pytanie
            $checkIfCorrect = "SELECT * FROM `que` WHERE id=$questionId AND correctAnswer='$radioAnswer'";
            $correct = $mysqli->query($checkIfCorrect);

            if ($correct->fetch_array()) {

                // aktualizujemy ilość poprawnych odpowiedzi dla użytkownika i pytania
                $correctUserAnswers = $correctUserAnswers + 1;
                $updateQuestionCorrectAnswers = "UPDATE `que` SET correctAnswers = correctAnswers + 1 WHERE id=$questionId";
                $updatedCorrectAnswers = $mysqli->query($updateQuestionCorrectAnswers);

                //echo '<script type="text/javascript">console.log("odpowiedź poprawna");</script>';

            } else {

                // aktualizujemy ilość niepoprawnych odpowiedzi dla użytkownika i pytania
                $incorrectUserAnswers = $incorrectUserAnswers + 1;
                $updateQuestionIncorrectAnswers = "UPDATE `que` SET incorrectAnswers = incorrectAnswers + 1 WHERE id=$questionId";
                $updatedIncorrectAnswers = $mysqli->query($updateQuestionIncorrectAnswers);

                //echo '<script type="text/javascript">console.log("odpowiedź niepoprawna");</script>';

            }
        }


        // aktualizujemy ilość poprawnych odpowiedzi dla użytkownika
        $updateUserCorrectAnswers = "UPDATE `users` SET correctCount = correctCount + $correctUserAnswers WHERE id=$userId";
        $updatedUserCorrectAnswers = $mysqli->query($updateUserCorrectAnswers);

        // aktualizujemy ilość niepoprawnych odpowiedzi dla użytkownika
        $updateUserIncorrectAnswers = "UPDATE `users` SET incorrectCount = incorrectCount + $incorrectUserAnswers WHERE id=$userId";
        $updatedUserIncorrectAnswers = $mysqli->query($updateUserIncorrectAnswers);

        // wyliczenie procentu ilości poprawnych odpowiedzi i wyświetlenie komunikatu
        $correctAnswersPrcent = ($correctUserAnswers / ($correctUserAnswers + $incorrectUserAnswers)) * 100;
        echo '<script type="text/javascript">alert("Odpowiedzi Poprawne: ' . $correctUserAnswers . ' Odpowiedzi Niepoprawne: ' . $incorrectUserAnswers . ' Procent odpowiedzi poprawnych ' . $correctAnswersPrcent . '%")</script>';

        // w zmiennej session ustawiamy pytania i odpowiedzi użytkownika ( używane do wyświetlenia poprawnych i niepoprawnych odpowiedzi użytkownika)
        $_SESSION['questions'] = $questionsDecoded;
        $_SESSION['userAnswers'] = $userAnswers;
        echo "<script> location.href='answers.php'; </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zagraj</title>

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


        <div class="gameDiv">

            <form action="?action=checkAnswers" method="POST">

                <table border=1 class="table table-striped table-bordered">

                    <tr>
                        <th>Pytanie</th>
                        <th>Odpowiedź A</th>
                        <th>Odpowiedź B</th>
                        <th>Odpowiedź C</th>
                        <th>Odpowiedź D</th>
                    </tr>


                    <?php

                    // połączenie z bazą danych
                    require('../examplePassword.php');
                    $mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

                    // zmienna do przechowywania wszystkich wylosowanych pytań
                    $allSelQueIds = array();

                    // losujemy 10 niepowtarzalnych pytań
                    $getQuestions = "SELECT * FROM `que` ORDER BY RAND() LIMIT 10";
                    $allQuestions = $mysqli->query($getQuestions);

                    // dodajemy pytania do $allSelQueIds
                    while ($rec = $allQuestions->fetch_array()) :

                        array_push($allSelQueIds, $rec['id']);

                    ?>

                        <tr id="tableRow<?= $rec['id'] ?>">

                            <td>
                                <h4 class="questionContent"> <?= $rec['content'] ?></h4>
                            </td>

                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='inlineRadioOptions<?= $rec['id'] ?>' id="answerARadio" value="A" required>
                                    <label class="form-check-label" for="answerARadio">A</label>
                                </div>
                                <h4> <?= $rec['answerA'] ?></h4>
                            </td>

                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='inlineRadioOptions<?= $rec['id'] ?>' id="answerBradio" value="B" required>
                                    <label class="form-check-label" for="answerBRadio">B</label>
                                </div>
                                <h4> <?= $rec['answerB'] ?></h4>
                            </td>

                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='inlineRadioOptions<?= $rec['id'] ?>' id="answerCRadio" value="C" required>
                                    <label class="form-check-label" for="answerCRadio">C</label>
                                </div>
                                <h4> <?= $rec['answerC'] ?></h4>
                            </td>

                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='inlineRadioOptions<?= $rec['id'] ?>' id="answerDRadio" value="D" required>
                                    <label class="form-check-label" for="answerDRadio">D</label>
                                </div>
                                <h4> <?= $rec['answerD'] ?></h4>
                            </td>

                        </tr>



                    <?php endwhile; ?>

                </table>

                <!-- input z wszystkimi wylosowanymi pytaniami (można również przechowywać w session) -->
                <input type="hidden" name="questionsIds" value='<?php echo json_encode($allSelQueIds) ?>'>
                <div class="form-group form-button">
                    <button type="submit" class="btn btn-success" name="checkAnswers">Sprawdź odpowiedzi</button>
                </div>

            </form>

        </div>

    </div>

</body>

</html>