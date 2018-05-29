<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: ../index.php");
	}
	
	if (!$confidencial) {
	  $confidencial = '0';
	}

	$label = "Incluir";
	
	if ($acao == "incluir") {
	
	  if ($id == "AGENDA") {
	    $confidencial = 1;
	  }
	
	  $data = "$ano-$mes-$dia";
	  $sql = "Insert into todo (id_usuario, id_categoria, prioridade, descricao, data, memo, checked, confidencial) values ";
	  $sql .= "( ";
	  $sql .= " $ok, $id_categoria, $prioridade, '$descricao', '$data', '$memo', 0, $confidencial ";
	  $sql .= ") ";	  
	  mysql_query($sql);
	  if ($id == "AGENDA") {
        $acao = 'fechar'; 
		$novo=0;
	  }
	  else {
        header("Location: index.php");	  	  
	  }
	} else {
	  if ($acao=='alterar') {  
	  
	     if ($deletar) {
		 
		   $sql = "delete from todo where id = " .$id;
		 
		 } else {
		 
	  
		  $data = "$ano-$mes-$dia";	  
		  $sql = "Update todo set id_categoria =  $id_categoria, ";
		  $sql .= "prioridade = $prioridade, ";
		  $sql .= "descricao = '$descricao', ";
		  $sql .= "data = '$data', ";
		  $sql .= "memo = '$memo', ";
		  
		  if ($pagina=='agenda') {
  		  $sql .= "confidencial = 1 ";
		  } else {
		  $sql .= "confidencial = $confidencial ";
		  }
		  
     	  $sql .= "where id = ". $id;	   
 	  }
		  
		  mysql_query($sql);	  

		  if ($pagina!='agenda') {		  		  
	         header("Location: index.php");	  		  			 
		  } else {
		    $acao = 'fechar';
		  }
	  
	  } else {
		  if ($id) {
			$label = "Alterar";				  
			$acao = "alterar";
			$sql = "select * from todo where id = " . $id;
			$result = mysql_query($sql);
			$linha = mysql_fetch_object($result); 									
			
            $data1 = explode("-", $linha->data);	 	 
			$memo = $linha->memo;			
			$descricao = $linha->descricao;
			$id_categoria = $linha->id_categoria;
			$prioridade = $linha->prioridade;
			$dia = $data1[2];
			$mes = $data1[1];			
			$ano = $data1[0];			
			
			if ($linha->confidencial) {
    			$conf = "checked";
			}
 
 			$dono = 1;
			if ($ok != $linha->id_usuario) {
			  $dono = 0;
			}
						
		  }	  
	  } 
	}

	$sql = "select * from todocategoria order by descricao";
	$result = mysql_query($sql);	
	$cat = "<option value=\"0\">Selecione</option>";	
	while ($linha=mysql_fetch_object($result)) {
		$sel = "";
		if ($id_categoria == $linha->id) {
			$sel = "selected";
		}
			$cat .= "<option value=\"$linha->id\" $sel >$linha->descricao</option>\n";
	} 
	if ($novo==1) {	
    	$acao = "incluir";
		$prioridade = 1;
		$dono = 1;		
		if ($pagina == 'agenda') {
         $id = "AGENDA";
         $conf="checked";		 
		}
	}
	
?>
<html>
<head>
<title>ToDo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head> <body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000">
<form action="" method="post" name="form" id="form">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="9%">Categoria</td>
      <td width="91%"><select name="id_categoria" class="bordaTexto" id="select3">
          <?=$cat?>
        </select> </td>
    </tr>
    <tr> 
      <td>Prioridade</td>
      <td><select name="prioridade" class="borda_fina" id="prioridade">
<?
  for($i=1; $i<=10; $i++) {
    $sel = "";
	if($i == $prioridade) {
	  $sel = 'selected';
	}
?>
          <option value="<?=$i?>" <?=$sel?>  ><?=$i?></option>
<?
 }
?>
		  
        </select></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td><input name="descricao" type="text" class="borda_fina" id="descricao" value="<?=$descricao?>" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Data</td>
      <td><input name="dia" type="text" class="borda_fina" id="dia" value="<?=$dia?>" size="3" maxlength="2">
        / 
        <input name="mes" type="text" class="borda_fina" id="mes" value="<?=$mes?>" size="3" maxlength="2">
        / 
        <input name="ano" type="text" class="borda_fina" id="ano" value="<?=$ano?>" size="5" maxlength="4"></td>
    </tr>
    <tr> 
      <td>Memo</td>
      <td valign="top"><textarea name="memo" cols="100" rows="5" class="borda_fina" id="memo"><?=$memo?></textarea> 
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="confidencial" type="checkbox" id="confidencial" value="1" <?=$conf?> >
        Confid&ecirc;ncial 
        <? if (!$dono) {?>
        <strong>Lembre-se de esta tarefa n&atilde;o foi aberta por voc&ecirc;</strong> 
        <?}?>
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><input name="Button" type="button" class="borda_fina" value="<?=$label?>" onClick="vai();"> 
        <input name="acao" type="hidden" id="acao" value="<?=$acao?>">
        <input name="id" type="hidden" id="id" value="<?=$id?>">
		<? if ($dono) {?>
        <input name="deletar" type="checkbox" id="deletar" value="1">
        Deletar esta tarefa
		<? } ?>
		
		</td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</body>
</html>
<script>
  function vai() {
  
    if (document.form.confidencial.checked) {
	  document.form.id_categoria.value = 5; // Pessoal
	}
  
    if (document.form.id_categoria.value==0) {
	  window.alert("selecione a categoria");
	  document.form.id_categoria.focus();
	  return false;
	}
	
	document.form.submit();
	
  }
  
  if ('<?=$acao?>'=='fechar') {
    opener.location ="/agenda/inicio.php";
	window.close();
  }
</script>