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
        <div class="tableDiv">

            <table border=1 class="table table-striped table-bordered">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <td scope="col">Nazwa Użytkownika</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Poprawne Odpowiedzi</th>
                        <th scope="col">Niepoprawne Odpowiedzi</th>
                        <th scope="col">Usuń Użytkownika</th>
                    </tr>
                </thead>
                <?php

                // połączenie z bazą danych
                $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');

                // Bierzemy wszystkich użytkowników
                $getAllUsers = "SELECT * FROM `users`";
                $allUsers = $mysqli->query($getAllUsers);

                while ($rec = $allUsers->fetch_array()) :

                ?>

                    <tr>
                        <td><?= $rec['id'] ?></td>
                        <td><?= $rec['login'] ?></td>
                        <td><?= $rec['isAdmin'] ?></td>
                        <td><?= $rec['correctCount'] ?></td>
                        <td><?= $rec['incorrectCount'] ?></td>
                        <td>
                            <form action="?action=delete" method="POST">
                                <button type="submit" class="btn btn-danger" name="deleteButton" value='<?= $rec['id'] ?>'>Usuń Użytkownika!</button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($_GET['action'] == 'delete') {

            $mysqli = mysqli_connect('localhost', 'root', '', 'pytania');
            $id = $_POST['deleteButton'];

            $deleteUser =  "DELETE  FROM `users` WHERE id = '$id'";

            $deletedUser = $mysqli->query($deleteUser) or die('Problem z bazą danych');

            echo '<script type="text/javascript">alert("Usunięto użytkownika");window.location.href = "users.php";</script>';
        }
    }

    ?>

</body>

</html>