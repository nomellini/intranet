<?
include_once ('cabeca.inc.php');

 if ($acao == "excluir") {
     $sSQL = "DELETE from eficacia WHERE id = $id;";
      $acao = "foi excluído com sucesso";
     if(!mysql_query($sSQL)) {
	    $acao = "N&Atilde;O foi excluído";
     }
 }else{
 if ($titulo) {
 	$titulo = strtoupper($titulo);
	$entidade = strtoupper($entidade);
	$instrutor = strtoupper($instrutor);
	$avaliador = strtoupper($avaliador);
	
	$area = strtoupper($area);
	$treinando = strtoupper($treinando);
	$aprendizagem = strtoupper($aprendizagem);
	$justaprendizagem = strtoupper($justaprendizagem);
	$aplicabilidade = strtoupper($aplicabilidade);
	$justaplicabilidade = strtoupper($justaplicabilidade);
	$comportamento = strtoupper($comportamento);
	$justcomportamento = strtoupper($justcomportamento);
	$geral = strtoupper($geral);
	$justgeral = strtoupper($justgeral);
	$nomegestor = strtoupper($nomegestor); 
	$data1 = substr($data1,6,4) . '-' . substr($data1,3,2) . '-' . substr($data1,0,2);
	$data2 = substr($data2,6,4) . '-' . substr($data2,3,2) . '-' . substr($data2,0,2);
	$datadevolucao = substr($datadevolucao,6,4) . '-' . substr($datadevolucao,3,2) . '-' . substr($datadevolucao,0,2);
   
 	$sSQL = "update eficacia set titulo='$titulo', entidade ='$entidade', instrutor = '$instrutor', data1 = '$data1', data2 = '$data2', cargahoraria = '$cargahoraria', avaliador = '$avaliador', area = '$area', treinando = '$treinando', registro = '$registro', datadevolucao = '$datadevolucao', aprendizagem = '$aprendizagem', justaprendizagem = '$justaprendizagem', aplicabilidade = '$aplicabilidade', justaplicabilidade = '$justaplicabilidade', comportamento = '$comportamento', justcomportamento = '$justcomportamento', geral = '$geral', justgeral = '$justgeral', nomegestor = '$nomegestor'  where id = $id";
    $acao = "foi alterado com sucesso";
     if(!mysql_query($sSQL)) {
	    $acao = "N&Atilde;O foi alterado";
	 }	
  }
 } 
 

 ?>
<html>
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
      <p><b> <? echo "Avaliação $acao" ?></b> !<br />
            <br />
          <br />
          Clique <a href="/treinamento/vermaneficacia1.php">aqui</a> para 
      voltar<br />
      ou<br />
      Clique <a href="treinamento.php">aqui</a> para ir ao menu principal <br />
      </p>
      </td>
  </tr>
</table>
</body>
</html>