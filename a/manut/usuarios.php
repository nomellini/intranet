<?
	require("../scripts/conn.php");	   		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $pode = pegaManut($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {

?><html>
<head>
<title>usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
  <script language="">

 function incluir() {
   if (document.form.hierarquia.selectedIndex == 0 ) {
     window.alert("Hierarquia é obrigatótio na inclusão");
     document.form.hierarquia.focus();
	 return;
   } 

   if (document.form.superior.selectedIndex == 0 ) {
     window.alert("Superior é obrigatótio na inclusão");
     document.form.superior.focus();
	 return;
   } 

   
     document.form.acao.value='inserir'; 
     document.form.submit(); 
   
 }

 function deleta(value) {
   if (window.confirm("Deseja apagar '" + value + "' ?")) {
     document.form.submit();
   }
 }

</script>
  <?

 if (!$ordem) {
  $ordem = "nome";
 } else {
 	if (isset($desc)) {
		$ordem = "$ordem desc";
	}
 }

 

 if ($acao=="inserir") {
   $ok = 0; 
   $sql1 = "INSERT INTO usuario ( ";
   $sql2 = ") VALUES ( ";

   if ($atendimento) {
     $sql1 .= "atendimento";
     $sql2 .= "1";
     $ok=1;
   }


   if ($emailsn) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "emailsn";
     $sql2 .= "1";
     $ok=1;
   }


   if ($gerencial) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "gerencial";
     $sql2 .= "1";
     $ok=1;
   }


   if ($fl_edita_chamado_bloqueado) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "fl_edita_chamado_bloqueado";
     $sql2 .= "1";
     $ok=1;
   }



   if ($manut) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "manut";
     $sql2 .= "1";
     $ok=1;
   }

   if ($marketing) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "marketing";
     $sql2 .= "1";
     $ok=1;
   }

   if ($diagnostico) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "diagnostico";
     $sql2 .= "1";
     $ok=1;
   }


   if ($gerente) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "gerente";
     $sql2 .= "1";
     $ok=1;
   }

   if ($lembrete_ativo) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "lembrete_ativo";
     $sql2 .= "1";
     $ok=1;
   }


   if ($nome_usuario) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "nome";
     $sql2 .= "'$nome_usuario'";
	 $ok = 1;
   }

   if ($login) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
     $sql1 .= "login";
     $sql2 .= "'$login'";
	 $ok = 1;
   }
   
    
   if ($hierarquia>0) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "hierarquia";
	 $sql2 .= "$hierarquia";
	 $ok = 1;
   }
   
   if ($superior > 0) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "superior";
	 $sql2 .= "$superior";
     $ok=1;
   }

   if (!$area) {
     $area = 9;
   } 
   if($ok) {
    $sql1 .= ", ";
	$sql2 .= ", ";
   }
   $sql1 .= "area";
   $sql2 .= "$area";
   $ok=1;


   if ($email) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "email";
	 $sql2 .= "'$email'";
     $ok=1;
   }
   
   if ($senha) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "senha";
	 $sql2 .= "'" . md5($senha) . "'";
	 $ok=1;
   }

   if ($lembrete_dias) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "lembrete_dias";
	 $sql2 .= $lembrete_dias;
	 $ok=1;
   }

   
   $sSQL = $sql1.$sql2.");";   
   
   mysql_query($sSQL);   
   mysql_query(logUsu($sSQL, $id_usuario));
   
   
   if ($superior == -1) {
      $sql = "select max(id_usuario) as id from usuario;";
	  $result = mysql_query($sql);
	  $linha = mysql_fetch_object($result);
	  $id = $linha->id;
	  
	  $sql = "update usuario set superior = $id where id_usuario=$id ;";
   	  mysql_query($sql); 	  
   }


 } else if ($acao=="deletar") {
   $sSQL = "DELETE FROM usuario where id_usuario = $id;";
   mysql_query($sSQL);
   mysql_query(logUsu($sSQL, $id_usuario));   
 } else if ($acao=="alterar") {

   $ok = 0; 
   $sql1 = "UPDATE usuario set ";

   if ($nome_usuario) {
     $sql1 .= "nome = '$nome_usuario'";
	 $ok = 1;
   }   

   if ($atendimento) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "atendimento = not atendimento";
	 $ok=1;
   }
   if ($ativo) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "ativo = not ativo";
	 $ok=1;
   }

   if ($manut) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "manut = not manut";
	 $ok=1;
   }   
   
   

   if ($fl_edita_chamado_bloqueado) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "fl_edita_chamado_bloqueado = not fl_edita_chamado_bloqueado";
	 $ok=1;
   }   

   if ($marketing) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "marketing = not marketing";
	 $ok=1;
   }   
   
   if ($diagnostico) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "diagnostico = not diagnostico";
	 $ok=1;
   }   

   if ($gerente) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "gerente = not gerente";
	 $ok=1;
   }   

   if ($lembrete_ativo) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "lembrete_ativo = not lembrete_ativo, lembrete_data = '2001-01-01'";
	 $ok=1;
   }   

   if ($lembrete_dias) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "lembrete_dias = $lembrete_dias";
	 $ok=1;
   }   

   if ($gestor) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "gestor = not gestor";
	 $ok=1;
   }   
   

   if ($gerencial) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "gerencial = not gerencial";
	 $ok=1;
   }   

   if ($emailsn) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "emailsn = not emailsn";
	 $ok=1;
   }

   if ($hierarquia>0) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "hierarquia = $hierarquia";
	 $ok = 1;
   }
   
   if ($superior > 0) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "superior = $superior";
     $ok=1;
   }

   if ($area > 0) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "area = $area";
     $ok=1;
   }


   if ($email) {
     if($ok) {
	   $sql1 .= ", ";
	   $sql2 .= ", ";
	 }
	 $sql1 .= "email = '$email'";
     $ok=1;
   }
   
   if ($login) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "login = '$login'";
     $ok=1;
   }
   
   
   if ($senha) {
     if($ok) {
	   $sql1 .= ", ";
	 }
	 $sql1 .= "senha = '" . md5($senha) . "'";
	 $ok=1;
   }
   

	if ($ok) {
		$sSQL = $sql1 . " where id_usuario = $id;";
		mysql_query($sSQL);
		logUsu($sSQL, $id_usuario);
		header("Location: usuario2.php?id=$id");
	}
 }

 
?>
  <img src="../figuras/intro.gif" width="321" height="21"></font> </div>
<form name="form" method="post" action="usuarios.php">
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Caso queira alterar 
    alguma, escreva aqui o novo texto e clique em Altera, Para inserir, digita 
    o texto e aperte em Inserir: Aten&ccedil;&atilde;o TODA Altera&ccedil;&atilde;o 
    ser&aacute; monitorada e ser&aacute; gravada DATA, HORA, QUEM Alterou o o 
    que foi alterado.<br>
    </font></p>
  <table width="75%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="16%"> <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Nome</font></div></td>
      <td width="84%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <input type="text" name="nome_usuario" size="30" maxlength="150" class="unnamed1">
        - 
        <input type="checkbox" name="atendimento" value="checkbox">
        Atendimento ? 
        <input name="Button" type="button" class="bordaTexto" value="pesquisa" onClick="document.form.acao.value='pesquisa';document.form.submit();">
        </font></td>
    </tr>
    <tr>
      <td align="right">Login</td>
      <td><input name="login" type="text" class="unnamed1" id="login" size="12" maxlength="12"></td>
    </tr>
    <tr> 
      <td width="16%"> <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Hierarquia</font></div></td>
      <td width="84%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <select name="hierarquia" class="unnamed1">
          <option value=0">Selecione</option>
          <? $sql1="Select * from hierarquia order by hierarquia;"; 
		    $result = mysql_query($sql1);
            while($linha = mysql_fetch_object($result)) {
			  $id_h = $linha->id_hierarquia;
			  $hier = $linha->hierarquia;					
         ?>
          <option value="<?=$id_h?>"> 
          <?=$hier?>
          </option>
          <? } ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td width="16%"> <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Superior</font></div></td>
      <td width="84%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <select name="superior" class="unnamed1">
          <option value="0">Selecione</option>
          <option value="-1">Não tem</option>
          <? $sql1="Select id_usuario, nome from usuario, hierarquia Where ( usuario.hierarquia=hierarquia.id_hierarquia ) and ( hierarquia.hierarquia like '%gerente%') order by nome;"; 
		    $result = mysql_query($sql1);
            while($linha = mysql_fetch_object($result)) {
			  $id = $linha->id_usuario;
			  $nome = $linha->nome;					
         ?>
          <option value="<?=$id?>"> 
          <?=$nome?>
          </option>
          <? } ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td align="right">&Aacute;rea</td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
        <select name="area" class="unnamed1" id="area">
          <option value=0">Selecione</option>
          <? $sql1="Select * from area order by descricao;"; 
		    $result = mysql_query($sql1);
            while($linha = mysql_fetch_object($result)) {
			  $id_h = $linha->id;
			  $hier = $linha->descricao;		
         ?>
          <option value="<?=$id_h?>"> 
          <?=$hier?>
          </option>
          <? } ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td width="16%"> <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">email</font></div></td>
      <td width="84%"> <input type="text" name="email" class="unnamed1">
        - 
        <input type="checkbox" name="emailsn" value="checkbox">
        Recebe ?</td>
    </tr>
    <tr> 
      <td width="16%">&nbsp;</td>
      <td width="84%"> <input type="checkbox" name="gerencial" value="checkbox">
        Gerencial 
        <input type="checkbox" name="manut" value="checkbox">
        Manut 
        <input type="checkbox" name="diagnostico" value="checkbox">
        diagnostigo 
        <input type="checkbox" name="marketing" value="checkbox">
        Marketing 
        <input type="checkbox" name="gerente" value="1">
        Gerente 
        <input name="gestor" type="checkbox" id="gestor" value="1">
        Gestor 
        <br>
        <input name="fl_edita_chamado_bloqueado" type="checkbox" id="fl_edita_chamado_bloqueado" value="1">
        Permite Editar chamados de clientes bloqueados <br>
        <input name="ativo" type="checkbox" id="ativo" value="1">
Ativar/Desativar</td>
    </tr>
    <tr> 
      <td width="16%"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Senha</font></div></td>
      <td width="84%"> <input type="password" name="senha" size="8" maxlength="100">      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td> Lembrete 
        <label>
        <input name="lembrete_ativo" type="checkbox" id="lembrete_ativo" value="checkbox">
      Quantidade de dias 
      <input name="lembrete_dias" type="text" class="borda_fina" id="lembrete_dias" size="4" maxlength="3">
      </label></td>
    </tr>
    <tr> 
      <td width="16%"> <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">[<a href="javascript:incluir();">Inserir</a>]</font></div></td>
      <td width="84%">&nbsp;</td>
    </tr>
  </table>
  <br>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> [<a href="javascript:document.form.acao.value='';document.form.submit();">Reload</a>] 
  [<a href="index.php">Voltar</a>] [<a href="../inicio.php">Inicio</a>]<br>
  </font> 
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr> 
      <td width="8%" height="12" bgcolor="#FFFFFF"> <div align="center"><font color="#0000FF"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1">A&Ccedil;&Atilde;O</font></i></font></div></td>
      <td width="32%" height="12" bgcolor="#FFFFFF"> <div align="left"><font color="#0000FF"><i><font face="Verdana, Arial, Helvetica, sans-serif" size="1">&nbsp;<a href="usuarios.php?ordem=nome">NOME</a> 
          [<a href="usuarios.php?ordem=gerencial%20DESC">G</a>] [<a href="usuarios.php?ordem=manut%20DESC">M</a>] 
          [<a href="usuarios.php?ordem=diagnostico%20DESC">D</a>][M][<a href="usuarios.php?ordem=gerente%20DESC">Ge</a>][<a href="usuarios.php?ordem=area.descricao">Area</a>]</font></i></font>[<a href="usuarios.php?ordem=gestor&desc=ok">Gestor</a>]</div></td>
      <td width="23%" height="12" bgcolor="#FFFFFF"><i><font color="#0000FF">&nbsp;<a href="usuarios.php?ordem=hierarquia.hierarquia,nome">Hierarquia</a> 
        / <a href="usuarios.php?ordem=u2.nome,nome">Superior</a></font></i></td>
      <td width="37%" height="12" bgcolor="#FFFFFF"><i><font color="#0000FF">login/&nbsp;<a href="usuarios.php?ordem=u1.email">email</a></font></i></td>
    </tr>
    <?	
 $sSQL  = "Select u1.marketing, u1.gerente, u1.diagnostico, u1.gerencial, u1.manut, u1.*, u1.fl_edita_chamado_bloqueado, ";
 $sSQL .= "u2.nome as sup, hierarquia.hierarquia as hie, area.descricao as area from ";
 $sSQL .= "     usuario u1";
 $sSQL .= "             inner join usuario u2 on u1.superior = u2.id_usuario";
 $sSQL .= "             left join area  on area.id = u1.area";
 $sSQL .= "             left join hierarquia on hierarquia.id_hierarquia = u1.hierarquia     ";
 if ($acao=='pesquisa') {
   $sSQL .= " where  ( (u1.nome like '$nome_usuario%') or (u1.login like '$nome_usuario%') )";
 }
 $sSQL .= "order by u1.atendimento desc, $ordem;";
 $result = mysql_query($sSQL) or die(mysql_error());
 while( $linha =mysql_fetch_object($result)) {    
	$id = $linha->id_usuario;
	$nome = $linha->nome; 
	$login = $linha->login;
    $hierarquia = $linha->hie;
    $id_superior = $linha->superior;
    $superior = $linha->sup;
    $email = $linha->email;
	$emailsn = $linha->emailsn;
	$gerencial = $linha->gerencial;
	$diagnostico = $linha->diagnostico;
	$gerente = $linha->gerente;
	
	$lembrete = $linha->lembrete_ativo;	
	$lembrete = $lembrete == 1 ? "ATIVO" : "INATIVO";
	
	$lembrete_dias = $linha->lembrete_dias;		
	$manut = $linha->manut;
	$marketing = $linha->marketing;
    $a = $linha->atendimento;
	$area = $linha->area;
	$gestor = $linha->gestor;
	$fl_edita_chamado_bloqueado = $linha->fl_edita_chamado_bloqueado;
	
	if (($co++/2) == floor($co/2)) {
	  $cor = "#E1F0FF";
	} else {
	  $cor = "#ffffff";
	}
	

	if ($gestor) {
		  $cor = "#aabbcc";
	}

	if (!$linha->ativo) {
	  $cor = "#CCCCCC";
	  //continue;
	}
	
 ?>
    <tr> 
      <td colspan="4" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#003300">
          <tr> 
            <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="7%" bgcolor="<?=$cor?>"> <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
				  
				  <!-- Não permito mais deletar usuário
				  <?
				   if ($ok==12) {
				  ?>
				    <a href="javascript:document.form.acao.value='deletar'; document.form.id.value=<?=$id?>;deleta('<?=$nome?>');">D</a> 
  				  <?
				    } else {
					  echo "D";
					}
				  ?>
				   / 
				  -->
                     <a href="javascript:document.form.acao.value='alterar'; document.form.id.value=<?=$id?>;document.form.submit();">A</a></font></div></td>
                  <td width="33%" bgcolor="<?=$cor?>"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="<?=$a ? "#FF0000" : "#0000ff";?>" > 
                    <?="<b>$nome</b><br>G$gerencial:M$manut:D$diagnostico:M$marketing:Ge:$gerente:Lembrete:$lembrete ($lembrete_dias):bl:$fl_edita_chamado_bloqueado"?>
                    ( 
                    <?=$area?>
                    ) </font></td>
                  <td width="23%" bgcolor="<?=$cor?>"> 
                    <?=$hierarquia?>
                    <br> 
                    <?=$superior?>
                  </td>
                  <td width="37%" bgcolor="<?=$cor?>">&nbsp;<a href="mailto:<?=$email?>">login 
                    : <b><? echo $login ?></b><br>
                    <? if($emailsn) {echo "&nbsp;Recebe - ";} else {echo "&nbsp;<B>Não recebe</b> - ";}  echo $email;?>
                    </a> </td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <?}?>
  </table> 
  <p>&nbsp; </p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Legenda&nbsp;&nbsp;<br>
    &nbsp;&nbsp;D - Deletar, A- Alterar</font><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
    &nbsp;&nbsp;<font color="#FF0000">Nome em vermelho quem faz parte do sistema 
    de atendimento</font><br>
    &nbsp;&nbsp;<font color="#0000FF">Nome em Azul quem n&atilde;o faz parte.</font><br>
    Para inclu&iacute;r um usu&aacute;rio. a caixa 'Atendimento ?' serve pra dizer 
    se faz parte ou n&atilde;o.<br>
    Para alterar um usu&aacute;rio, a caixa 'Atendimento ?' serve para alternar 
    entra (faz parte/n&atilde;o faz parte)<br>
    </font><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
    <input type="hidden" name="acao">
    <input type="hidden" name="id">
    </font></p>
</form>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><br>
  </font></p>
<p>&nbsp; </p>
</body>
</html>
<?
}
?>
