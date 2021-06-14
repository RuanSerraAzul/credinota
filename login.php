<?php
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['loja'];
$senha = $_POST['senha'];
// session_start inicia a sessão
session_start();
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

// A variavel $result pega as varias $login e $senha, faz uma
//pesquisa na tabela de usuarios
$result = mysqli_query($link, "SELECT * FROM `lojas`
    WHERE `loja` = '$login' 
    AND `senha`= '$senha' " ) 
    or die ("Erro ao retornar dados");

/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do
resultado ele redirecionará para a página site.php ou retornara  para a página
do formulário inicial para que se possa tentar novamente realizar o login */

if(mysqli_num_rows ($result) > 0 )
{
$_SESSION['login'] = $login;
$_SESSION['senha'] = $senha;
header('location:areasegura.php');
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  header('location:login.html');
  }
?>
