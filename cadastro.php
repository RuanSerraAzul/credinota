<?php
 
//conectar ao banco de dados
$link = mysqli_connect("localhost", "root", "", "credinota");

///conectar ao banco de dados
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

//$nome , $email , $cpf , $sexo , $ddd , $telefone , $endereco , $bairro  , $valor , ''"
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$loja = $logado;
$link = mysqli_connect("localhost", "root", "", "credinota");
 
//conectar ao DB

if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 
/*echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;*/
 
$banco = mysqli_select_db($link,'credinota'); // nome do banco onde os dados serão armazenados;


//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
$query = mysqli_query($link, "INSERT INTO `clientes` (`nome`, `email`, `cpf`, `sexo`, `ddd`, `telefone`, `endereço`, `bairro`, `loja`, `id`)  
    VALUES ('$nome', '$email', '$cpf' , '$sexo', '$ddd', '$telefone', '$endereco', '$bairro', '$loja','')");


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
	else:
		echo '
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
		</nav>
    <H1> Deu algo errado. tente novamente, consulte se o CPF já esta cadastrado </H1>';
 endif; 

//$query = nome da variável que utilizarei para realizar a operação de inserção dos dados
//clientes = nome da tabela que será salvo os dados do cadastro do cliente
//nome, email, sexo, ddd, telefone, endereço, cidade, estado, bairro, país, login, senha, news, id. São apenas os nomes dos campos que constam na tabela clientes.

//VALUES = indica que serão inseridos os seguintes valores.
//$nome, $email, $sexo, $ddd, $telefone, $endereço, $cidade, $estado, $bairro, $país, //$login, $senha, $news, $id.
//São apenas as variaveis a qual eu atribui os valores digitados no formulário.

//mensagem que é escrita quando os dados são inseridos normalmente.
//fechar conexão
mysqli_close($link);
?>