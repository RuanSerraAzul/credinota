
<?php
  //dados de conexao inclusos no header
  include_once ("header.php");

  // as variáveis login e senha recebem os dados digitados na página anterior
  $login = mysqli_real_escape_string($link,$_POST['loja']);

  $senha = mysqli_real_escape_string($link,$_POST['senha']);

  // session_start inicia a sessão

  session_start();

  // A variavel $result pega as varias $login e $senha, faz uma

  //pesquisa na tabela de usuarios

  $query = "SELECT * FROM `lojas` WHERE `loja` = ".$login." AND `senha`= ".$senha." ";

  $logon = $link->query($query);

  while ($result = $logon->fetch_assoc()){
    $lojas1 = $result['lojas'];
    $senhas1 = $result['senhas'];
  }

  /* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi
  bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
  será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do
  resultado ele redirecionará para a página site.php ou retornara  para a página
  do formulário inicial para que se possa tentar novamente realizar o login */
  if(mysqli_num_rows($logon) > 0 ){
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
