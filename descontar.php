<?php
$pesquisa = $_POST['cpf'];
//pegar dados 
$link = mysqli_connect("localhost", "root", "", "credinota");
$query = mysqli_query($link, "SELECT  * FROM `vendas` WHERE cpf = '$pesquisa'") or die ("Erro ao retornar dados de vendas");

?>
