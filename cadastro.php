<?php
//$nome , $email , $cpf , $sexo , $ddd , $telefone , $endereco , $bairro  , $valor , ''"
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$loja = $_POST['loja'];
$talao = $_POST['talao'];
$valor = $_POST['valor'];
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
$query = mysqli_query($link, "INSERT INTO `clientes` (`nome`, `email`, `cpf`, `sexo`, `ddd`, `telefone`, `endereço`, `bairro`, `loja`, `talao`, `valor`, `id`)  
    VALUES ('$nome', '$email', '$cpf' , '$sexo', '$ddd', '$telefone', '$endereco', '$bairro', '$loja', '$talao', '$valor' ,'')");

/*
if($query):
    echo "Cadastrado com sucesso!";
 else:
    echo "Deu algo errado.";
 endif; */

//$query = nome da variável que utilizarei para realizar a operação de inserção dos dados
//clientes = nome da tabela que será salvo os dados do cadastro do cliente
//nome, email, sexo, ddd, telefone, endereço, cidade, estado, bairro, país, login, senha, news, id. São apenas os nomes dos campos que constam na tabela clientes.

//VALUES = indica que serão inseridos os seguintes valores.
//$nome, $email, $sexo, $ddd, $telefone, $endereço, $cidade, $estado, $bairro, $país, //$login, $senha, $news, $id.
//São apenas as variaveis a qual eu atribui os valores digitados no formulário.

//mensagem que é escrita quando os dados são inseridos normalmente.

mysqli_close($link);
echo ('<H1> 
Cadastro realizado com sucesso!
</H1>
<a href="index.html" >Voltar a página inicial</a>') ;

?>