<?php
    //conectar ao banco de dados
    $link = mysqli_connect("localhost", "root", "", "credinota");
    //iniciar sessão
    session_start();
    $url = 'login.html';
    //verificar sessão, se as credenciais estiverem corretas exibir a página, caso contrário volta para a página de login
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    echo "<script> alert('Para realizar essa função você precisa estar logado'); </script>";
    echo "<script language=\"JavaScript\">window.location='" .$url. "';</script>\n";
    }
    $logado = $_SESSION['login'];
//pegando valores $nome , $email , $cpf , $sexo	 , $ddd , $telefone , $endereco , $bairro  , $valor'"
$cpf = $_POST['cpf'];                           
$ddd = $_POST['ddd'];                           
$telefone = $_POST['telefone'];                           
$talao = $_POST['talao'];                           
$valor = $_POST['valor'];                     
$pegarnome = mysqli_query($link, "SELECT nome FROM clientes WHERE cpf = '$cpf'");                           
while ($coleta = mysqli_fetch_array($pegarnome))                           
{                            
	$nome = $coleta ['nome'];                         
 }
$loja = $_SESSION['login'];
echo '<br>';
$valor;
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
$query = mysqli_query($link, "INSERT into `vendas`(`cliente`, `cpf`, `ddd`, `telefone`, `talao`, `loja`, `valor`)
	VALUES ('$nome', '$cpf', '$ddd', '$telefone', '$talao', '$loja', '$valor');");
//exibir mensagem de erro caso não funcione
if (!$query) {
	echo "Error: <br>." . PHP_EOL;
	echo "Debugging errno: " . mysqli_errno($link) . PHP_EOL;
	echo "Debugging error: " . mysqli_error($link). PHP_EOL;
	exit;
	};
// o que exibir ao query ser realizado
if($query):
    echo ('
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- #########  NAVBAR  #######-->

	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-warning" style="background-color: #00c4ff!important;">
			<a class="navbar-brand" href="#">CREDINOTA</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto topnav">
					<li class="nav-item active">
						<a class="nav-link" href="index.html">CADASTRO<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Consulta.html">CONSULTA</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="descontar.html">Descontar CREDINOTA</a>
					</li>

				</ul>
			</div>
		</nav><H1> 
Cadastro realizado com sucesso!
</H1>
<a href="index.html" >Voltar a página inicial</a>') ;
 endif; 
//$query = nome da variável que utilizarei para realizar a operação de inserção dos dados
//clientes = nome da tabela que será salvo os dados do cadastro do cliente
//nome, email, sexo, ddd, telefone, endereço, cidade, estado, bairro, país, login, senha, news, id. São apenas os nomes dos campos que constam na tabela clientes.

//VALUES = indica que serão inseridos os seguintes valores.
//$nome, $email, $sexo, $ddd, $telefone, $endereço, $cidade, $estado, $bairro, $país, //$login, $senha, $news, $id.
//São apenas as variaveis a qual eu atribui os valores digitados no formulário.

//mensagem que é escrita quando os dados são inseridos normalmente. */

//destruir sessão após realizada a ação
session_destroy();
mysqli_close($link);
?>