<? require("../scripts/conn.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Chamado:<br />
  Descrição:<br />
</p>
<p>Setar restrições: 
Caso uma restição já tenha histórico, não será possível excluir uma restrição do chamado.</p>
<table width="65%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="7%"><p>Selecionar</p></td>
    <td width="52%">Restrição</td>
    <td width="35%">Impede ?</td>
  </tr>
<?
	$sql = "select r.Id, Ds_Descricao restricao, Ic_ImpedeEncerramentoChamado impede from restricoes r left join 
	rl_restricao_chamado rrc on r.Id = rrc.Id_Restricao where rrc.Id_Chamado = " . $_GET["id"];
	
	$result = mysql_query($sql) or die(mysql_error()) ;
	
 
	while ( $linha = mysql_fetch_object($result) )  {
?>  
 <tr>
   <td>
   
   <input name="checkbox" type="checkbox" id="checkbox" />
   </td>	
    <td><?=$linha->restricao?></td>
    <td><?=$linha->impede?></td>
  </tr>

<?
	}
?>
</table>
<p>Excluir selecionados</p>
<table width="65%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="7%"><p>Selecionar</p></td>
    <td width="52%">Restrição</td>
    <td width="35%">Impede ?</td>
  </tr>
  <?
	$sql = "select 
* 
from restricoes
where id not in 
(
  select Id_Restricao from rl_restricao_chamado where Id_Chamado = " . $_GET["id"] . ")";

	
	$result = mysql_query($sql) or die(mysql_error()) ;
	
 
	while ( $linha = mysql_fetch_object($result) )  {
?>
  <tr>
    <td><input name="checkbox2" type="checkbox" id="checkbox2" /></td>
    <td><?=$linha->Ds_Descricao?></td>
    <td><?=$linha->Ic_ImpedeEncerramentoChamado?></td>
  </tr>
  <?
	}
?>
</table>
<p>Opa
</p>
<p>Historico das restrições:</p>
<table width="65%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>Restrição</td>
    <td>Situação</td>
    <td>Data</td>
    <td><p>Quem</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>