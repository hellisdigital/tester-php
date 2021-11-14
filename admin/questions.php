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
                    <div class="form-group form-answer">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerARadio" value="A">
                            <label class="form-check-label" for="answerARadio">A</label>
                        </div>

                        <div class="form-answer-content">
                            <label for="answerAText">Treść Odpowiedzi A</label>
                            <textarea class="form-control" id="answerAText" rows="1" name="answerA"></textarea>
                        </div>

                    </div>
                    <div class="form-group form-answer">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerBRadio" value="B">
                            <label class="form-check-label" for="answerBRadio">B</label>
                        </div>

                        <div class="form-answer-content">
                            <label for="answerBText">Treść Odpowiedzi B</label>
                            <textarea class="form-control" id="answerBText" rows="1" name="answerB"></textarea>
                        </div>

                    </div>
                    <div class="form-group form-answer">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerCRadio" value="C">
                            <label class="form-check-label" for="answerCRadio">C</label>
                        </div>

                        <div class="form-answer-content">
                            <label for="answerCText">Treść Odpowiedzi C</label>
                            <textarea class="form-control" id="answerCText" rows="1" name="answerC"></textarea>
                        </div>

                    </div>
                    <div class="form-group form-answer">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerDRadio" value="D">
                            <label class="form-check-label" for="answerDRadio">D</label>
                        </div>

                        <div class="form-answer-content">
                            <label for="answerD">Treść Odpowiedzi D</label>
                            <textarea class="form-control" id="answerDText" rows="1" name="answerD"></textarea>
                        </div>

                    </div>
                    <div class="form-group form-button">
                        <button type="submit" class="btn btn-success" name="addQuestionButton">Dodaj Pytanie</button>
                    </div>
                </form>
            </div>

        </div>

        <?php

        $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');

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
                        <div class="form-group form-answer">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerARadio" value="A" <?php if ($rec['correctAnswer']  == "A") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="answerARadio">A</label>
                            </div>

                            <div class="form-answer-content">
                                <label for="answerAText">Treść Odpowiedzi A</label>
                                <textarea class="form-control" id="answerAText" rows="1" name="answerA"><?= $rec['answerA'] ?></textarea>
                            </div>

                        </div>
                        <div class="form-group form-answer">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerBRadio" value="B" <?php if ($rec['correctAnswer']  == "B") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="answerBRadio">B</label>
                            </div>

                            <div class="form-answer-content">
                                <label for="answerBText">Treść Odpowiedzi B</label>
                                <textarea class="form-control" id="answerBText" rows="1" name="answerB"><?= $rec['answerB'] ?></textarea>
                            </div>

                        </div>
                        <div class="form-group form-answer">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerCRadio" value="C" <?php if ($rec['correctAnswer']  == "C") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="answerCRadio">C</label>
                            </div>

                            <div class="form-answer-content">
                                <label for="answerCText">Treść Odpowiedzi C</label>
                                <textarea class="form-control" id="answerCText" rows="1" name="answerC"><?= $rec['answerC'] ?></textarea>
                            </div>

                        </div>
                        <div class="form-group form-answer">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="answerDRadio" value="D" <?php if ($rec['correctAnswer']  == "D") {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="answerDRadio">D</label>
                            </div>

                            <div class="form-answer-content">
                                <label for="answerD">Treść Odpowiedzi D</label>
                                <textarea class="form-control" id="answerDText" rows="1" name="answerD"><?= $rec['answerD'] ?></textarea>
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

        $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            switch ($_GET['action']) {

                case 'addQuestion':
                    $question = $_POST['questionContent'];
                    $answerA = $_POST['answerA'];
                    $answerB = $_POST['answerB'];
                    $answerC = $_POST['answerC'];
                    $answerD = $_POST['answerD'];
                    $radio = $_POST['inlineRadioOptions'];

                    $addQuestion = "INSERT INTO `que` (content, answerA, answerB, answerC, answerD , correctAnswer, correctAnswers, incorrectAnswers) VALUES ('$question','$answerA','$answerB','$answerC', '$answerD', '$radio', 0, 0)";

                    if ($mysqli->query($addQuestion) == true) {

                        echo '<script type="text/javascript">alert("Pytanie Dodane")</script>';
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