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
<?php
$pesquisa = $_POST['cpf'];
$valor = $_POST['descontado'];
//pegar dados 
$link = mysqli_connect("localhost", "root", "", "credinota");
$query = mysqli_query($link, "SELECT  * FROM `vendas` WHERE cpf = '$pesquisa'") or die ("Erro ao retornar dados de vendas");
//puxar valor do DB, somar com o da inserção e registrar o novo valor no DB
$puxa = mysqli_query($link, "SELECT  descontado FROM `vendas` WHERE cpf = '$pesquisa'");
while ($puxar = mysqli_fetch_array($puxa)){                            
	$descontado = $puxar['descontado'];                         
 }
 //pegando o valor dísponivel para fazer a verificação do desconto de credinota
 $retorno = mysqli_query($link, "SELECT sum(valor) AS total FROM `vendas` WHERE cpf = '$pesquisa'");
while($total = mysqli_fetch_assoc($retorno)){
	//calcular credinota dísponivel (total * valor credinota)
$disponivel = $total['total'] * 0.025;
}
$valordescontado = $descontado+$valor;
 //o valor descontado não pode ser maior que o valor dísponivel
 if($valor>$disponivel) {
	$url1 = 'descontar.html';
	echo "<script> alert('Erro, o valor descontado excede o valor dísponivel')";
	echo "<script language=\"JavaScript\">window.location='" .$url1. "';</script>\n";
 }
 //o valor mínimo de desconto é 50 Reais
if ($descontado<50){
	echo "<script> alert('Erro, o desconto mínimo de credinota é de 50R$'); </script>";
}
else{
	$insere = mysqli_query($link, "UPDATE `vendas` SET descontado='$valordescontado' WHERE cpf = '$pesquisa'");	
}
?>
<!-- Exibir o HTML-->
	<html>
		<meta charset="utf-8">
	 <head>
		<!--Links de scripts, bootstraps e css's --> 
	    <link href="estilos.css" rel="stylesheet" type="text/css">
	    <link link rel="stylesheet" type="text/css" href="style.css"/>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	    <link link rel="stylesheet" type="text/css" href="style.css"/>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cep").mask("99999-999");
			});
			</script>
			<!-- Mascara CEP-->
		<script>
			function mCEP(cep){
					cep=cep.replace(/\D/g,"")
					cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
					cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
					return cep; }
		</script>
	      <script>
	function ValidaCPF(){	
		var RegraValida=document.getElementById("cpf").value; 
		var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;	 
		if (cpfValido.test(RegraValida) == true){ 
		console.log("CPF Válido");	
		} else	{	 
		console.log("CPF Inválido");	
		}
	    }
	  function fMasc(objeto,mascara){
	obj=objeto
	masc=mascara
	setTimeout("fMascEx()",1)
	}
	  function fMascEx() {
	obj.value=masc(obj.value)
	}
	   function mCPF(cpf){
	cpf=cpf.replace(/\D/g,"")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	return cpf
	}
	function mCEP(cep){
					cep=cep.replace(/\D/g,"")
					cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
					cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
					return cep; }
	      </script>
	 <title>Resultado da pesquisa</title>
	 </head>
	 <body>
	  <!-- #########  NAVBAR  #######-->
		  <div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-warning" style="background-color: #00c4ff!important;">
				<a class="navbar-brand" href="#">CREDINOTA</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
					<!-- The Modal -->
			<div class="modal" id="myModal">
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Customer Sign In</h4>
							<button type="button" class="close" data-dismiss="modal">×</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<form>
								<label class="sr-only" for="usrname">Username</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
									</div>
									<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<label class="sr-only" for="Password">Name</label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
									</div>
									<input id="Password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</nav>
			<?php
			$pegarnome = mysqli_query($link, "SELECT nome FROM clientes WHERE cpf = '$pesquisa'");                           
			while ($coleta = mysqli_fetch_array($pegarnome))                           
			{                            
				$nome = $coleta ['nome'];                         
			 };
			 //mensagem caso o desconto seja feito
			 if($insere=true){
			echo"
	        <h1> 
	            Foi descontado o valor de R$
	            <!-- Valor descontado -->
	            $valor
	            do(a) Cliente
	            <!-- Nome do cliente-->
	             $nome";
				}
				session_destroy();
	            ?>
	        </h1>