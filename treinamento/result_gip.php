<?
include('cabeca.inc.php');

	$sSQL = "SELECT C.nome as nome, R.*, P.descricao as prova_descricao FROM respostas as R ".
			" left join provas as P on P.id = R.cod_prova ".
			" left join cadastrotreinamento as C on C.rg = R.rg ".
			" where R.id = $id_resp";
	$result	= mysql_query($sSQL);
	if ($linha = mysql_fetch_object($result)){
		$id_resp		= $linha->id;
		$empnome		= $linha->empnome;
		$nome			= $linha->nome;
		$cod_prova		= $linha->cod_prova;
		$dataprova		= $linha->dataprova;
		$dataprova		= substr($dataprova,8,2) . '/' . substr($dataprova,5,2) . '/' . substr($dataprova,0,4); 

		$resp			= explode("#",$linha->resp);
		$tot_resp		= count($resp);
		$cod_perguntas	= explode("#",$linha->perg); // transforma campo string em tabela (array)
		$tot_perguntas	= count($cod_perguntas); // conta quantos registros tem na tabela

		$descr_prova	= $linha->prova_descricao; 
	};
?>
<html>
<!-- DW6 -->
<head>
 
<title>Datamace Informática</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style7 {
	font-size: 12;
	font-weight: bold;
}
.style8 {color: #006699}
.style9 {font-size: 9px}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: normal; font-size: 9px; }
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center"> 
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">
              <div align="center" class="style7 style8">Respostas da Avalia&ccedil;&atilde;o do Treinamento</div>
              <table width="70%" border="0" align="center" cellpadding="0">
                <tr>
                  <td width="100%"><table border="0" cellpadding="0" width="100%">
                    <tr>
                      <td width="100%">
</td>
        </tr>
                  </table></td>
    </tr>
              </table>
              <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
                <tr bgcolor="#FFFFFF">
                  <td width="24%" bordercolor="#C0C0C0"  bgcolor="#006699"><span class="style1 style9"><strong> Nome da empresa:</strong></span></td>
      <td width="76%" bordercolor="#C0C0C0" bgcolor="#006699"><span class="style1 style9"><strong> <?echo $empnome ?></strong></span></td>
    </tr>
                <tr>
                  <td><span class="style9"><strong>Nome do treinando:</strong></span></td>
      <td><span class="style9"><? echo $nome ?></span></td>
    </tr>
                <tr>
                  <td><span class="style9"><strong>Codigo da prova:</strong></span></td>
                  <td><span class="style9"><? echo $cod_prova ?> - <? echo $descr_prova ?></span></td>
                </tr>
                <tr>
                  <td><span class="style9"><strong>Data:</strong></span></td>
      <td><span class="style9"><? echo $dataprova ?></span></td>
    </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="1">
                    <tr bgcolor="#FFFFFF">
                      <td width="67%" bgcolor="#FFFFFF" class="style9">&nbsp;</td>
          <td width="20%" bgcolor="#FFFFFF" class="style9"><span class="style9"><strong>Resposta(s)</strong></span></td>
          <td width="13%" bgcolor="#FFFFFF" class="style9"><div align="left" class="style9"><strong>Correta(s)</strong></div></td>
        </tr>
                    <?
  $total = 0;
  for ($x=0;$x < $tot_perguntas; $x++) {
       $sSQL = "SELECT  id, resp, descricao FROM perguntas where id = $cod_perguntas[$x] ";
       if (!$result = mysql_query($sSQL)) continue;
       if (!$linha = mysql_fetch_object($result)) continue;
	   	   
	   $resp_id        = $linha->id;
	   $resp_descricao = $linha->descricao;
       $resp_padrao    = $linha->resp;
	   if ($resp[$x] == $resp_padrao) $total++;

?>
                    <tr bgcolor="#FFFFFF">
                      <td bgcolor="#FFFFFF" class="style9"><? echo $x+1 ?> - <? echo $resp_descricao ?></td>
          <td bgcolor="#FFFFFF" class="style9"><div align="center" class="style11"><? echo $resp[$x] ?> &nbsp;</div></td>
          <td bgcolor="#FFFFFF" class="style9"><div align="center" class="style11"><? echo $resp_padrao ?></div></td>
        </tr>
       <? } ?>
                    <tr bgcolor="#FFFFFF" class="TabelaRotulo">
                      <td bgcolor="#FFFFFF" class="style9">&nbsp;</td>
          <td bgcolor="#FFFFFF" class="style9">&nbsp;</td>
          <td bgcolor="#FFFFFF" class="style9">&nbsp;</td>
        </tr>
                    <tr bgcolor="#FFFFFF">
                      <td bgcolor="#FFFFFF" class="style9">&nbsp;</td>
          <td bgcolor="#FFFFFF" class="style9">          <div align="left" class="style9"><strong>Total de acertos:</strong></div></td>
          <td bgcolor="#FFFFFF" class="style9"><div align="center" class="style11"><strong><? echo $total ?></strong></div></td>
        </tr>
                  </table></td>
    </tr>
              </table>
              <br>
              <a href="javascript:history.go(-1)"></a>
<p><a href="javascript:history.go(-1)"></a></p>              <p align="center"></p></td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> 
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>
