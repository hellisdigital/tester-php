<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap  -->
    <script type="javascript" src="libs/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="libs/bootstrap.min.css">

    <link rel="stylesheet" href="css/loginStyle.css">
    <title>Zaloguj</title>
</head>


<body>
    <div class="background d-flex justify-content-center align-items-center h-100">

        <div class="mainBox row">
            <div class="loginBox col-sm">
                <h4>Zaloguj się</h4>
                <form action="?action=login" method="POST">
                    <div class="mb-3">
                        <label for="loginInput" class="form-label">Login</label>
                        <input id="loginInput" type="text" class="form-control" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Hasło</label>
                        <input id="passwordInput" type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj</button>
                </form>
            </div>
            <div class="registerBox col-sm">
                <h4>Zarejstruj się</h4>
                <form action="?action=register" method="POST">
                    <div class="mb-3">
                        <label for=loginInputRegister" class="form-label">Login</label>
                        <input id="loginInputRegister" type="text" class="form-control" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for=passwordInputRegister" class="form-label">Hasło</label>
                        <input id="passwordInputRegister" type="password" class="form-control" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for=passwordInputRegisterValid" class="form-label">Powtórz Hasło</label>
                        <input id="passwordInputRegisterValid" type="password" class="form-control" name="login" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Zarejstruj</button>
                </form>
            </div>

        </div>

    </div>
</body>

</html>