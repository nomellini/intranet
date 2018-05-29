<?
	require("../../scripts/conn.php");	
	require("../../scripts/connm.php");		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $pode = pegaMarketing($ok);
	if(!$pode) {
	  require("../../sinto.htm");
	  exit;
	} else {	

    $sql = "SELECT * from clienteplus WHERE id_cliente = '$id_cliente';";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
    $quando = explode("-", $linha->previsao);
    $dataa = "$quando[2]/$quando[1]/$quando[0]";		  	
		  
?>
<html>
<head>
<script src="../../coolbuttons.js"></script>
<link rel="stylesheet" href="../../stilos.css" type="text/css">
<title>Detalhes</title>
<body bgcolor="#FFFFFF" text="#000000">
<table width="50%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/manut/marketing.php"><img src="../../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ manuten&ccedil;&atilde;o</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> 
<?echo "Olá, $nomeusuario, hoje é ";?>
</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
<script language="JavaScript">

function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('../selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }

function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}

      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "segunda-feira";
      diasemana[2] = "terça-feira";
      diasemana[3] = "quarta-feira";
      diasemana[4] = "quinta-feira";
      diasemana[5] = "sexta-feira";
      diasemana[6] = "sábado";
      diasemana[7] = "domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   

     document.write (diasemana[diaindex] + ' ' +  dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
</font></font> 
<blockquote> 
  <p> <b><font color="#0000FF"> 
    <?="$linha->cliente   [ $id_cliente ]  - Senha: $linha->senha"?>
    </font></b></p>
</blockquote>
<form name="form1" method="post" action="doalteradados.php">
  <table width="88%" border="0" cellspacing="1" cellpadding="0" align="center">
    <tr bgcolor="<?=($linha->bloqueio ? "#FFECEC" : "#E8ECFF") ?>" > 
      <td width="30%" align="right" valign="top">Cliente bloqueado ?</td>
      <td width="70%"> 
        <input type="radio" name="bloqueio" value="1" <?=($linha->bloqueio ? "checked" : "") ?> >
        Sim 
        <input type="radio" name="bloqueio" value="0" <?=($linha->bloqueio ? "" : "checked") ?> >
        N&atilde;o </td>
    </tr>
    <tr bgcolor="<?=($linha->atendimento ? "#FFECEC" : "#E8ECFF") ?>"> 
      <td width="30%" align="right" valign="top">Sistema de atendimento</td>
      <td width="70%"> 
        <input type="radio" name="sad" value="1" <?=($linha->atendimento ? "checked" : "") ?> >
        Sim 
        <input type="radio" name="sad" value="0" <?=($linha->atendimento ? "" : "checked") ?> >
        N&atilde;o </td>
    </tr>
    <tr bgcolor="<?=(!$linha->prospect ? "#FFECEC" : "#E8ECFF") ?>"> 
      <td width="30%" align="right" valign="top">J&aacute; &eacute; cliente</td>
      <td width="70%"> 
        <input type="radio" name="cliente" value="1" <?=($linha->prospect ? "" : "checked") ?> >
        Sim 
        <input type="radio" name="cliente" value="0" <?=($linha->prospect ? "checked" : "") ?> >
        N&atilde;o </td>
    </tr>
    <tr>
      <td align="right" valign="top">Cliente Intersystem</td>
      <td><input type="radio" name="Ic_Intersystem" value="1" <?=($linha->Ic_Intersystem == 0 ? "" : "checked") ?> > Sim
  <input type="radio" name="Ic_Intersystem" value="0" <?=($linha->Ic_Intersystem == 0 ? "checked" : "") ?> >
N&atilde;o </td>
    </tr>
    <tr>
      <td align="right" valign="top"><p>DATACENTER</p></td>
      <td><input type="radio" name="Ic_Datacenter" value="1" <?=($linha->Ic_Datacenter == 0 ? "" : "checked") ?> >
Sim
  <input type="radio" name="Ic_Datacenter" value="0" <?=($linha->Ic_Datacenter == 0 ? "checked" : "") ?> >
N&atilde;o </td>
    </tr>
    <tr>
      <td align="right" valign="top">SLA </td>
      <td><input type="radio" name="Ic_SLA" value="1" <?=($linha->Ic_SLA == 0 ? "" : "checked") ?> >
Sim
  <input type="radio" name="Ic_SLA" value="0" <?=($linha->Ic_SLA == 0 ? "checked" : "") ?> >
N&atilde;o<br>
TEMPO DE SLA<br>
<input name="qt_sla" type="text" id="qt_sla" size="50" maxlength="255" value="<?=$linha->Qt_SLA ?>"></td>
    </tr>
    <tr>
      <td align="right" valign="top">Pós Venda </td>
      <td><input type="radio" name="Ic_PosVenda" value="1" <?=($linha->Ic_PosVenda == 0 ? "" : "checked") ?> >
Sim
  <input type="radio" name="Ic_PosVenda" value="0" <?=($linha->Ic_PosVenda == 0 ? "checked" : "") ?> >
N&atilde;o </td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Respons&aacute;vel 
        : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> 
        <select name="responsavel" class="unnamed1" >
          <?
    echo "<option value=0>Responsável não cadastrado</option>";				
	$sistema = listaUsuarios();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"];
	  $se= "";
	  if ($id == $linha->responsavel) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  	  
	}
	
  ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Ramo de Atividade 
        : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> 
        <select name="ramo_id" class="unnamed1" >
          <?
    echo "<option value=0>Ramo não catastrado</option>";				
	$sistema = listaRamo();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_ramo"];
	  $si = $tmp["ramo"];
	  $se= "";
	  if ($id == $linha->ramo_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  	  
	}
	
  ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Email oficial 
        : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> 
        <input type="text" name="email" value="<?=$linha->email?>" class="unnamed1" size="50" maxlength="100">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Site : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> 
        <input type="text" name="site" value="<?=$linha->site?>" class="unnamed1" size="50" maxlength="100">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Como ficou sabendo 
        : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> 
        <select name="onde_id" class="unnamed1" >
          <?
    echo "<option value=0>não catastrado</option>";				
	$sistema = listaOnde();
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_onde"];
	  $si = $tmp["onde"];
	  $se= "";
	  if ($id == $linha->onde_id) {
	    $se = "selected";
	  }
	  echo "<option value=$id $se>$si</option>\n";	  	  
	}
	
  ?>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">&nbsp;</td>
      <td width="70%"><font color="#0000FF"></font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Endere&ccedil;o 
        : </font></td>
      <td width="70%"><font color="#0000FF"> 
        <input type="text" name="endereco" class="unnamed1" value="<?=$linha->endereco?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Bairro : </font></td>
      <td width="70%"><font color="#0000FF"> 
        <input type="text" name="bairro" class="unnamed1" value="<?=$linha->bairro?>" size="50" maxlength="50">
        </font><font size="1" color="#0000FF"> </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top"><font size="1">Cidade : </font></td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="cidade" class="unnamed1" value="<?=$linha->cidade?>" size="50" maxlength="50">
        </font><font size="1" color="#0000FF"> </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Uf : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="uf" class="unnamed1" value="<?=$linha->uf?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">CEP : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="cep" class="unnamed1" value="<?=$linha->cep?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Telefone : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="telefone" class="unnamed1" value="<?=$linha->telefone?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Fax : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="fax" class="unnamed1" value="<?=$linha->fax?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">CNPJ : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="cnpj" class="unnamed1" value="<?=$linha->cnpj?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">INSC : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="insc" class="unnamed1" value="<?=$linha->insc?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">GIP : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="gip" class="unnamed1" value="<?=$linha->gip? $linha->gip:0?>" size="5" maxlength="5">
        Funcionarios</font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Finantial Cont&aacute;bil : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="contabil" class="unnamed1" value="<?=$linha->contabil?$linha->contabil:0?>" size="5" maxlength="5">
        Lan&ccedil;amentos</font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Finantial Ativo : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="ativo" class="unnamed1" value="<?=$linha->ativo?$linha->ativo:0?>" size="5" maxlength="5">
        Itens</font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Funcion&aacute;rios : </td>
      <td width="70%"><font color="#0000FF"> 
        <input type="text" name="funcionarios" class="unnamed1" value="<?=$linha->funcionarios?>" size="4" maxlength="4">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Quantas pessoas no DP : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="pessoasnodp" class="unnamed1" value="<?=$linha->pessoasnodp?>" size="4" maxlength="4">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Folha Anterior e quanto tempo 
        utiliza : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="folhaanterior" class="unnamed1" value="<?=$linha->folhaanterior?>" size="50" maxlength="50">
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Previs&atilde;o de implanta&ccedil;&atilde;o 
        do sistema de folha datamace : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <input type="text" name="previsao" class="unnamed1" value="<?=$dataa?>" size="12" maxlength="12">
        dd/mm/aaaa</font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Convers&atilde;o de dados ? : 
      </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <textarea name="conversao" class="unnamed1" cols="50" rows="3"><?=$linha->conversao?></textarea>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Servi&ccedil;os Intersystem ? 
        : </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <textarea name="intersystem" class="unnamed1" cols="50" rows="3"><?=$linha->intersystem?></textarea>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Rede + Sistema Oper.: </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <textarea name="rede" class="unnamed1" cols="50" rows="3"><?=$linha->rede?></textarea>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Banco de dados: </td>
      <td width="70%"><font size="1" color="#0000FF"> </font><font color="#0000FF"> 
        <textarea name="banco" class="unnamed1" cols="50" rows="3"><?=$linha->banco?></textarea>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">Obs : </td>
      <td width="70%"><font color="#0000FF"> 
        <textarea name="obs" class="unnamed1" cols="50" rows="3"><?=$linha->obs?></textarea>
        </font></td>
    </tr>
    <tr> 
      <td width="30%" align="right" valign="top">&nbsp; </td>
      <td width="70%"> 
        <input type="submit" name="Submit" value="Gravar dados para `<?=$id_cliente?>`">
        <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
      </td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>

<?
}
?>