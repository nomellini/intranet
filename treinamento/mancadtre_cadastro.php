<?
include_once ('cabeca.inc.php');

if ($acao == "excluir") {

	mysql_query("DELETE from cadastrotreinamento WHERE rg = $rg");
	mysql_query("DELETE from tre_usuario WHERE rg = $rg");

} else {

	$nome			= strtoupper($nome); 
	$cargo			= strtoupper($cargo); 
	$areaatuacao	= strtoupper($areaatuacao); 
	$tempoarea		= strtoupper($tempoarea); 
	$superiordireto	= strtoupper($superiordireto); 
	$cargosuperior	= strtoupper($cargosuperior); 
	$empnome		= strtoupper($empnome); 
	$emprua			= strtoupper($emprua); 
	$empbairro		= strtoupper($empbairro); 
	$empcidade		= strtoupper($empcidade); 

	$SQLrg = "select rg from cadastrotreinamento where rg = '$rg'";
	$retorno = mysql_query($SQLrg);
	if (mysql_num_rows($retorno) == 0){
		mysql_query("INSERT into cadastrotreinamento (rg, nome, cargo , areaatuacao, tempoarea, superiordireto, cargosuperior, hoje, empnome, emprua, empnumero, empbairro, empcep, empcidade, empestado, empfone, email) VALUES ('$rg', '$nome','$cargo', '$areaatuacao', '$tempoarea', '$superiordireto', '$cargosuperior', '$hoje', '$empnome', '$emprua', '$empnumero', '$empbairro', '$empcep', '$empcidade', '$empestado', '$empfone', '$email');");
	} else {
   		mysql_query("UPDATE cadastrotreinamento set rg='$rg', nome='$nome', cargo='$cargo', areaatuacao='$areaatuacao', tempoarea='$tempoarea', superiordireto='$superiordireto', cargosuperior='$cargosuperior', empnome='$empnome', emprua='$emprua', empnumero='$empnumero', empbairro='$empbairro', empcep='$empcep', empcidade='$empcidade', empestado='$empestado', empfone='$empfone', email='$email' where rg = $rg");
	}

	$retorno = mysql_query($SQLrg);
	if (mysql_num_rows($retorno) != 0){
	
		for ($x=0; $x<count($data); $x++ ){
			$data[$x] = substr($data[$x],6,4) . '-' . substr($data[$x],3,2) . '-' . substr($data[$x],0,2);
			$result = mysql_query("UPDATE tre_usuario set data='$data[$x]', modulo='$modulo[$x]', descricao='$descricao[$x]', completo='$completo[$x]', instrutor='$instrutor[$x]' where id = '$id_tre[$x]'");  
		}

		mysql_select_db('sad');
		for ($x=0; $x<count($data); $x++){
			$cargo = strtoupper($cargo); 
			$empnome = strtoupper($empnome); 
			
			$result = mysql_query("select id_treinamento from treinados where id_treinamento = '$id_tre[$x]'");
			if(mysql_num_rows($result) == 0){
//			echo 'rg: ' . $rg . ' dat: '.$data1 . ' m: ' . $modulo[$x] . ' desc: ' . $descricao[$x] . ' comp: ' . $completo[$x] . ' inst: ' . $instrutor[$x].'<br>';
				mysql_query("INSERT into treinados (cliente , email, sistema , nome , cargo , conceito , data , rg, id_treinamento) VALUES ('$cliente', '$email','$modulo', '$nome', '$cargo', '$conceito', '$data', '$rg', $id_tre[$x])");
			}else{
				mysql_query("UPDATE treinados set cliente = '$empnome', sistema = '$modulo[$x]', nome = '$nome', cargo = '$cargo', conceito = '$conceito[$x]', data = '$data[$x]', rg = '$rg', email = '$email' where id_treinamento = '$id_tre[$x]'");
			}
		}	
		mysql_select_db('treinamento');
	}
}

	
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datamace Inform&aacute;tica Ltda.</title>
</head>

<body>
<table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
  <tr>
    <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><p>

    </p>
      <p></p>
      <p>&nbsp;</p>
      <p><b> <? echo "$nome foi $acao" ?></b> com sucesso !<br />
            <br />
          <br />
          Clique <a href="/treinamento/vermancadtre.php">aqui</a> para 
      voltar<br />
      ou<br />
      Clique <a href="treinamento.php">aqui</a> para ir ao menu principal <br />
      </p>
      </td>
  </tr>
</table>
</body>
</html>