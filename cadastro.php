<?php
//$nome , $email , $cpf , $sexo , $ddd , $telefone , $endereco , $bairro  , $valor , ''"
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['CPF'];
$sexo = $_POST['sexo'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$valor = $_POST['valor'];

$link = mysqli_connect("localhost", "root", "",);
 
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
 
echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
 


$banco = mysqli_select_db($link,'credinota'); // nome da tabela onde os dados serão armazenados;


//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
$query = mysqli_query($link, " INSERT INTO `clientes`(`nome`, `email`, `cpf`, `sexo`, `ddd`, `telefone`, `endereço`, `bairro`, `valor`, `id`)  
    VALUES ('$nome', '$email', '$cpf' , '$sexo', '$ddd', '$telefone', '$endereco', '$bairro', '$valor' ,'')");


/*if($query):
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
?>