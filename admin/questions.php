<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora</title>

    <!-- bootstrap  -->
    <script type="text/javascript" src="../libs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../libs/bootstrap.min.css">

    <link rel="stylesheet" href="../css/adminStyle.css">

</head>

<body>
    <div class="root">
        <nav class="navbar navbar-expand-lg navbar-dark">

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
        <div class="addQuestion">

            <div class="questionDiv">

                <form action="?action=addQuestion" method="POST" class="addQuestionForm">

                    <div class="form-group">

                        <label for="exampleFormControlTextarea1">Treść Pytania</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="questionContent"></textarea>

                    </div>

                    <div class="form-group form-answer formAnswer">
                        <div>
                            <label for="addAnswerARadio">Treść Odpowiedzi A</label>
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="addAnswerARadio" value="A" aria-label="Radio button for following text input">
                            </div>
                            <input type="text" class="form-control" id="addAnswerAText" aria-label="Text input with radio button" name="addAnswerA">

                        </div>

                    </div>

                    <div class="form-group form-answer formAnswer">
                        <label for="addAnswerBRadio">Treść Odpowiedzi B</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="addAnswerBRadio" value="B" aria-label="Radio button for following text input">
                            </div>
                            <input type="text" class="form-control" id="addAnswerBText" aria-label="Text input with radio button" name="addAnswerB">

                        </div>

                    </div>

                    <div class="form-group form-answer formAnswer">
                        <label for="addAnswerCRadio">Treść Odpowiedzi C</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="addAnswerCRadio" value="C" aria-label="Radio button for following text input">
                            </div>
                            <input type="text" class="form-control" id="addAnswerCText" aria-label="Text input with radio button" name="addAnswerC">

                        </div>

                    </div>

                    <div class="form-group form-answer formAnswer">
                        <label for="addAnswerDRadio">Treść Odpowiedzi D</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="addAnswerDRadio" value="D" aria-label="Radio button for following text input">
                            </div>
                            <input type="text" class="form-control" id="addAnswerDText" aria-label="Text input with radio button" name="addAnswerD">

                        </div>

                    </div>
                    <div class="form-group form-button">
                        <button type="submit" class="btn btn-success" name="addQuestionButton">Dodaj Pytanie</button>
                    </div>
                </form>
            </div>

        </div>

        <?php

        // połączenie z bazą danych
        require('../examplePassword.php');
        $mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

        $getAllQuestions = "SELECT * FROM `que`";

        $allQuestions = $mysqli->query($getAllQuestions);

        while ($rec = $allQuestions->fetch_array()) :
        ?> <div class="addQuestion">

                <div class="questionDiv">

                    <form action="?action=updateQuestion" method="POST" class="addQuestionForm">

                        <div class="form-group">

                            <label for="exampleFormControlTextarea1">Treść Pytania</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="questionContent"><?= $rec['content'] ?></textarea>

                        </div>

                        <div class="form-group form-answer formAnswer">
                            <div>
                                <label for="AnswerARadio">Treść Odpowiedzi A</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="AnswerARadio" value="A" aria-label="Radio button for following text input" <?php if ($rec['correctAnswer'] == "A") {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?>>
                                </div>
                                <input type="text" class="form-control" id="AnswerAText" aria-label="Text input with radio button" value="<?= $rec['answerA'] ?>" name="answerA">
                            </div>
                        </div>

                        <div class="form-group form-answer formAnswer">
                            <div>
                                <label for="AnswerBRadio">Treść Odpowiedzi B</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="AnswerBRadio" value="B" aria-label="Radio button for following text input" <?php if ($rec['correctAnswer'] == "B") {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?>>
                                </div>
                                <input type="text" class="form-control" id="AnswerBText" aria-label="Text input with radio button" value="<?= $rec['answerB'] ?> " name="answerB">
                            </div>
                        </div>


                        <div class="form-group form-answer formAnswer">
                            <div>
                                <label for="AnswerCRadio">Treść Odpowiedzi C</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="AnswerCRadio" value="C" aria-label="Radio button for following text input" <?php if ($rec['correctAnswer'] == "C") {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?>>
                                </div>
                                <input type="text" class="form-control" id="AnswerCText" aria-label="Text input with radio button" value="<?= $rec['answerC'] ?>" name="answerC">
                            </div>
                        </div>


                        <div class="form-group form-answer formAnswer">
                            <div>
                                <label for="AnswerDRadio">Treść Odpowiedzi D</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" name="inlineRadioOptions" id="AnswerDRadio" value="D" aria-label="Radio button for following text input" <?php if ($rec['correctAnswer'] == "D") {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?>>
                                </div>
                                <input type="text" class="form-control" id="AnswerDText" aria-label="Text input with radio button" value="<?= $rec['answerD'] ?>" name="answerD">
                            </div>
                        </div>

                        <div class="form-group form-button">
                            <button type="submit" class="btn btn-warning" name="updateQuestionButton" value="<?= $rec['id'] ?>">Zaaktualizuj pytanie</button>
                        </div>


                    </form>

                    <div class="form-button">

                        <form action="?action=deleteQuestion" method="POST">

                            <button type="submit" class="btn btn-danger" name="deleteQuestionButton" value="<?= $rec['id'] ?>">Usuń Pytanie</button>

                        </form>

                    </div>
                </div>
            </div>

        <?php endwhile; ?>



        <?php

        // połączenie z bazą danych
        require('../examplePassword.php');
        $mysqli = mysqli_connect($databaseAddress, $databaseUsername, $databasePassword, $databaseName);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            switch ($_GET['action']) {

                case 'addQuestion':
                    $question = $_POST['questionContent'];
                    $answerA = $_POST['addAnswerA'];
                    $answerB = $_POST['addAnswerB'];
                    $answerC = $_POST['addAnswerC'];
                    $answerD = $_POST['addAnswerD'];
                    $radio = $_POST['inlineRadioOptions'];

                    $addQuestion = "INSERT INTO `que` (content, answerA, answerB, answerC, answerD , correctAnswer, correctAnswers, incorrectAnswers) VALUES ('$question','$answerA','$answerB','$answerC', '$answerD', '$radio', 0, 0)";

                    if ($mysqli->query($addQuestion) == true) {

                        echo '<script type="text/javascript">alert("Pytanie Dodane");window.location.href = "questions.php";</script>';
                    }

                    break;

                case 'updateQuestion':

                    $question = $_POST['questionContent'];
                    $answerA = $_POST['answerA'];
                    $answerB = $_POST['answerB'];
                    $answerC = $_POST['answerC'];
                    $answerD = $_POST['answerD'];
                    $id = $_POST['updateQuestionButton'];
                    $radio = $_POST['inlineRadioOptions'];

                    echo '<script type="text/javascript">alert("Pytanie Zaktualizowane ' . $answerA . ' ")</script>';

                    $updateQue = "UPDATE `que` SET content='$question', answerA='$answerA', answerB='$answerB', answerC='$answerC', answerD='$answerD', correctAnswer='$radio' WHERE id='$id' ";
                    $updatedQue =  $mysqli->query($updateQue) or die('Problem z bazą danych');

                    echo '<script type="text/javascript">alert("Pytanie Zaktualizowane");window.location.href = "questions.php";</script>';

                    break;

                case 'deleteQuestion':

                    $id = $_POST['deleteQuestionButton'];

                    $deleteQuestion =  "DELETE  FROM `que` WHERE id = '$id'";

                    $deletedQue = $mysqli->query($deleteQuestion);

                    echo '<script type="text/javascript">alert("Usunięto pytanie");window.location.href = "questions.php";</script>';
            }
        }

        ?>

    </div>
</body>