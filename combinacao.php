<?php
// Conectar ao banco de dados (substitua as informações de conexão com o seu próprio)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter os dados da coluna desejada
$sql = "SELECT nome FROM sua_tabela";

$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Início da tag select
    echo '<select name="nomes">';

    // Iterar sobre os resultados e criar as opções da caixa de combinação
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["nome"] . '">' . $row["nome"] . '</option>';
    }

    // Fim da tag select
    echo '</select>';
} else {
    echo "Nenhum resultado encontrado na tabela.";
}

// Fechar a conexão com o banco de dados
$conn->close();
