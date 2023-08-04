<?php
if (isset($_GET["opcao"])) {
    $opcaoSelecionada = $_GET["id"];

    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "nome_do_banco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificação de erros na conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta SQL para obter os dados da coluna desejada com base na opção selecionada
    $sql = "SELECT id FROM users WHERE id = '$opcaoSelecionada'";
    $result = $conn->query($sql);

    $dados = array();

    // Iteração pelos resultados e adição dos dados ao array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados[] = $row["dados"];
        }
    }

    // Retorna os dados como resposta em formato JSON
    echo json_encode($dados);

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <!-- Formulário para selecionar a opção desejada -->
    <form action="seu_script.php" method="post">
        <select name="opcao" id="opcao" onchange="carregarDados()">
            <option value="">Selecione uma opção</option>
            <option value="opcao1">Opção 1</option>
            <option value="opcao2">Opção 2</option>
            <option value="opcao3">Opção 3</option>
        </select>
    </form>

    <!-- Caixa de combinação HTML que será preenchida dinamicamente -->
    <select name="dados" id="dados">
        <option value="">Selecione uma opção acima</option>
    </select>

    <script>
        function carregarDados() {
            var opcaoSelecionada = document.getElementById("opcao").value;

            // Verifica se uma opção foi selecionada
            if (opcaoSelecionada !== "") {
                // Faz uma requisição AJAX para obter os dados da coluna
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var dados = JSON.parse(xhr.responseText);
                            preencherDados(dados);
                        }
                    }
                };

                xhr.open("GET", "seu_script.php?opcao=" + opcaoSelecionada, true);
                xhr.send();
            } else {
                // Limpa a caixa de combinação caso nenhuma opção seja selecionada
                document.getElementById("dados").innerHTML = "<option value=''>Selecione uma opção acima</option>";
            }
        }

        function preencherDados(dados) {
            var dadosSelect = document.getElementById("dados");
            dadosSelect.innerHTML = "";

            // Preenche a caixa de combinação com os dados obtidos
            for (var i = 0; i < dados.length; i++) {
                var option = document.createElement("option");
                option.value = dados[i];
                option.text = dados[i];
                dadosSelect.appendChild(option);
            }
        }
    </script>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>