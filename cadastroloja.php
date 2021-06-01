<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <?php
/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
 simplesmente não fazer o login e digitar na barra de endereço do seu navegador
o caminho para a página principal do site (sistema), burlando assim a obrigação de
fazer um login, com isso se ele não estiver feito o login não será criado a session,
então ao verificar que a session não existe a página redireciona o mesmo
 para a index.php.*/

session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:login.html');
  }
    $logado = $_SESSION['login'];
?>
<link link rel="stylesheet" type="text/css" href="style.css"/>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-1.2.6.pack.js"></script>
	<script type="text/javascript" src="jquery.maskedinput-1.1.4.pack.js"></script>
    
</head>
<body>
    <form method="POST" action="cadastrovenda.php" target="_blank">
        <table>
          <tbody><tr>
              <td>CPF do cliente:</td>
                  <td><input required id="cpf" name="cpf" onkeydown="javascript: fMasc( this, mCPF );" maxlength = "14" placeholder="000.000.000-00" onblur="ValidaCPF()"/>
                      <span class="style1">*</span></td>
                </tr>
              <tr>
                <td>DDD:</td>
                  <td><input required id="ddd" name="ddd" size="2" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number" maxlength = "2" />
                Telefone:
              <input id="telefone" name="telefone"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              type = "number" maxlength = "9"/>
                      <span class="style3">Apenas números</span> </td>
              </tr>       
                              <td>Talão:</td>
                                  <td><input required id="talao" maxlength="20" name="talao" type="text" />
                                    <span class="style1">*</span></td>
                        </tr>
                          <tr>
                  <td>Valor da compra</td>
                  <td><input required id="valor" name="valor" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number" step=0.001 placeholder="R$" maxlength="10" />
                  <span class="style1">*</span></td>
                  
                          </tr>
                             <tr>
                              <td colspan="2"><p>
                          <input id="cadastrar" name="cadastrar" type="submit"  value="Cadastrar" /> 
                              <span class="style1">* Campos com * são obrigatórios! </span></p>
    <p> </p></td>
      </tr>
      </tbody></table>
</body>
</html>