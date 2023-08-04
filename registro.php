 <!doctype html>
 <html lang="pt-br">

 <head>
     <title>SISTEMA DE CADASTRO</title>
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


         <h1 class="text-center">Registro de Usuarios</h1>


         <?php
            if (isset($_POST["submit"])) {
                $fullname = $_POST["fullname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $repeat_password = $_POST["repeat_password"];

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($fullname) || empty($email) || empty($password) || empty($repeat_password)) {
                    array_push($errors, "Preencha todos os campos");
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Preencha Um Email valido");
                }
                if (strlen($password) < 4) {
                    array_push($errors, "Preencha Uma Senha Maior ou Igual a 8 Caracteres");
                }
                if ($password !== $repeat_password) {
                    array_push($errors, "As Senhas Não Coincidem");
                }

                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {

                    array_push($errors, "O Email ja foi Cadastrado");
                }



                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    //Codigo para inserir Dados

                    $sql = "INSERT INTO users (fullname, email, password) VALUES ( ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-sucesss'>Dados Registrados com Sucesso.</div>";
                    } else {

                        die("Dados não Cadastrados");
                    }
                }
            }

            ?>


         <form action="registro.php" method="post">
             <div class="form-group">
                 <input type="text" class="form-control" name="fullname" placeholder="Nome Completo">
             </div>
             <div class="form-group">
                 <input type="email" class="form-control" name="email" placeholder="Email">
             </div>
             <div class="form-group">
                 <input type="password" class="form-control" name="password" placeholder="Password">
             </div>
             <div class="form-group">
                 <input type="password" class="form-control" name="repeat_password" placeholder="Reedigite sua Senha">
             </div>
             <div class="form-btn">
                 <input type="submit" class="btn btn-primary" value="Registrar" name="submit">
             </div>
         </form>
         <div>
             <p>Está registrado? <a href="logim.PHP">Faça o seu Login Aqui!</a></p>
         </div>
     </div>

     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </body>

 </html>