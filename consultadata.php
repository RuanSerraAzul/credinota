<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<!-- Configurar Sessão, pois apenas úsuarios autorizados podem verificar cadastros de Credinota -->  
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
	?>
	<style>
		.container {
			width: 700px;
			margin-left: auto;
			margin-right: auto;
			text-align: center;
		}
	</style>
	<link link rel="stylesheet" type="text/css" href="style.css" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		function ValidaCPF() {
			var RegraValida = document.getElementById("cpf").value;
			var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;
			if (cpfValido.test(RegraValida) == true) {
				console.log("CPF Válido");
			} else {
				console.log("CPF Inválido");
			}
		}
		function fMasc(objeto, mascara) {
			obj = objeto
			masc = mascara
			setTimeout("fMascEx()", 1)
		}
		function fMascEx() {
			obj.value = masc(obj.value)
		}
		function mCPF(cpf) {
			cpf = cpf.replace(/\D/g, "")
			cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
			cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
			cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
			return cpf
		}
	</script>
</head>
<body>
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
		<!-- tabela exibindo registros-->
		<h4> Exibindo registros no Credinota efetuados no dia 
			<?php 
				$data = $_GET['data']; 
				$data = implode("/",array_reverse(explode("-",$data)));
					echo $data; 
			?> 
		</h4>
		<table border="10" style='width:100%'>
 <tr>
 <th>CPF</th>
 <th>Nome</th>
 <th>Contato </th>
 <th>Loja em que foi cadastrado</th>
 </tr>
<?php
	//pegar a data
	$data = $_GET['data'];
	//query pegando todos os dados cuja data sejam iguais a da pesquisa
	$query1 = mysqli_query($link, "SELECT * FROM vendas WHERE data = '$data'");
	if (!$query1) {
		echo "Error: Falha ao buscar data no banco de dados MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_errno($link) . PHP_EOL;
		echo "Debugging error: " . mysqli_error($link) . PHP_EOL;
		exit;
		}
	//pegar valor que já foi descontado de credinota
	$pegardescontado = mysqli_query($link, "SELECT descontado FROM vendas WHERE data = '$data'");                           
				while ($coleta = mysqli_fetch_array($pegardescontado)){                            
					$descontado = $coleta ['descontado'];                  
				};
	//fazer tratamento dos dados
	while ($registro = mysqli_fetch_array($query1)){
		$cpf = $registro['cpf'];
		$nome = $registro['cliente'];
		$ddd = $registro['ddd'];
		$contato = $registro['telefone'];
		$loja = $registro['loja'];
		echo "<tr>";
		echo "<td>".$cpf."</td>";
		echo "<td>".$nome."</td>";
		echo "<td>".$ddd. " ".$contato."</td>";
		echo "<td>".$loja. "</td>";
		echo "</tr>";
	}
?>