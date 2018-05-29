<?
 require("../a/scripts/conn.php");	
 require("../agenda/scripts/Funcoes.php");	
 $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		 
?>
<html>
<head>
<title>Detalhe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
</head>

<body background="figuras/fundo.gif" leftmargin="0" topmargin="0" marginwidth="22" marginheight="0">
<?
  $p = "";
  $sql = "Select * from compromisso where id = " . $id_compromisso;
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);  
  $data = explode("-", $linha->data);  
  /*
  $sql = "Select usuario.nome from usuario, compromissousuario, compromisso where usuario.ativo = 1 and  ";
  $sql .= "compromisso.id = compromissousuario.id_compromisso and compromisso.id = $id_compromisso and usuario.id_usuario = compromissousuario.id_usuario ORDER BY nome;";
  $result = mysql_query($sql);
  while ( $linha2=mysql_fetch_object($result) ) {
    if ($p<>"") { $p .= ", "; }
    $p .= $linha2->nome;
  }
  */
  $p = Funcoes_GetParticipantes($id_compromisso);
  $descricao = $linha->descricao;
  $descricao = eregi_replace("\r\n", "<br>",$descricao);
  $descricao = eregi_replace("\"", "`", $descricao);	  


	$Obs = $linha->obs;
				$Obs = preg_replace('/\s\s+/', ' ', $Obs);					
				$Obs = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historico.php?id_historico=$2$4">Ver detalhes</a>', $Obs);
  
  
  
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%">Detalhe: </td>
    <td width="50%" align="right"><a href="javascript:window.print();">Imprimir</a></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#003366">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td width="16%"><strong><font color="#003366">Data/Hora</font></strong></td>
          <td width="84%"> <font color="#003366"> 
            <?="$data[2]/$data[1]/$data[0]"?>
            &nbsp; 
            <?=substr($linha->hora,0,5)?>
            at&eacute; 
            <?=substr($linha->horafim,0,5)?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Agendado por</font></strong></td>
          <td><font color="#003366"> 
            <?=peganomeusuario($linha->id_usuario)?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Resumo</font></strong></td>
          <td><font color="#003366"> 
            <?=$linha->resumo?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Local</font></strong></td>
          <td><font color="#003366"> 
            <?=$linha->local?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Chamado</font></strong></td>
          <td><font color="#003366"> 
            <?=$linha->chamado?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Descri&ccedil;&atilde;o</font></strong></td>
          <td><font color="#003366"> 
            <?=$descricao?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Participantes</font></strong></td>
          <td> 
            <?=$p?>          </td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF">
          <td>Obs</td>
          <td><?=$Obs?></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
