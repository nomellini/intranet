<?
include_once ('cabeca.inc.php');

 if ($ordem=="") { $ordem="id";};
 
 if ($cod_perguntas) 
     $sSQL = "SELECT  * FROM sistemas where cod_sistema   like '%$cod_sistema  %' order by $ordem, cod_sistema   ;";
 else
     $sSQL = "SELECT  * FROM sistemas order by $ordem, cod_sistema   ;";

 $result = mysql_query($sSQL);   
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de Provas</title>
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style2 {font-size: 12px}
.style4 {
	color: #FFFFFF;
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style6 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
a:link {
	color: #0000FF;
	text-decoration: none;
}
a:visited {
	color: #0000FF;
	text-decoration: none;
}
a:hover {
	color: #0000FF;
	text-decoration: none;
}
a:active {
	color: #0000FF;
	text-decoration: none;
}
.style9 {color: #000000}
.style10 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" align="center" cellpadding="0">
  <tr>
    <td width="100%"><table width="80%" border="0" align="center" cellpadding="0">
      <tr>
        <td width="100%">

<table border="1" cellpadding="1" width="100%" cellspacing="1">
                <tr bgcolor="#FFFFFF" class="TabelaRotulo">
                  <td width="25%" bgcolor="#006699"><div align="left" class="style1 style2 style10">C&oacute;digo </div></td>
                  <td width="75%" bgcolor="#006699"><div align="left" class="style4">Descri&ccedil;&atilde;o da Prova </div></td>
                </tr>
                <?
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $descricao = $linha->descricao;	
	  $cod_sistema = $linha->cod_sistema;  
         
?>
                <tr>
                  <td width="25%" class="TabelaPadrao"><span class="style6 style9"> <?echo $cod_sistema?> </span></td>
                  <td class="TabelaPadrao"><span class="style6 style9"> <?echo $descricao?> </span></td>
                </tr>
                <?
  };
 ?>
            </table>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<p><a href="javascript:history.go(-1)"></a></p>
</body>
</html>
