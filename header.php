<?php

// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.
$link = mysqli_connect("localhost", "root", "", "credinota");
if (!$link) {
        echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
        }
else {
    echo "Sucesso ao se conectar ao banco de dados";
}

?>