<?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad);
 if(!isset($ordem)) {
   $ordem = "nome";
 }
 
function pegaCargo($cargo) {
  if($cargo) {
    $sql = "Select cargo from cargos where id_cargo = $cargo;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;
    $idtemp = $linha->cargo;
    return $idtemp; 
  } else {
    return "Cargo não cadastrado";
  }
} 
 
?>
<html>
<head>
<title>Pessoas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>

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
<?echo "hoje é ";?>
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

     document.write (diasemana[diaindex] + ',  ' +  dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
</font></font> 
<p><img src="../../figuras/intro.gif" width="321" height="21"> </p>
<form name="form1" method="post" action="<?=$script_name?>">
  Filtros:<br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="10%">Cargo:</td>
      <td width="90%">
        <select name="cargo" class="unnamed1">
          <option value="0">Todos</option>
		  <? 
		    $result = mysql_query("select * from cargos order by cargo;");
			while ($linha=mysql_fetch_object($result)) {
			  $s="";
			  if ($linha->id_cargo==$cargo) {
			    $s = "selected";
			  }
			  echo "<option value=$linha->id_cargo $s>$linha->cargo</option>";
			}
		  ?>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="10%">Empresa:</td>
      <td width="90%">
        <select name="empresa" class="unnamed1">
          <option value="0">Todas</option>
		  <? 
		    $result = mysql_query("select distinct cliente_id from pessoa order by cliente_id");
			while ($linha=mysql_fetch_object($result)) {
			  $s="";
			  if ($linha->cliente_id==$empresa) {
			    $s = "selected";
			  }
			  echo "<option value=\"$linha->cliente_id\" $s>$linha->cliente_id</option>";
			}
		  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="10%">&nbsp;</td>
      <td width="90%">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<p>
  <?
 $sql = "select pessoa.* from pessoa where id_pessoa>0 ";
 if($cargo) {
   $sql .= "and cargo_id=$cargo ";
 }
 if ($empresa) {
   $sql .= "and cliente_id = '$empresa' ";
 }
 $sql .= " order by $ordem;";
 $result = mysql_query($sql);
?>
</p>
<table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td><a href="<?=$SCRIPT_NAME?>?ordem=nome">Nome</a></td>
    <td><a href="<?=$SCRIPT_NAME?>?ordem=cargo_id,+nome">Cargo</a> </td>
    <td><a href="<?=$SCRIPT_NAME?>?ordem=cliente_id,+nome">Empresa</a></td>
    <td>Telefone</td>
  </tr>
  <? $c=0; while($linha=mysql_fetch_object($result)) {?>
  <tr bgcolor="<? echo (($c++ % 2)==0) ? "#FDF1D7" : "#FCE9BC" ?>"> 
    <td> 
      <?=$linha->nome?>
    </td>
    <td> 
      <?=pegaCargo($linha->cargo_id)?>
    </td>
    <td > <a href="clientes02.php?id_cliente=<?=$linha->cliente_id?>"> 
      <?=$linha->cliente_id?></a> </td>
    <td> 
      <?=$linha->telefone?>
    </td>
  </tr>
  <?}?>
</table>
<p>&nbsp;</p>
</body>
</html>
