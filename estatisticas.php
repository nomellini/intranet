<?php
  require("a/scripts/conn.php");	
  $de = '2009-06-01';
  $ate = '2009-06-31';
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
<table border="1" cellspacing="0" cellpadding="0" width="720">
  <tr>
    <td width="720" valign="top" bgcolor="#E6E6E6"><p><b><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Objetivo</span></b></p></td>
  </tr>
  <tr>
    <td width="720" valign="top"><p><span style='font-size:11.0pt;
  font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Mostrar os indicadores da &aacute;rea de Sistema e
        suas intera&ccedil;&otilde;es com as outras &aacute;reas da empresa principalmente Consultoria e
        Qualidade.</span></p>
      <p><span
  style='font-size:11.0pt;font-family:Symbol'>&middot;<span style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>&Iacute;ndice
        EC &ndash; Erros por chamados</span></p>
      <p><span style='font-size:11.0pt;
  font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Este &iacute;ndice reflete o percentual de
        chamados recebidos por &ldquo;erro de programa&rdquo;. O ideal seria 0%.</span></p>
      <p><span style='font-size:11.0pt;
  font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>&Eacute; dif&iacute;cil registrar erros de programas pois
        o erro em si pode ser conseq&uuml;&ecirc;ncia de uma altera&ccedil;&atilde;o feita no m&ecirc;s em an&aacute;lise
        ou v&aacute;rios anos atr&aacute;s. </span></p></td>
  </tr>
</table>
<br />
<table border="1" cellspacing="0" cellpadding="0" width="713">
  <tr>
    <td valign="top" bgcolor="#E6E6E6"><p><b><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>&Iacute;ndice </span></b></p></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="white"><p><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Contatos</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>1.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Recebidos</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>1.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Por sistema</span><br />
          <br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Chamados</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Por sistema</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Diagn&oacute;sticos</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.2.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Crit&eacute;rios
        de diagn&oacute;sticos</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.3.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Maiores intera&ccedil;&otilde;es
        com a Consultoria<br />
        </span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.3.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>No
        m&ecirc;s</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>2.3.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Nos
        &uacute;ltimos 6 meses</span></p>
      <p><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>3.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Qualidade</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>3.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Contatos recebidos</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>3.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Chamados recebidos</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>3.3.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Maiores intera&ccedil;&otilde;es
      com Sistemas</span><br />
      <br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>4<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>&Iacute;ndices</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>4.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>EC &ndash; Erros de
      programas / chamados</span></p>
      <p><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Produtividade<br />
      </span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Quantidade de chamados
      por programador</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Rela&ccedil;&atilde;o contatos /
      chamados</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Programador /
      Sistema</span></p>
      <p><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.1.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Altenier</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Daniel</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.3.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Hamilton</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.4.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Rog&eacute;rio</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.5.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Ed&iacute;lson</span><br />
        <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.1.6.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Jos&eacute;
      Roberto</span><br />
      <span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>5.2.2.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Percentual de
      retorno por programador</span></p>
      <p><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>6.<span
  style='font:7.0pt &quot;Times New Roman&quot;'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span
  style='font-size:11.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;'>Projetos</span></p></td>
  </tr>
</table>

<p><br />
Contatos</p>
<p>1.1 Recebidos<br /> 
  <br />
  Total de contatos encaminhados
  para &aacute;rea de sistemas e quem os encaminhou.<br />
  <br />
<?
	$result = mysql_query($sql_001)
?>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="162" valign="top" bgcolor="silver">Nome</td>
    <td width="48" valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
  </tr>
<?
	$sql_001 = "SELECT nome, count(*)  AS soma ";
	$sql_001 .= "FROM contato, usuario ";
	$sql_001 .= "WHERE destinatario_id =7 ";
	$sql_001 .= "AND usuario.id_usuario = consultor_id  ";
	$sql_001 .= "AND dataa >=  '$de' AND dataa <=  '$ate' ";
	$sql_001 .= "GROUP  BY consultor_id ";
	$sql_001 .= "ORDER  BY soma DESC, nome ";
	
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
<p>Por Sistema </p>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%" valign="top"><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td  valign="top" bgcolor="silver">Sistema</td>
        <td  valign="top" bgcolor="silver"><div align="center">Quantidade</div></td>
      </tr>
 <?
	$sql_002 = "SELECT sistema, count(  *  )  AS soma ";
	$sql_002 .= "FROM contato, chamado, sistema ";
	$sql_002 .= "WHERE contato.destinatario_id =7  "; 
	$sql_002 .= "AND contato.consultor_id <> 39 ";
	$sql_002 .= "AND contato.consultor_id <> 85 ";
	$sql_002 .= "AND contato.consultor_id <> 14 ";
	$sql_002 .= "AND contato.consultor_id <> 90 ";
	$sql_002 .= "AND contato.consultor_id <> 98 ";
	$sql_002 .= "AND contato.consultor_id <> 172 ";
	$sql_002 .= "AND contato.consultor_id <> 173 ";
	$sql_002 .= "AND contato.consultor_id <> 12 ";
	$sql_002 .= "AND contato.consultor_id <> 43 ";
	$sql_002 .= "AND contato.consultor_id <> 169 ";
	$sql_002 .= "AND contato.consultor_id <> 170 ";
	$sql_002 .= "AND contato.consultor_id <> 171 ";
	$sql_002 .= "AND contato.consultor_id <> 178 ";
	$sql_002 .= "AND contato.consultor_id <> 08 ";
	$sql_002 .= "AND contato.chamado_id = chamado.id_chamado  ";
	$sql_002 .= "AND sistema.id_sistema = chamado.sistema_id  ";
	$sql_002 .= "AND contato.dataa >=  '$de'  ";
	$sql_002 .= "AND contato.dataa <=  '$ate' ";
	$sql_002 .= "GROUP  BY sistema.sistema ";
	$sql_002 .= "ORDER  BY soma DESC, sistema.sistema ";

	$result = mysql_query($sql_002) or die (mysql_error());	
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
    </table></td>
    <td width="50%" valign="top">	
		<img src="statgraphs.php?de=<?=$de?>&ate=<?=$ate?>">	
	</td>
  </tr>
</table>
<br />
</body>
</html>
