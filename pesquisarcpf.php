
<html>
 <head>
	 <!-- Links com os scripts, bootsraps e css's-->
 <link href="estilos.css" rel="stylesheet" type="text/css">
 <head>
    <link link rel="stylesheet" type="text/css" href="style.css"/>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
 <title>Resultado da pesquisa</title>
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
					<li>
					<a href="login.html"> <i class="fa fa-key" style="font-size: 40px; color: white;" aria-hidden="false"></i> </a>
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
 <!-- Criando tabela e cabeçalho de dados: -->
 <table border="10" style='width:100%'>
 <tr>
 <th>CPF</th>
 <th>Nome</th>
 <th>Valor Total comprado </th>
 <th>Credinota Disponível</th>
 <th>Contato </th>
 </tr>
 <!-- Preenchendo a tabela com os dados do banco: -->
	<?php
 //conectar ao db
    $link = mysqli_connect("localhost", "root", "", "credinota",);
        if (!$link) {
                echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
                }
  // Recebendo os dados a pesquisar
  $pesquisa = $_POST['cpf'];
 $resultado = mysqli_query($link, "SELECT * FROM clientes WHERE cpf = '$pesquisa'") or die ("Erro ao retornar dados");
 $resultadosvendas= mysqli_query($link, "SELECT  * FROM `vendas` WHERE cpf = '$pesquisa'") or die ("Erro ao retornar dados de vendas");
// teste para valor total
//Dando um nome para a coluna que iria receber o total do preço
$retorno = mysqli_query($link, "SELECT sum(valor) AS total FROM `vendas` WHERE cpf = '$pesquisa'");
while($total = mysqli_fetch_assoc($retorno)){
$total2 = $total['total'];
}
//definindo  sessão
$loja = $_SESSION['login'];
//pegar valor que já foi descontado de credinota
$pegardescontado = mysqli_query($link, "SELECT descontado FROM vendas WHERE cpf = '$pesquisa'");                           
			while ($coleta = mysqli_fetch_array($pegardescontado))                           
			{                            
				$descontado = $coleta ['descontado'];                  
			 };
			
//obter dados gerais através de um loop while
 while ($registro =mysqli_fetch_array($resultado))
 {
   $cpf = $registro['cpf'];
   $nome = $registro['nome'];
   $ddd = $registro['ddd'];
   $contato = $registro['telefone'];
   $total = $total['total'];
   $credinota = 0.025 ;
   echo "<tr>";
   echo "<td>".$cpf."</td>";
   echo "<td>".$nome."</td>";
   echo"<td> R$ " .$total2. "</td>";
   $total3= $total2*$credinota;

//aqui vai credinota total
   echo "<td>" .((int)$total3 - (int)$descontado). ",00 </td>";
   echo "<td>".$ddd. " ".$contato."</td>";
   echo "</tr>";
 }
 echo "</table>";
 mysqli_close($link);
?>
<h2>
			<br>
			<br>
			<button >
					<a href="descontar.html">Descontar Credinota </a>
			</button> 
			
			<br>  <br> <br> <br>
			<button >
					<a href="atualizar.html">  Atualizar cadastro  </a>
			</button> 
		</h2> 
</body>
</html>