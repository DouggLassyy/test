<?php

$servidor = "localhost";
$usuarioo = "dougglassy00";
$chave = "D@L2$337M&L!D()G73G*7Y0V05*Qdl*PYxuOab(";
$base = "login_register";

$conn = mysqli_connect($servidor, $usuarioo, $chave, $base);


if ($conn) {
    echo "Ligado a Rede";
} else {

    echo "sem conexao";
}
?>
