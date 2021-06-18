<!DOCTYPE html>
<meta charset="utf-8">
<head>
   <!-- Configurar Sessão, pois apenas úsuarios autorizados podem criar cadastros de Credinota -->  
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
    <!-- Links de CSS e Bootstrap e Scripts-->
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
	if (cpfValido.test(RegraValida) == true)	{ 
	console.log("CPF Válido");	
	} else	{	 
	console.log("CPF Inválido");	
	}
    }
  function fMasc(objeto,mascara) {
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
</head>
<body>
    <form method="POST" action="cadastrovendas.php">
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