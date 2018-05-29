<?
	$dias = array( '', 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado' );
	$sql = "select count(1) qtde from relax";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$total = $linha->qtde;	

	$sql = "SELECT
  DayOfWeek(Data) dia,
  Count(1) qtde,
  (select count(1) from relax r2 where dayofweek(r2.data) = dayofweek(r.data) and hour(r2.hora) < 14) as manha,
  (select count(1) from relax r3 where dayofweek(r3.data) = dayofweek(r.data) and hour(r3.hora) >=14) as tarde
FROM relax r
Group By DayOfWeek(Data);";
	$result = mysql_query($sql);
?>
<table width="430" border="1">
<caption>Dias da semana</caption>
  <tr>
    <td width="33%"><div align="center">Dia da semana </div></td>
    <td width="27%"><div align="center">Percentual</div></td>
    <td width="21%"><div align="center">Manhã</div></td>
    <td width="19%"><div align="center">Tarde</div></td>		
  </tr>
<?	
	while ($linha = mysql_fetch_object($result))
	{
		$TotalDoDia = $linha->qtde;
		$Percentual = ($linha->qtde / $total) * 100;
		$Percentual = number_format($Percentual, 1, ',', '.') . " %";
		$Manha = number_format( 100*($linha->manha/$TotalDoDia), 1, ',', '.') . " %";
		$Tarde = number_format( 100*($linha->tarde/$TotalDoDia), 1, ',', '.') . " %";		
?>
  <tr>
    <td width="33%"><div align="center"><?=$dias[$linha->dia]?></div></td>
    <td width="27%"><div align="center"><?=$Percentual ?></div></td>
    <td width="21%"><div align="center"><?=$Manha ?></div></td>
    <td width="19%"><div align="center"><?=$Tarde ?></div></td>		
  </tr>
<?		
	}	
?>
</table>

<br>


<?
if (($ok == 143) |($ok == 12)) {
	$sql = "select
  u.nome,
  (select count(1) from relax r2 where r2.id_usuario = r.id_usuario and presente = 0) as f,
  (select count(1) from relax r3 where r3.id_usuario = r.id_usuario and presente = 1) as c,
  count(1) as t
from
  relax r
    inner join usuario u on u.id_usuario = r.id_usuario
group by u.nome
order by c desc, nome
limit 10";
	$result = mysql_query($sql) or die (mysql_error());
?>
<table width="427" border="1">
<caption>Top 10 Usuários</caption>
  <tr>
    <td width="45%"><div align="center">Usuário</div></td>
    <td width="20%"><div align="center">Compareceu</div></td>
    <td width="20%"><div align="center">Faltou</div></td>	
    <td width="15%"><div align="center">Total</div></td>		
  </tr>
<?	
	while ($linha = mysql_fetch_object($result))
	{
		//$Percentual = ($linha->qtde / $total) * 100;
		//$Percentual = number_format($Percentual, 2, ',', '.') . "%";
		
?>
  <tr>
    <td width="45%"><div align="center"><?=$linha->nome?></div></td>
    <td width="20%"><div align="center"><?=$linha->c ?></div></td>
    <td width="20%"><div align="center"><?=$linha->f ?></div></td>
    <td width="15%"><div align="center"><?=$linha->t ?></div></td>	
  </tr>
<?		
	}	
}
?>
</table>