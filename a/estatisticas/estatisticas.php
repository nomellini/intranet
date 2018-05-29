<?php
  require("../scripts/conn.php");	
  require("sql.php");	

  $id = $id_coordenador;
  
  $ano = $_POST["ano"];
  $mes = $_POST["mes"]; 
  $DataInicio = mktime(0,0,0, $mes, 1, $ano);
  $last_day = date("t", $DataInicio);  
  
  $DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
  
  $de = date("Y-m-d", $DataInicio);
  $ate = date("Y-m-d", $DataFim);

	$Data_Ate = explode("-", $ate);
	$Data = mktime(0,0,0, $Data_Ate[1], 1, $Data_Ate[0]);
	$ano = date("Y", $Data - ( 86400*30*12 ) );  
	$mes = date("m", $Data - ( 86400*30*12 ) );
	$deUltimos12 = "$ano-$mes-01";

  //$de = '2009-06-01';
  //$ate = '2009-06-31';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estat&iacute;sticas</title>
<style type="text/css">
<!--
.style1 {font-size: 18.0pt}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<p>Per&iacute;do de <?= date("d/m/Y", $DataInicio);?> Ate <?= date("d/m/Y", $DataFim);?> 
</p>
<p><br />
Contatos</p>
<p>1.1 Recebidos<br /> 
  <br />
  Total de contatos encaminhados
  para &aacute;rea de sistemas e quem os encaminhou.<br />
  <br />
<?
	
	//$result = mysql_query($sql_001)
?>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="162" valign="top" bgcolor="silver">Nome</td>
    <td width="48" valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
  </tr>
<?

	$sql_001 = getSql_001($de, $ate, $id);	
	$result = mysql_query($sql_001) or die (mysql_error());
	$soma = 0;
	
	while ($linha = mysql_fetch_object($result)) {
		$Pessoa = $linha->nome;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td width="162" valign="top" bgcolor="silver"><?=$Pessoa?></td>
    <td width="48" valign="top" bgcolor="silver"><div align="center">
      <?=$Qtde?>
    </div></td>
  </tr>
<?
	}
?>
  <tr>
    <td width="162" valign="top">T O T A L</td>
    <td width="48" valign="top"><div align="center">
      <?=$soma?>
    </div></td>
  </tr>
</table>
<br />
<p>1.2 Por Sistema </p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%" valign="top"><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top" bgcolor="silver">Sistema</td>
        <td  valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
      </tr>
 <?
 
 	$sql_002 = getSql_002($de, $ate, $id);
//	echo($sql_002);

	$result = mysql_query($sql_002) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$id_sistema = $linha->id_sistema;
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
      <tr>
        <td bgcolor="silver"><a href="grafico_Contatos_Sistema.php?sistema=<?=$id_sistema?>&ate=<?=$ate?>&id=<?=$id?>" target="_blank"><?=$Sistema?></a></td>
        <td bgcolor="silver"><div align="center">
            <?=$Qtde?>
        </div></td>
      </tr>
      <?
	}
?>
      <tr>
        <td valign="top">T O T A L</td>
        <td  valign="top"><div align="center">
            <?=$soma?>
        </div></td>
      </tr>
    </table></td>
    <td width="50%" valign="top">	
		<img src="grafico_001.php?de=<?=$de?>&amp;ate=<?=$ate?>&id=<?=$id?>">	
	</td>
  </tr>
</table>
<p><br />
2. Chamados</p>
<p>2.1 Por sistema<br />
Somat&oacute;ria dos chamados enviados para Sistemas sem repeti&ccedil;&atilde;o.

<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td  valign="top" bgcolor="silver">Sistema</td>
    <td  valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
  </tr>
  <?
 
 	$sql = getSqlContatosPorSistema($de, $ate, $id);

	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td bgcolor="silver"><?=$Sistema?></td>
    <td bgcolor="silver"><div align="center">
      <?=$Qtde?>
    </div></td>
  </tr>
  <?
	}
?>
  <tr>
    <td valign="top">T O T A L</td>
    <td  valign="top"><div align="center">
      <?=$soma?>
    </div></td>
  </tr>
</table>
<p>2.2 Diagn&oacute;sticos<br />
Diagn&oacute;stico de todos os chamados enviados &agrave; sistemas com programadores.</p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%" valign="top"><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top" bgcolor="silver">Diagn&oacute;stico </td>
        <td  valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
      </tr>
      <?
 
 	$sql = getSqlDiagnosticos($de, $ate, $id);
	
	
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Descricao = $linha->descricao;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
      <tr>
        <td bgcolor="silver"><?=$Descricao?></td>
        <td bgcolor="silver"><div align="center">
          <?=$Qtde?>
        </div></td>
      </tr>
      <?
	}
?>
      <tr>
        <td valign="top">T O T A L</td>
        <td  valign="top"><div align="center">
          <?=$soma?>
        </div></td>
      </tr>
    </table></td>
    <td width="50%" valign="top"><img src="Grafico_Diagnostico.php?de=<?=$de?>&amp;ate=<?=$ate?>&id=<?=$id?>" /> </td>
  </tr>
</table>
<p>Diagn&oacute;stico de todos os chamados enviados &agrave; sistemas sem programadores</p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%" valign="top"><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top" bgcolor="silver">Diagn&oacute;stico </td>
        <td  valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
      </tr>
      <?
 
 	$sql = getSqlDiagnosticos_com($de, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Descricao = $linha->descricao;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
      <tr>
        <td bgcolor="silver"><?=$Descricao?></td>
        <td bgcolor="silver"><div align="center">
          <?=$Qtde?>
        </div></td>
      </tr>
      <?
	}
?>
      <tr>
        <td valign="top">T O T A L</td>
        <td  valign="top"><div align="center">
          <?=$soma?>
        </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>Maiores intera&ccedil;&otilde;es com a consultoria (Centralizado no Éder) </p>
<table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top" bgcolor="silver">Chamado</td>
        <td  valign="top" bgcolor="silver">Sistema</td>
        <td  valign="top" bgcolor="silver">Diagnóstico</td>
        <td align="center"  valign="middle" bgcolor="silver">Quantidade</td>						
      </tr>
      <?
 
	$sql = getSqlMaioresInteracoesConsultoria($de, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Chamado = $linha->chamado_id;
		$Sistema = $linha->sistema;
		$Diagnostico = $linha->diagnostico;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
      <tr>
        <td bgcolor="silver"><a href="/a/historicochamado.php?id_chamado=<?=$Chamado?>" target="_blank"><?=$Chamado?></a></td>	  
        <td bgcolor="silver"><?=$Sistema?></td>
        <td bgcolor="silver"><?=$Diagnostico?></td>
        <td align="center" valign="middle" bgcolor="silver"><?=$Qtde?></td>
      </tr>
      <?
	}
?>
      <tr>
        <td valign="top">&nbsp;</td>	  
        <td valign="top">&nbsp;</td>
        <td valign="top">T O T A L</td>
        <td align="center"  valign="middle"><?=$soma?></td>
      </tr>
</table>
<p>Maiores intera&ccedil;&otilde;es com a consultoria <br />
ultimos 12 meses, de <?=$deUltimos12?> até <?=$ate?>  (Centralizado no Éder) </p>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td  valign="top" bgcolor="silver">Chamado</td>
    <td  valign="top" bgcolor="silver">Sistema</td>
    <td  valign="top" bgcolor="silver">Diagn&oacute;stico</td>
    <td align="center"  valign="middle" bgcolor="silver">Quantidade</td>
  </tr>
  <?
 
	$sql = getSqlMaioresInteracoesConsultoria($deUltimos12, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Chamado = $linha->chamado_id;
		$Sistema = $linha->sistema;
		$Diagnostico = $linha->diagnostico;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td bgcolor="silver"><a href="/a/historicochamado.php?id_chamado=<?=$Chamado?>" target="_blank">
      <?=$Chamado?>
    </a></td>
    <td bgcolor="silver"><?=$Sistema?></td>
    <td bgcolor="silver"><?=$Diagnostico?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Qtde?></td>
  </tr>
  <?
	}
?>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">T O T A L</td>
    <td align="center"  valign="middle"><?=$soma?></td>
  </tr>
</table>
<p>Contatos por pessoa Qualidade (Eneas) </p>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="249"  valign="top" bgcolor="silver">Nome</td>
    <td width="143" align="center"  valign="middle" bgcolor="silver">Quantidade</td>
  </tr>
  <?
 
	$sql = getSqlContatosPorPessoaQualidade($de, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Nome = $linha->nome;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td bgcolor="silver"><?=$Nome?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Qtde?></td>
  </tr>
  <?
	}
?>
  <tr>
    <td valign="top">T O T A L</td>
    <td align="center"  valign="middle"><?=$soma?></td>
  </tr>
</table>


<p>Contatos por Sistema Qualidade (Eneas) </p>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="249"  valign="top" bgcolor="silver">Nome</td>
    <td width="143" align="center"  valign="middle" bgcolor="silver">Quantidade</td>
  </tr>
  <?
 
	$sql = getSqlContatosPorSistemaQualidade($de, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Nome = $linha->sistema;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td bgcolor="silver"><?=$Nome?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Qtde?></td>
  </tr>
  <?
	}
?>
  <tr>
    <td valign="top">T O T A L</td>
    <td align="center"  valign="middle"><?=$soma?></td>
  </tr>
</table>

<p>&nbsp;</p>
<p>Chamados por sistema Qualidade sem repeti&ccedil;&atilde;o </p>
<table width="415" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="254"  valign="top" bgcolor="silver">Sistema</td>
    <td width="155" align="center"  valign="middle" bgcolor="silver">Quantidade</td>
  </tr>
  <?
 
	$sql = getSqlChamadosPorSistemaQualidade($de, $ate, $id);
	$result = mysql_query($sql) or die (mysql_error());	
	$soma = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Chamado = $linha->chamado_id;
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td bgcolor="silver"><?=$Sistema?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Qtde?></td>
  </tr>
  <?
	}
?>
  <tr>
    <td valign="top">T O T A L</td>
    <td align="center"  valign="middle"><?=$soma?></td>
  </tr>
</table>
<p>&nbsp;</p>

Chamados com diagnóstico de "ERRO DE PROGRAMA: Cliente ou Interno", alterado entre <?=dataOk($de)?> e <?=dataOk($ate)?>

<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="254"  valign="top" bgcolor="silver">Chamado</td>
    <td width="155" align="center"  valign="middle" bgcolor="silver">Data</td>
    <td width="155" align="center"  valign="middle" bgcolor="silver">Nome</td>
    <td width="155" bgcolor="silver">Diagnostico</td>    
  </tr>

<?
	$sql = "Select c.id_chamado, c.Dt_UltimoDiagnostico data, u.nome, d.diagnostico 
from chamado c
  inner join usuario u on u.id_usuario = c.Id_Usuario_Diagnostico
  inner join diagnostico d on d.id_diagnostico = c.diagnostico_id
where 
  (d.id_diagnostico = 2 or d.id_diagnostico = 24) ";
  
	$sql .= " and  dt_UltimoDiagnostico >= '$de' and dt_UltimoDiagnostico <= '$ate'";
	
	$sql .= " order by u.nome, d.diagnostico ";

	$result = mysql_query($sql);
	while( $linha = mysql_fetch_object($result))
	{
		$Data = dataOk($linha->data);
		$Id_Chamado = $linha->id_chamado;
		$Nome = $linha->nome;
		$Diagnostico = $linha->diagnostico;
?>
	
  <tr>
    <td bgcolor="silver"><?=$Id_Chamado?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Data?></td>
    <td align="center" valign="middle" bgcolor="silver"><?=$Nome?></td>
    <td bgcolor="silver"><?=$Diagnostico?></td>    
  </tr>    

<?	
	}
?>
</table>
</body>

</html>
