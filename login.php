<!doctype html>
<html lang="en">

<head>
    <title>SISTEMA DE LOGIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">Usuarios Registrados</h1>
        
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {


                if (password_verify($password, $user["password"])) {

                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");


                    die();
                } else {

                    echo "<div class='alert alert-danger'>A Senha inserida esta Errada</div>";
                }
            } else {

                echo "<div class='alert alert-danger'>O email inserido não Existe</div>";
            }
        }

        ?>


        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Insira seu Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Insira Sua Senha:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">

                <div>
                    <p>Não Está registrado? <a href="REGISTRATION.PHP">Registre-se Aqui!</a></p>
                </div>

            </div>
        </form>
    </div>
</body>

</html>