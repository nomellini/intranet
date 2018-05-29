<?
	require("scripts/dtmtypes.php");
    require("../scripts/conn.php");			
				
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header(" ../../Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: ../../index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	
	$nomeusuario=peganomeusuario($ok);
	$area = pegaareausuario($ok);


	if (!isset($filtro_tipo)) {
	  $filtro_tipo = 0;
	}  
	  
	if (!isset($filtro_status)) {
	  $filtro_status = -1;
	}    
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/PortalQualidade.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Portal da qualidade</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="attendere.css" rel="stylesheet" type="text/css" />
</head>

<body background="../../imagens/fundo.gif">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="72" background="imagens/portalqualidade.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td height="32" align="left" valign="top"><!-- InstanceBeginEditable name="Central" -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="#CCCCCC"><strong>
          <font color="#003366" size="2">
            Desktop   do Sistema de Gest&atilde;o da Qualidade
          </font>
        </strong></td>
      </tr>
    </table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td colspan="2">
		Usuário:<strong><?=$nomeusuario?> [<?=$area?>]</strong><br />

          Filtros:
		  
            <br />
            &nbsp; Tipo: 
           <a href="?filtro_tipo=0&filtro_status=<?=$filtro_status?>">
            Todos
          </a> :: 
          <a href="?filtro_tipo=<?=constant('TIPO_ITEM_OCORRENCIA')?>&filtro_status=<?=$filtro_status?>">
            Ocorr&ecirc;ncias
          </a> 
          :: 
          <a href="?filtro_tipo=<?=constant('TIPO_ITEM_ACAO_MELHORIA')?>&filtro_status=<?=$filtro_status?>">
            Melhoria
          </a> 
          :: 
          <a href="?filtro_tipo=<?=constant('TIPO_ITEM_ACAO_PREVENTIVA')?>&filtro_status=<?=$filtro_status?>">
            Preventivas
          </a> 
          :: 
          <a href="?filtro_tipo=<?=constant('TIPO_ITEM_NAO_CONFORMIDADE')?>&<?=constant('TIPO_ITEM_NAO_CONFORMIDADE')?>&filtro_status=<?=$filtro_status?>">
            RNC
          </a>
          <br />
  &nbsp; Status: 
  <a href="?filtro_tipo=<?=$filtro_tipo?>&filtro_status=1">Abertos
            </a>
            ::
            <a href="?filtro_tipo=<?=$filtro_tipo?>&filtro_status=0">
              Encerrados
            </a>
            :: 
            <a href="?filtro_tipo=<?=$filtro_tipo?>&filtro_status=-1">
              Todos
            </a> 

          </td>
        </tr>
      <tr valign="top">
        <td width="84%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="100%" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#A8CFEC">
              <tr>
                <td width="5%" align="center" valign="middle">ID</td>
                <td width="3%" align="center" valign="middle"><strong>T</strong></td>
                <td width="2%" align="center" valign="middle"><strong>S</strong></td>
                <td width="9%" align="center"><strong>
                  <font size="1">
                    <a href="#">
                      Aberto em
                    </a>
                    </font>
                </strong></td>
                <td width="10%" align="center"><strong>
                  <font size="1">
                    <a href="#">
                      Prazo
                    </a>
                    </font>
                </strong></td>
                <td width="10%" align="center"><strong>
                  <font size="1">
                    <a href="#">
                      Resp.
                    </a>
                    </font>
                </strong></td>
                <td width="38%"><strong>Descri&ccedil;&atilde;o 
                  resumida</strong></td>
                <td width="12%" align="center"><strong>
                  <font size="1">
                    Cli/Depto
                  </font>
                </strong></td>
                <td width="8%" align="center"><strong>
                  <font size="1">
                    <a href="#">
                      Chamado
                    </a>
                    </font>
                </strong></td>
                <td width="3%" align="center"><img src="imagens/imprimir.jpg" alt="Imp" width="17" height="17" align="absmiddle" /></td>
              </tr>


            </table></td>
            </tr>
		  
		  <?		  
		  $sql = "select \n";
		  $sql .= "  sgq_itens.resumo, sgq_itens.id, \n";
		  $sql .= "  sgq_itens.dataa, sgq_itens.id_tipoitem, sgq_itens.prazo1, \n";
		  $sql .= "  sgq_itens.resp1, sgq_itens.id_status, sgq_itens.resp2,\n";
		  $sql .= "  sgq_itens.prazo2,\n";		  
		  $sql .= "  sgq_tipoitem.icone, sgq_tipoitem.descricao as tipodesc, \n";
		  $sql .= "  sgq_tipoitem.pagina, sgq_tipoitem.etapas, \n";		  
		  $sql .= "  sgq_status.icone as iconestatus, sgq_status.descricao as statusdesc, sgq_status.fl_fechado \n";
		  $sql .= "from \n";
		  $sql .= " sgq_itens ";
		  $sql .= "      inner join sgq_tipoitem on sgq_tipoitem.id = sgq_itens.id_tipoitem \n";
		  $sql .= "      inner join sgq_status on sgq_status.codigo = sgq_itens.id_status \n";		  
		  $sql .= "WHERE \n";
		  $sql .= " (1 = 1) \n";
		  if ($filtro_tipo<>0) {
		    $sql .= " and (id_tipoitem = $filtro_tipo) \n" ;
		  }
		  $sql .= "and (fl_fechado <> $filtro_status) \n";
		  $sql .= " order by id ";
		  
		  //die($sql);
		  
		  $result = mysql_query($sql);
		  while ($linha = mysql_fetch_object($result)) {
		  
		    $prazo = "";
		  
			$corfundo = "#D2EDFF";		  
			$id = $linha->id;
		    $dataa = explode('-', $linha->dataa);
			$dataa = "$dataa[2]/$dataa[1]/$dataa[0]";
			$status = $linha->id_status;
			$id_tipoitem = $linha->id_tipoitem;
			$resumo = $linha->resumo;
			
			$icone = $linha->icone;
			
			$etapa = $status - floor($status/1000)*1000;
			$etapa = $etapa . "/" . $linha->etapas;
			
			if ($id_tipoitem == constant('TIPO_ITEM_ACAO_MELHORIA')) {
			
				if ($status == constant('STATUS_MEL_ABERTO')) {
				  $prazo = $linha->prazo1;
				  $resp = $linha->resp1;
				  $corfundo = "#FCCEBA";
				} else if ($status == constant('STATUS_MEL_AG_ORCAMENTO')) {
				  $prazo = $linha->prazo2;
				  $resp = $linha->resp2;
				  $corfundo = "#FCCEBA";					  
     			  $resumo = "$resumo";
				}
			}
			
						
			if ($resp == $ok) {
			  $resumo = "<b>$resumo</b>";
			  $etapa = "<b>$etapa</b>";
			}			
			
			$vencido = false;
			$hoje = date('Y-m-d');
			if ($hoje >= $prazo) {
			  $vencido = true;
			}
			
			$prazo = explode('-', $prazo);
			$prazo = "$prazo[2]/$prazo[1]/$prazo[0]";
			
			if ($vencido) {
			  $prazo = "<b><font color=\"#FF0000\">$prazo</font></b>";
			}
			
		  ?>
		  
 
		  
		  <tr bgcolor="#FFFFFF">
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="<?=$corfundo?>">
              <tr>
                <td width="5%" align="center" valign="middle"><?=$linha->id?></td>
                <td width="3%" align="center" valign="middle"><img src="imagens/<?=$icone?>" alt="Icone do tipo de item :: <?=$linha->tipodesc?>" width="16" height="16" /></td>
                <td width="2%" align="center" valign="middle"><img src="imagens/<?=$linha->iconestatus?>" alt="Icone do status :: <?=$linha->statusdesc?>" width="16" height="16" /></td>
                <td width="9%" align="center"><?=$dataa?></td>
                <td width="10%" align="center"><?=$prazo?></td>
                <td width="10%" align="center"><?=substr(pegaareausuario($resp),0,6)?>.</td>
                <td width="38%" alt="<?=$linha->tipodesc?>"><a  href="<?=$linha->pagina?>?id=<?=$id?>">				
				[<?=$etapa?>] <?=$resumo?></a>
				</td>
				<td width="12%" align="center"><font size="1">
                  <?=$id_cliente?>
                </font></td>
                <td width="8%" align="center"><font size="1">
				  <?=$id_chamado?>
                </font></td>
                <td width="3%" align="center"><img src="imagens/imprimir.jpg" alt="Imp" width="17" height="17" align="absmiddle" /></td>
              </tr>
            </table></td>
          </tr>
		  <?
		    }
		  ?>
		  
        </table>
          <br />
          <br />
          <br />
          <br />
          <br />
          <a href="AcaoMelhoria/AcaoMelhoria_001.php">TESTE</a></td>
        <td width="16%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
          <tr>
            <td bgcolor="#E2E0ED"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#0066CC">
              <tr>
                <td colspan="2" align="center" valign="middle" bgcolor="#0066FF"><strong>
                  <font color="#FFFFFF">
                    Estat&iacute;sticas da gest&atilde;o
                  </font>
                </strong>                                                                </td>
              </tr>
              <tr>
                <td width="85%" bgcolor="#0099FF"><font color="#FFFFFF" size="-5">
                  N&atilde;o Conformidades 
                </font></td>
                <td width="15%" align="center" valign="middle" bgcolor="#0099FF"><font color="#FFFFFF">
                  x
                </font></td>
              </tr>
              <tr>
                <td bgcolor="#0099FF"><font color="#FFFFFF" size="-5">
                  A&ccedil;&otilde;es Preventivas 
                </font></td>
                <td align="center" valign="middle" bgcolor="#0099FF"><font color="#FFFFFF">
                  y
                </font></td>
              </tr>
              <tr>
                <td bgcolor="#0099FF"><font color="#FFFFFF" size="-5">
                  A&ccedil;&otilde;es Melhoria 
                </font></td>
                <td align="center" valign="middle" bgcolor="#0099FF"><font color="#FFFFFF">
                  z
                </font></td>
              </tr>
              <tr>
                <td bgcolor="#0099FF"><font color="#FFFFFF" size="-5">
                  Meus RNC's 
                </font>                </td>
                <td align="center" valign="middle" bgcolor="#0099FF"><font color="#FFFFFF">
                  e
                </font></td>
              </tr>
            </table><br />
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="16%" align="right" valign="middle"><img src="imagens/prioridadealta.gif" width="16" height="16" align="absmiddle" /></td>
                <td width="84%"><font size="-4">
                  Abrir n&atilde;o conformidade 
                </font></td>
              </tr>
              <tr>
                <td align="right" valign="middle"><img src="imagens/preventiva.jpg" width="17" height="16" /></td>
                <td><font size="-4">
                  Abrir a&ccedil;&atilde;o preventiva 
                </font></td>
              </tr>
              <tr>
                <td align="right" valign="middle"><img src="imagens/ideia.gif" width="16" height="16" /></td>
                <td><font size="-4">
                  <a href="AcaoMelhoria/AcaoMelhoria_000.php?acao=novo">
                    Abrir a&ccedil;&atilde;o melhoria                  </a>
                </font></td>
              </tr>
              <tr>
                <td align="right" valign="middle"><img src="imagens/ocorrencia.jpg" width="19" height="19" /></td>
                <td><font size="-4">
                  Abrir Ocorr&ecirc;ncia 
                </font></td>
              </tr>
              <tr>
                <td align="right" valign="middle">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="middle"><img src="imagens/searchfile.gif" width="16" height="16" align="absmiddle" /> 
                  Abrir Arquivo Morto </td>
                </tr>
              <tr>
                <td colspan="2" align="center" valign="middle"><select name="select" class="bordaTexto">
                  <option>2001</option>
                  <option>2003</option>
                  <option>2004</option>
                </select>                </td>
                </tr>
            </table>            
            <br />
</td>
          </tr>
        </table></td>
      </tr>
    </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="19" align="left" valign="top">
      <br />
      <a href="javascript:history.go(-1);">
        voltar      </a>
      <hr />
	<font color="#999999" size="1">Datamace Inform&aacute;tica 
    2006
    </font></td>
  </tr>
</table>
<blockquote>&nbsp;</blockquote>
</body>
<!-- InstanceEnd --></html>
