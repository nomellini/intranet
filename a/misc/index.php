<?
	require_once("../scripts/conn.php");	
	require_once("../scripts/stats.php");	
	require_once("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	$qtech = 0;
	$hoje = date('d/m/Y');
	$sql = "select count(*) as qtde, externo from chamado group by externo";
	$result = mysql_query($sql) or die($sql);	
	while ($linha = mysql_fetch_object($result)) {
    	if ($linha->externo) {
			$_online = $linha->qtde;
        	$online = number_format($linha->qtde,0 , ',', '.');
		} else {
			$_chamados = $linha->qtde;
            $chamados = number_format($linha->qtde,0 , ',', '.');		
		}
		$qtech = $qtech   + $linha->qtde;
	}
	

	$sql = "select count(*) as qtde from contato";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result);
	$qtdecontatos = $linha->qtde;
	$_contatos = $qtdecontatos;
	$contatos = number_format($qtdecontatos,0 , ',', '.');


	$sql = "select min(dataa) data from chamado where id_chamado > 0";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result);
	$data = $linha->data;	
	$data = explode('-', $data);
	$data = "$data[2]/$data[1]/$data[0]";
	
	$sql = "Select  count(*) as qtde, origem.origem from ";
	$sql = 	$sql . "  contato inner join origem on origem.id_origem = contato.origem_id ";
	$sql = 	$sql . "group by  origem order by  qtde;";
	
	
/*
Quantidade de contatos por tipo
Alberto diz:
isso ai.. com um destaque para o online
Alberto diz:
alias.. o online seriam chamados... e nao contatos
*/
	
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../relatorios/stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #FF0000}
-->
</style>
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<SCRIPT LANGUAGE="JavaScript" SRC="../relatorios/../overlib.js"></SCRIPT>
<script src="../relatorios/coolbuttons.js"></script></head>
<body bgcolor="#FFFFFF" text="#000000"> 
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" ><table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton">&nbsp;</td>
  </tr>
</table>
<p>Estat&iacute;sticas sobre o SAD.</p>
<table width="480"  border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="25%">Chamados Internos</td>
    <td width="75%"><strong>
      <?=$chamados?>
    </strong></td>
  </tr>
  <tr>
    <td><span class="style2">Chamados ON LINE </span></td>
    <td><span class="style2"><strong>
      <?=$online?>
    </strong></span></td>
  </tr>
  <tr>
    <td>Contatos</td>
    <td><strong>
      <?=$contatos?>
    </strong></td>
  </tr>
  <tr>
    <td>M&eacute;dia</td>
    <td><strong>
      <?=floor( ($qtdecontatos/$qtech) * 100)/100?> 
    contatos por chamado</strong></td>
  </tr>
  <tr>
    <td>Operando por </td>
    <td><strong>            <?= dateDiff($data)?>
    </strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
TOP 10 Tipos de contato<br> 
<br>
<table width="480"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#333333">
    <td width="302"><span class="style1">Tipo de contato </span></td>
    <td width="171" align="right"><span class="style1">Qtde de contatos </span></td>
    <td width="171" align="right" class="style1">Percentual</td>
  </tr>
<?
	$sql = "Select  count(*) as qtde, origem.origem from ";
	$sql = 	$sql . "  contato left join origem on origem.id_origem = contato.origem_id ";
	$sql = 	$sql . "group by  origem order by  qtde desc LIMIT 10;";
	$result = mysql_query($sql);
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
	
    	$qtde = $linha->qtde;
		$Percentual =  $qtde / $_contatos * 100;
		$Percentual = number_format($Percentual, 2, ',', '');		
    	$qtde = number_format($linha->qtde,0 , ',', '.');		
	
?>  
  <tr bgcolor="#FFFFFF">
    <td><?=$linha->origem?></td>
    <td align="right"><?=$qtde?></td>
    <td align="right"><?=$Percentual?> %</td>
  </tr>
<?
  }
?>
</table>

<br>
TOP 20 Clientes [Exclu&iacute;ndo Datamace]<br>
<br>
<table   border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#333333">
    <td width="302"><span class="style1">ID CLiente</span></td>
    <td width="171" align="right"><span class="style1">Qtde de chamados </span></td>
    <td width="171" align="right"><span class="style1">Chamados/Mês</span></td>
    <td width="171" align="right" class="style1">Percentual</td>
  </tr>
<?
	$sql = "select cliente_id, count(*) as qtde from chamado where cliente_id <> 'datamace' group by cliente_id  order by qtde desc limit 20;";
	$result = mysql_query($sql);
	$soma = 0;
	
	// Arredondando para 365 dias no ano e 30 dias no mês.
	$Data_Atual_Array = explode('-', $Data_Atual);
	
	$dias_hoje = $Data_Atual_Array[0] * 12 + $Data_Atual_Array[1] + $Data_Atual_Array[2] / 30;
	
	while ($linha = mysql_fetch_object($result)) {
    	$qtde = $linha->qtde;
		$Percentual =  $qtde / ($_chamados + $_online)* 100;
		$Percentual = number_format($Percentual, 2, ',', '');				
    	$qtde = number_format($linha->qtde,0 , ',', '.');		
		$quantidade_real = $linha->qtde;
		
		$sql_data = "select min(dataa) data from chamado where cliente_id = '$linha->cliente_id'";
		$result_data = mysql_query($sql_data);
		$linha_data = mysql_fetch_object($result_data);
		$data = dataOk($linha_data->data);
		$data_Array = explode('/', $data);
		
		$dias = $dias_hoje - ($data_Array[2] * 12 + $data_Array[1] + $data_Array[0]/30); 

		$chamadosDia = $quantidade_real / $dias;
		$chamadosDia = number_format($chamadosDia, 2);

		
?>  
  <tr bgcolor="#FFFFFF">
    <td><?=$linha->cliente_id?> - <?=dateDiff($data)?></td>
    <td align="right"><?=$qtde?></td>
    <td align="right"><?=$chamadosDia?></td>
    <td align="right"><?=$Percentual?> %</td>
  </tr>
<?
  }
?>
</table>

<br>
TOP 20 Usuarios 
<br>
<br>
<table  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#333333">
    <td width="302"><span class="style1">Usuario</span></td>
    <td width="171" align="right"><span class="style1">Contatos inseridos</span></td>
    <td width="171" align="right"><span class="style1">Contatos/Mes</span></td>
    <td width="171" align="right" class="style1">Percentual</td>
  </tr>
<?
	$sql = "select 
			usuario.nome,  
			contato.consultor_id,  
			count(*) as qtde  
		from  contato, usuario 
		where contato.consultor_id = usuario.id_usuario and  usuario.ativo 
		group by  usuario.nome, contato.consultor_id
		order by qtde desc   
		limit 20;";
	$result = mysql_query($sql);
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
    	$qtde = $linha->qtde;
		$Percentual =  $qtde / $_contatos * 100;
		$Percentual = number_format($Percentual, 2, ',', '');		
    	$qtde = number_format($linha->qtde,0 , ',', '.');		
		$quantidade_real = $linha->qtde;
		
		
		$sql_data = "select min(dataa) data from contato where consultor_id = '$linha->consultor_id' and dataa>='2001-01-01'";
		$result_data = mysql_query($sql_data);
		$linha_data = mysql_fetch_object($result_data);
		$data = dataOk($linha_data->data);
		$data_Array = explode('/', $data);
		
		$dias = $dias_hoje - ($data_Array[2] * 12 + $data_Array[1] + $data_Array[0]/30); 

		$chamadosDia = $quantidade_real / $dias;
		$chamadosDia = number_format($chamadosDia, 2);
		
		
		
?>  
  <tr bgcolor="#FFFFFF">
    <td><?=$linha->nome?>  - <?=dateDiff($data)?></td>
    <td align="right"><?=$qtde?></td>
    <td align="right"><?=$chamadosDia?></td>    
    <td align="right"><?=$Percentual?> %</td>
  </tr>
<?
  }
?>
</table>

<p>Top 10 Contatos</p>

<table width="480"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#333333">
    <td width="171" align="right"><span class="style1">Chamado</span></td>
    <td width="171" align="right" class="style1">Contatos</td>
  </tr>
<?
	$sql = "select chamado_id id, sum(1) soma from contato 
  inner join chamado on contato.chamado_id = chamado.id_chamado
	where chamado.cliente_id <> 'DATAMACE' 
group by chamado_id
order by sum(1) desc
limit 10";

	$result = mysql_query($sql);
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
?>  
  <tr bgcolor="#FFFFFF">
    <td align="center"><?=$linha->id?></td>
    <td align="center"><?=$linha->soma?></td>
  </tr>
<?
  }
?>
</table>

<?

?>
</body>
</html>
