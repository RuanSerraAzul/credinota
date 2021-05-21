
<html>
 <head>
 <link href="estilos.css" rel="stylesheet" type="text/css">
 <title>Resultado da pesquisa</title>
 </head>
 <body>
 
 <!-- Criando tabela e cabeçalho de dados: -->
 <table border="10" style='width:50%'>
 <tr>
 <th>CPF</th>
 <th>Nome</th>
 <th>Compra realizada na loja: </th>
 <th>Valor </th>
 <th>Talão </th>
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
                                
            echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;

  // Recebendo os dados a pesquisar
  $pesquisa = $_POST['cpf'];
 $resultado = mysqli_query($link, "SELECT * FROM clientes WHERE cpf = '$pesquisa'") or die ("Erro ao retornar dados");
 

 // Obtendo os dados por meio de um loop while
 while ($registro =mysqli_fetch_array($resultado))
 {
   $cpf = $registro['cpf'];
   $nome = $registro['nome'];
   $loja = $registro['loja'];
   $valor = $registro['valor'];
   $talao = $registro['talao'];
   $ddd = $registro['ddd'];
   $contato = $registro['telefone'];
   echo "<tr>";
   echo "<td>".$cpf."</td>";
   echo "<td>".$nome."</td>";
   echo "<td>".$loja."</td>";
   echo "<td>R$".$valor."</td>";
   echo "<td>".$talao."</td>";
   echo "<td>".$ddd. " ".$contato."</td>";
   echo "</tr>";
 }
 echo "</table>";
 mysqli_close($link);
?>
</body>
</html>