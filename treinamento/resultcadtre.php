<?
include_once ('cabeca.inc.php');

 $sSQL = "SELECT  * FROM cadastrotreinamento where id = $id;";
 $result = mysql_query($sSQL);   
    
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $rg = $linha->rg;
	  $nome = $linha->nome;
      $cargo = $linha->cargo;
      $areaatuacao = $linha->areaatuacao;
      $tempoarea = $linha->tempoarea;
      $superiordireto = $linha->superiordireto;
      $cargosuperior = $linha->cargosuperior;
      $hoje = $linha->hoje;
	  $fone = $linha->fone;
      $empnome = $linha->empnome;empnome;
      $emprua = $linha->emprua;
      $empnumero = $linha->empnumero;
      $empbairro = $linha->empbairro;
      $empcep = $linha->empcep;
      $empcidade = $linha->empcidade;
      $empestado = $linha->empestado;
	  $empfone = $linha->empfone;
      $email = $linha->email;
	  $identifica = $linha->identifica; 

      $hoje = substr($hoje,8,2) . '-' . substr($hoje,5,2) . '-' . substr($hoje,0,4);
 
 }
  $sSQL = "SELECT * FROM tre_usuario
              left join instrutor on ins_id = tre_ins_id
			  left join modulos on modulos.id = tre_usuario.modulo
              where rg = '$rg' ;";
 $result = mysql_query($sSQL);   
   
?>
<html>
<!-- DW6 -->
<head>
<title>Datamace Informática</title>
<style type="text/css">
<!--
.style4 {
	font-size: 10pt
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style10 {
	color: #006699
}
.style11 {
	font-weight: bold
}
.style12 {
	font-weight: bold
}
.style19 {
	font-family: Verdana, Arial, Helvetica, sans-serif
}
.style22 {
	color: #FFFFFF;
	font-size: 9px;
	font-weight: bold;
}
.style23 {
	font-size: 9px;
	font-weight: bold;
}
.style25 {
	font-size: 9px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style26 {
	font-size: 9px
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
    <table width="100%" border="0">
        <tr>
            <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
                    <tr>
                        <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style10"><strong>Cadastro do Treinando </strong></span></div>
                            <table width="70%" border="0" align="center" cellpadding="0">
                                <tr>
                                    <td width="100%"><table border="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td width="100%"></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table>
                            <table width="80%" border="0" align="center">
                                <tr bgcolor="#006699">
                                    <td colspan="2" bgcolor="#FFFFFF" scope="col"><span class="style26">Treinado por:</span> <span class="style25"><?echo $identifica?></span></td>
                                </tr>
                                <tr bgcolor="#006699">
                                    <td colspan="2" scope="col"><span class="style22"> Cadastro Pessoal </span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23">RG:</div></td>
                                    <td><span class="style25"><?echo $rg?></span></td>
                                </tr>
                                <tr>
                                    <td width="22%" valign="baseline"><div align="left" class="style23"><strong>Nome:</strong></div></td>
                                    <td width="78%"><span class="style25"><?echo $nome?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>Cargo:</strong></div></td>
                                    <td><span class="style25"><?echo $cargo?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>&Aacute;rea de Atua&ccedil;&atilde;o: </strong></div></td>
                                    <td><span class="style25"><?echo $areaatuacao?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>Tempo na &aacute;rea: </strong></div></td>
                                    <td><span class="style25"><?echo $tempoarea?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>Nome do Superior Direto: </strong></div></td>
                                    <td><span class="style25"><?echo $superiordireto?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>Cargo do seu Superior: </strong></div></td>
                                    <td><span class="style25"><?echo $cargosuperior?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style23">Data do Cadastro: </span></td>
                                    <td><span class="style25"><?echo $hoje?></span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style23">Telefone: </span></td>
                                    <td><span class="style25"><?echo $fone?></span></td>
                                </tr>
                            </table>
                            <table width="80%" border="0" align="center">
                                <tr bgcolor="#006699">
                                    <td colspan="4" scope="col"><div align="left" class="style26"><span class="style19 style1"><strong>Endere&ccedil;o da Empresa</strong></span></div></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="left" class="style23"><strong>Nome da Empresa:</strong></div></td>
                                    <td colspan="3"><span class="style26"><?echo $empnome?></span></td>
                                </tr>
                                <tr>
                                    <td width="22%"><div align="left" class="style23"><strong>Rua:</strong></div></td>
                                    <td width="36%"><span class="style26"><?echo $emprua?></span></td>
                                    <td width="8%"><div align="left" class="style26"><strong><strong>N&uacute;mero:</strong></strong></div></td>
                                    <td width="34%"><span class="style26"><?echo $empnumero?></span></td>
                                </tr>
                                <tr>
                                    <td><div align="left" class="style23"><strong>Bairro:</strong></div></td>
                                    <td><span class="style26"><?echo $empbairro?></span></td>
                                    <td><div align="left" class="style26"><strong><strong>Cep:</strong></strong></div></td>
                                    <td><span class="style26"><?echo $empcep?></span></td>
                                </tr>
                                <tr>
                                    <td><div align="left" class="style23"><strong>Cidade:</strong></div></td>
                                    <td><span class="style26"><?echo $empcidade?></span></td>
                                    <td><div align="left" class="style26"><strong><strong>Estado:</strong></strong></div></td>
                                    <td><span class="style26"><?echo $empestado?></span></td>
                                </tr>
                                <tr>
                                    <td><div align="left" class="style23"><strong>Telefone: </strong></div></td>
                                    <td><span class="style26"><?echo $empfone?></span></td>
                                    <td><div align="left" class="style26"><strong><strong>E-mail:</strong></strong></div></td>
                                    <td><span class="style26"><?echo $email?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="style26"></span></td>
                                    <td><span class="style26"></span></td>
                                    <td><span class="style26"></span></td>
                                    <td><span class="style26"></span></td>
                                </tr>
                            </table>
                            <table width="80%" border="0" align="center">
                                <tr bgcolor="#006699">
                                    <td height="22" colspan="3"><div align="left" class="style19 style1 style26"><strong><strong>Treinamento</strong></strong></div></td>
                                </tr>
                                <tr>
                                    <td width="163"><span class="style23">Data</span></td>
                                    <td width="263" valign="bottom"><span class="style23">Treinamento</span></td>
                                    <td width="326" valign="bottom"><span class="style23">Instrutor</span></td>
                                </tr>
                                <?

 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $rg = $linha->rg;
      $data = $linha->data;
      $modulo = $linha->modulo;
      $descricao = $linha->descricao;

  $data = substr($data,8,2) . '-' . substr($data,5,2) . '-' . substr($data,0,4); 

?>
                                <tr>
                                    <td><span class="style25"><? echo $data ?></span></td>
                                    <td width="263"><span class="style25"><? echo $modulo . '-' . $descricao ?></span></td>
                                    <td><span class="style25"><? echo $linha->ins_nome ?></span></td>
                                </tr>
                                <? } ?>
                            </table>
                            <p>&nbsp;</p></td>
                    </tr>
                </table>
                <br>
                <a href="javascript:history.go(-1)"></a> <br>
                <hr align="center">
                <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p></td>
        </tr>
    </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>