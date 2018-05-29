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

	if (!isset($acao)) {
	  $acao = "novo";
	}  
  

    function UpdateItem($AInfo) {
		$sql = "update sgq_itens set ";
		$sql .= " id_chamado = " . $AInfo["id_chamado"]. ", ";
		$sql .= " id_status = " . $AInfo["id_status"]. ", ";
		$sql .= " aprovado1 = 0, ";
		$sql .= " id_cliente = " . QuotedStr($AInfo["id_cliente"]) . ", ";	  	  
		$sql .= " resumo = " . QuotedStr($AInfo["resumo"]) . " ";	  
		$sql .= "WHERE ";	 	
		$sql .= "  id = " . $AInfo["id"];
		mysql_query($sql);
		//die($sql);		  
	}
	
    function UpdateAcao($AInfo) {
		UpdateItem($AInfo);	  
		
		$AInfo["id_status"]  = constant('STATUS_MEL_ABERTO');
		
		$sql = "update sgq_itens set ";
		$sql .= " prazo1 = " . QuotedStr($AInfo["prazo_acao"])  . ", ";
		$sql .= " id_status = " . $AInfo["id_status"]  . ",  ";		
		$sql .= " resp1 =" . $AInfo["responsavel_acao"]  . ", ";		
		$sql .= " texto1 = " . QuotedStr($AInfo["descricao_acao"]) . ", ";
		$sql .= " texto2 = " . QuotedStr($AInfo["objetivos"]) . " ";
		$sql .= "WHERE ";	 	
		$sql .= "  id = " . $AInfo["id"];
		//die($sql);
		mysql_query($sql);
	}
	
	function AprovaAcao($AInfo) { 
	
        //UpdateAcao($AInfo);
		
		$data = date('Y-m-d h:i:s');	
		$AInfo["id_status"]  = constant('STATUS_MEL_AG_ORCAMENTO');		  			
		
		$sql = "update sgq_itens set ";
		$sql .= "id_status = " . $AInfo["id_status"]  . ",  ";
		$sql .= "aprovado1 = " . $AInfo["id_usuario"]. " , ";
		$sql .= "dataok1 = '$data' ";
		$sql .= "WHERE ";	 	
		$sql .= "  id = " . $AInfo["id"];
	   // die($sql);
		mysql_query($sql);
	}


	$Info["id_usuario"] = $ok;

	$Info["idItem"] = $id;
	$Info["id"] = $id;
	//$Info["status"] = $id_status;
	$msg = "Editar ação de melhoria";
	$Info["id_cliente"] = $id_cliente;
	$Info["id_chamado"] = $id_chamado;
	$Info["resumo"] = $resumo;
	$Info["id_tipo_item"] = $id_tipoitem;;
	$Info["id_status"] = $id_status;
		
	// Aba ação
	$Info["prazo_acao"] = $prazo1;			
	$Info["descricao_acao"] = $texto1;
	$Info["objetivos"] = $texto2;
	$Info["responsavel_acao"] = $resp1;



	
	if ($acao == "novo") {
	
		$Info["idItem"] = 0;
		$Info["id"] = 0;
		$Info["status"] = "Abertura";
		$msg = "Nova ação de melhoria";
		$Info["id_cliente"] = 0;
		$Info["id_chamado"] = 0;
		$Info["resumo"] = "";
		$Info["id_tipo_item"] = constant('TIPO_ITEM_ACAO_MELHORIA');
		$Info["id_status"] = constant('STATUS_MEL_ABERTO');	
			
		// Aba ação
		$Info["prazo_acao"] = "";			
		$Info["descricao_acao"] = "";
		$Info["objetivos"] = "";
		$Info["responsavel_acao"] = 0;
	
	} 
	
	if ($acao == "editar") {	
		$sql = "select  \n";			
		$sql .= "  sgq_itens.id, sgq_itens.id_usuario, sgq_itens.resumo, \n";
		$sql .= "  sgq_itens.id_chamado, sgq_itens.id_status, sgq_itens.prazo1, \n";			
		$sql .= "  sgq_itens.dataa, sgq_itens.horaa, sgq_itens.texto1, resp1, aprovado1, \n";
		$sql .= "  sgq_itens.texto2, texto3, dataok1, \n";
		$sql .= "  sgq_status.descricao as statusdesc \n";
		$sql .= "from \n";
		$sql .= " sgq_itens \n";
		$sql .= "   inner join sgq_status on sgq_status.codigo = sgq_itens.id_status \n";
		$sql .= "where sgq_itens.id = $id\n";
		
		
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		
		$Info["idItem"] = $id;
		$Info["id"] = $id;
		$Info["status"] = $linha->statusdesc;
		$msg = "Editar ação de melhoria";
		$dataa = explode('-', $linha->dataa);
		$dataa = "$dataa[2]/$dataa[1]/$dataa[0]";
		$horaa = $linha->horaa;	  
		$Info["abertoem"] = "$dataa $horaa";
		$Info["abertopor"] = peganomeusuario($linha->id_usuario);
		$Info["id_cliente"] = 0;
		$Info["id_chamado"] = 0;
		$Info["resumo"] = "$linha->resumo";			
		$Info["id_tipo_item"] = $linha->id_tipoitem;;
		$Info["id_status"] = $linha->id_status;
				
		// Aba ação
		
		$prazo1 = explode('-', $linha->prazo1);
		$Info["prazo_acao"] = "$prazo1[2]/$prazo1[1]/$prazo1[0]";			
		$Info["descricao_acao"] = $linha->texto1;
		$Info["objetivos"] = $linha->texto2;
		
		
		$Info["orcamento_observacao"] = $linha->texto3;
		
		//die($Info["objetivos"]);
		
		$Info["responsavel_acao"] = $linha->resp1;
		$Info["id_usuario_aprova_acao"] = $linha->aprovado1;
		$Info["aprovado_acao"] = "Aprovado por <b>" . peganomeusuario($linha->aprovado1) . " em " . $linha->dataok1 . "	</b>" ;
		$dataaprovado = explode('-', $linha->dataok1);
		$dataaprovado1 = "$dataaprovado1[2]/$dataaprovado1[1]/$dataaprovado1[0]";
		$Info["DataAprovado_acao"] = $dataaprovado;
	}
	
	
	function NovaAcaoMelhoria(
		 $id_chamado, $id_cliente, $id_status, 
		 $ok, $resumo, $id_tipoitem, $texto1, $texto2, $prazo1, $resp1) {
			$dataa = date('Y-m-d');	  
			$horaa = date('h:i:s');	  
	  
			$sql = "INSERT INTO sgq_itens ";
			$sql .= " (id_chamado, id_cliente, id_status, id_usuario, dataa, horaa, ";
			$sql .= "  resumo, id_tipoitem, texto1, texto2, prazo1, resp1, dataok1, idok1) ";
			$sql .= " values ( ";
			$sql .= "$id_chamado, '$id_cliente', $id_status, $ok, '$dataa', '$horaa', ";
			$sql .= "'$resumo', $id_tipoitem, '$texto1', '$texto2', '$prazo1', '$resp1', ";
			$sql .= "'', $ok)";
			mysql_query ($sql);
						
			$sql = "select max(id) as maximoid from sgq_itens where id_usuario = $ok";
			$result = mysql_query($sql);
			$linha = mysql_fetch_object($result);

			return $linha->maximoid;
	}


	if ($acao=="aprovaacao") {	  
	  
		$sql = "select count(id_usuario) as qtde from usuario ";
		$sql .= "where id_usuario = $ok and senha = md5('$senha1')";
		
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		$senhaOk = ($linha->qtde == 1);
	  
	    $msgErro = "";
		if ($senhaOk) {
	
/*			
			if ($Info["id"] == 0) { //Nova ação
				$id =  NovaAcaoMelhoria(
					   $id_chamado, $id_cliente, $id_status, 
					   $ok, $resumo, $id_tipoitem, $texto1, $texto2);
			}
						
*/			

 			$prazo = explode('/', $prazo1);
			$prazo = "$prazo[2]-$prazo[1]-$prazo[0]";
			$Info["id_status"]  = constant('STATUS_MEL_AG_ORCAMENTO');			
			$Info["prazo_acao"] = $prazo;			
			$Info["responsavel_acao"] =  $resp1;
			$Info["id_usuario"] = $ok;
			
			AprovaAcao($Info);
					
			header("location: index.php");
					  
		} else {
			$msgErro = "Senha não confere";
			$Info["id_status"]  = constant('STATUS_MEL_ABERTO');			
			//die($msg);
		}  	  
	}
	
	

	if ($acao=="gravaacao") {
	
	   

		if ($Info["id"] == 0) { //Nova ação
			$idItem = NovaAcaoMelhoria(
				$id_chamado, $id_cliente, $id_status, 
				$ok, $resumo, $id_tipoitem, $texto1, $texto2,
				$prazo1, $resp1
			);
		} else {
		  UpdateAcao($Info);
		}
		
		header("location: index.php");		
	 }
	
	if ($acao == "editar") {
	  $msg = "Editar ação de melhoria";
	}
	
	/* Combo de clientes */
	$sql = "SELECT ";
	$sql .= "  id_cliente, cliente ";
	$sql .= "FROM ";
	$sql .= "  cliente ";
	$sql .= "ORDER BY ";
	$sql .= "  cliente";
	$clientes = "";
	$result = mysql_query($sql);   
	while ( $linha = mysql_fetch_object($result) ) { 
		 if ($id_cliente == $linha->id_cliente) {
			$s = "selected";
		 } else {
			$s = "";
		 }
		 $clientes .= "\n<option value=\"$linha->id_cliente\">$linha->cliente [$linha->id_cliente]</option>";
	}
	$clientes =  "<option value=\"0\" selected=\"selected\">Selecione um cliente</option>\n" . $clientes;

    /* Combo de responsável Ação */
	$sql = "SELECT ";
	$sql .= "  usuario.id_usuario, usuario.nome, area.descricao ";
	$sql .= "FROM ";
	$sql .= "  usuario ";
	$sql .= "  inner join area on area.id = usuario.area ";
	$sql .= "WHERE ativo = 1 and gestor ";		
	$sql .= "ORDER BY ";
	$sql .= "  nome ";

	$usuarios	 = "";
	
    if ( ($Info["responsavel_acao"] == "") or ($Info["responsavel_acao"] == 0) ) {
		 $usuarios = "\n<option value=\"0\" selected >Selecione</option>";	
	}
	$result = mysql_query($sql);   
	while ( $linha = mysql_fetch_object($result) ) { 
		 if ($linha->id_usuario==$Info["responsavel_acao"]) {
			$s = "selected=\"selected\"";
		 } else {
			$s = "";
		 }
		 $usuarios .= "\n<option value=\"$linha->id_usuario\" $s >$linha->nome [$linha->descricao]</option>";
	}
	


	$usuarios_verificacao	 = "";
	
    if ( ($Info["responsavel_verificacao"] == "") or ($Info["responsavel_verificacao"] == 0) ) {
		 $usuarios_verificacao = "\n<option value=\"0\" selected >Selecione</option>";	
	}
	$result = mysql_query($sql);   
	while ( $linha = mysql_fetch_object($result) ) { 
		 if ($linha->id_usuario==$Info["responsavel_verificacao"]) {
			$s = "selected=\"selected\"";
		 } else {
			$s = "";
		 }
		 $usuarios_verificacao .= "\n<option value=\"$linha->id_usuario\" $s >$linha->nome [$linha->descricao]</option>";
	}




	$podeAssinarAcao = false;	
	$PodeGravarAcao = true;
    $disabled = "";
	if ( ($ok == $Info["responsavel_acao"]) ) {
		$disabled = "disabled=\"disabled\"";
		$podeAssinarAcao = true;
	}
    $disabled_verificacao = "";
	if ( ($ok == $Info["responsavel_verificacao"]) ) {
		$disabled_verificacao = "disabled=\"disabled\"";
		$podeAssinarVerificacao = true;
	}
	
	if ($ok == 00) {
		$podeAssinarAcao = true;
		$PodeGravarAcao = true;
		$disabled = "";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/PortalQualidade.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Portal da qualidade</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<link href="attendere.css" rel="stylesheet" type="text/css" />
</head>

<body background="../../imagens/fundo.gif">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="72" background="imagens/portalqualidade.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td height="32" align="left" valign="top"><!-- InstanceBeginEditable name="Central" -->
<form id="form1" name="form1" action="" method="post">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="50%">      Usuário:<strong>
        <?=$nomeusuario?>
        </strong>        </td>
        <td width="50%">&nbsp;</td>
      </tr>
    </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000099">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="Subitem">
          <tr>
            <td colspan="4" align="center" valign="middle"><font size="2">
              <strong>
              <?=$msg?>
              </strong>
            </font></td>
            </tr>
          <tr>
            <td width="7%">ID</td>
            <td width="60%"><strong>
              <?=$Info["id"]?>
            </strong></td>
            <td width="8%">STATUS</td>
            <td width="25%"><strong><?=$Info["status"]?></strong></td>
          </tr>
          <tr>
            <td>Aberto em </td>
            <td><strong><?=$Info["abertoem"]?></strong>, por <strong>
                <?=$Info["abertopor"]?>
                </strong>            </td>
            <td>Chamado</td>
            <td><input name="id_chamado" type="text" class="borda_fina" id="id_chamado" value="<?=$Info["id_chamado"]?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td>Cliente</td>
            <td><select name="id_cliente" class="borda_fina" id="id_cliente">
               
                <?=$clientes?>
              </select>            </td>
            <td>Auditoria</td>
            <td><input name="auditoria" type="text" class="borda_fina" id="auditoria" value="<?=$Info["auditoria"]?>" /></td>
          </tr>
          <tr>
            <td>Resumo</td>
            <td colspan="3"><input name="resumo" type="text" class="borda_fina" id="resumo" value="<?=$Info["resumo"]?>" size="100" maxlength="150" /></td>
          </tr>
        </table></td>
      </tr>
    </table>
	<br />

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td width="16%" height="80"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td bgcolor="#FFFFFF"><p>
Status:<strong>
          <br />
          <?=$Info["status"]?>
          </strong><br />
        </p>
          </td>
      </tr>
    </table></td>
    <td width="84%"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="abas">
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center"><a href="javascript:aba(1)">
          A&ccedil;&atilde;o
        </a></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">
		<?
		  $Info["aux"] = $Info["id_status"];
		  $Info["id_status"] = 9999;
		  if ($Info["id_status"] >= constant('STATUS_MEL_AG_ORCAMENTO')) {
		?>
		<a href="javascript:aba(2)">
		<?
		  }
		?>		
          Or&ccedil;amento
		<?
		  if ($Info["id_status"] >= constant('STATUS_MEL_AG_ORCAMENTO')) {
		?>
		</a>
		<?
		  }
		?>
        </a>		</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">
		
		<?
		  if ($Info["id_status"] >= constant('STATUS_MEL_EM_ANDAMENTO')) {
		?>
		<a href="javascript:aba(3)">
		<?
		  }
		?>		
          Execu&ccedil;&atilde;o
		
		<?
		  if ($Info["id_status"] >= constant('STATUS_MEL_EM_ANDAMENTO')) {
		?>
		</a>
		<?
		  }
		?>        </td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">
		
		<?
	    if ($Info["id_status"] >= constant('STATUS_MEL_AG_VERIFICACAO')) {
		?>
		<a href="javascript:aba(4)">
		<?
		  }
		?>			
          Verifica&ccedil;&atilde;o de efic&aacute;cia
		<?
		  if ($Info["id_status"] >= constant('STATUS_MEL_AG_VERIFICACAO')) {
		?>
		</a>
		<?
		  }
		  
		?>		</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">
		
		
		<?
		  if ($Info["id_status"]>= constant('STATUS_MEL_AG_ENCERRAMENTO')) {
		?>
		<a href="javascript:aba(5)">
		<?
		  }
		?>			
          Encerramento
		<?
		  if ($Info["id_status"] >= constant('STATUS_MEL_AG_ENCERRAMENTO')) {
		?>
		</a>
		<?
		  }
			$Info["id_status"] = $Info["aux"];
		?>		</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><a href="javascript:aba(6);">
          Fluxo
        </a></td>
        <td align="center">&nbsp;</td>
      </tr>
    </table>
	<span id="aba1">
	
	<table width="100%" border="0" cellpadding="1" cellspacing="1" class="CorBordaTabela">
      <tr class="CorFundoTabela">
        <td><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="Subitem">
          <tr>
            <td class="TituloSubitem"><p>
              DESCRI&Ccedil;&Atilde;O DA A&Ccedil;&Atilde;O
            </p>            </td>
            <td align="right" class="TituloSubitem"><?=$Info["aprovado_acao"]?></td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="texto1" cols="100" rows="5" class="bordaTexto" id="texto1"><?=$Info["descricao_acao"]?>
</textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="TituloSubitem">OBJETIVOS</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="texto2" cols="100" rows="5" class="bordaTexto" id="texto2"><?=$Info["objetivos"]?></textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="TituloSubitem">APROVA&Ccedil;&Atilde;O</td>
            </tr>
          <tr>
            <td width="23%">Prazo</td>
            <td width="77%"><input name="prazo1" type="text" class="bordaTexto" id="prazo1" value="<?=$Info["prazo_acao"]?>" size="15" maxlength="12" <?=$disabled?> /></td>
          </tr>
          <tr>
            <td>Respons&aacute;vel</td>
            <td>
<select name="resp1" class="bordaTexto" id="resp1" <?=$disabled?> >
<?=$usuarios?>
</select>             </td>
          </tr>
<?
  if ( $podeAssinarAcao  ) {
  
	

?>
          <tr>
            <td>Aprovado* <font color="#FF0000">
              <strong><?=$msgErro?></strong>
            </font><br /></td>
            <td><input name="senha1" type="password" class="bordaTexto" id="senha1" />
              <input name="Button" type="button" onclick="vai('acaosenha')" value="Aprovado" /> 
              * Para aprovar, digite sua senha e clique no bot&atilde;o</td>
            </tr>
	
<?
    } 
	
	if ( $PodeGravarAcao )  {
?>
          <tr>
		  
            <td>&nbsp;</td>
            <td><input type="button" onclick="vai('gravaracao')" name="Submit2" value="Gravar" /></td>
          </tr>
		  <?}?>
        </table></td>
      </tr>
    </table>
	</span>
	<span id="aba2">
      <table width="100%" border="0" cellpadding="1" cellspacing="1" class="CorBordaTabela">
        <tr class="CorFundoTabela">
          <td><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="Subitem">
              <tr>
                <td width="23%" class="TituloSubitem"><p>
                  VALOR
                </p>                </td>
                <td width="77%" align="right" class="TituloSubitem"><?=$Info["aprovado_acao"]?></td>
              </tr>
              <tr>
                <td colspan="2"><p>
                  <input name="VALOR" type="text" class="bordaTexto" id="VALOR" />                
                  </p>                  </td>
              </tr>
              <tr>
                <td colspan="2" class="TituloSubitem">OBSERVA&Ccedil;&Otilde;ES</td>
              </tr>
              <tr>
                <td colspan="2"><textarea name="texto3" cols="100" rows="5" class="bordaTexto" id="textarea2"><?=$Info["orcamento_observacao"]?>
            </textarea></td>
              </tr>
              <tr>
                <td colspan="2" class="TituloSubitem">APROVA&Ccedil;&Atilde;O</td>
              </tr>

              <tr>
                <td>Tipo aprova&ccedil;&atilde;o </td>
                <td><select name="select" class="bordaTexto" id="select"  >
                  <option value="0" selected="selected">Selecione</option>
                  <option value="1">N&atilde;o aprovado</option>
                  <option value="2">Aprovado</option>
                  <option value="3">N&atilde;o h&aacute; necessidade</option>

                  </select>                </td>
              </tr>
              <?
  if ( $podeAssinarAcao  ) {
  
	

?>
              <tr>
                <td>Aprovado*
                  <font color="#FF0000">
                      <strong>
                        <?=$msgErro?>
                        </strong>
                    </font>
                  <br /></td>
                <td><input name="senha2" type="password" class="botao_fino" id="senha2" />
                    <input name="Button2" type="button" onclick="vai('orcamentosenha')" value="Aprovado" />
                  * Para aprovar, digite sua senha e clique no bot&atilde;o</td>
              </tr>
              <?
    } 
	
	if ( $PodeGravarAcao )  {
?>
              <tr>
                <td>&nbsp;</td>
                <td><input type="button" onclick="vai('gravaracao')" name="Submit22" value="Gravar" /></td>
              </tr>
              <?}?>
            </table>
           </td>
        </tr>
      </table>
	  </span>
      
	  <span id="aba3">
	  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="CorBordaTabela">
        <tr class="CorFundoTabela">
          <td>
            <table width="100%" border="0" cellpadding="2" cellspacing="2" class="Subitem">

              <tr>
                <td colspan="2" class="TituloSubitem">OBSERVA&Ccedil;&Otilde;ES</td>
              </tr>
              <tr>
                <td colspan="2"><textarea name="texto4" cols="100" rows="5" class="bordaTexto" id="texto4"><?=$Info["execucao_observacao"]?>
            </textarea></td>
              </tr>
              <tr>
                <td colspan="2" class="TituloSubitem">APROVA&Ccedil;&Atilde;O</td>
              </tr>

              <?
  if ( $podeAssinarAcao  ) {
  
	

?>
              <tr>
                <td width="23%">Aprovado*
                  <font color="#FF0000">
                      <strong>
                      <?=$msgErro?>
                      </strong>
                    </font>
                    <br /></td>
                <td width="77%"><input name="senha3" type="password" class="botao_fino" id="senha3" />
                    <input name="Button22" type="button" onclick="vai('orcamentosenha')" value="Aprovado" />
                  * Para aprovar, digite sua senha e clique no bot&atilde;o</td>
              </tr>
              <?
    } 
	
	if ( $PodeGravarAcao )  {
?>
              <tr>
                <td>&nbsp;</td>
                <td><input type="button" onclick="vai('gravaracao')" name="Submit222" value="Gravar" /></td>
              </tr>
              <?}?>
            </table></td>
        </tr>
      </table>
	  </span>
	  
	  <span id="aba4">
      <table width="100%" border="1" cellspacing="1" cellpadding="1">
        <tr>
          <td><table width="100%" border="0" cellpadding="2" cellspacing="2" class="Subitem">
              <tr>
                <td colspan="2" class="TituloSubitem">VERIFICA&Ccedil;&Atilde;O DE EFIC&Aacute;CIA </td>
              </tr>
              <tr>
                <td colspan="2"><textarea name="texto5" cols="100" rows="5" class="bordaTexto" id="texto5"><?=$Info["execucao_observacao"]?>
            </textarea></td>
              </tr>
              <tr>
                <td colspan="2" class="TituloSubitem">APROVA&Ccedil;&Atilde;O</td>
              </tr>
              <?
  if ( $podeAssinarAcao  ) {
  
	

?>

              <?
    } 
	
	if ( $PodeGravarAcao )  {
?>

              <tr>
                <td width="16%">Prazo</td>
                <td width="84%"><input name="prazo2" type="text" class="bordaTexto" id="prazo2" value="<?=$Info["prazo_verificacao"]?>" size="15" maxlength="12" <?=$disabled_verificacao?> /></td>
              </tr>
              <tr>
                <td>Respons&aacute;vel</td>
                <td><select name="resp1" class="bordaTexto" id="resp1" <?=$disabled_verificacao?> >
                    <?=$usuarios_verificacao?>
                  </select>
                </td>
              </tr>
			  
              <tr>
                <td>Aprovado</td>
                <td><input name="senha1" type="password" class="bordaTexto" id="senha1" />
                    <input name="Button" type="button" onclick="vai('acaosenha')" value="Aprovado" />
                  * Para aprovar, digite sua senha e clique no bot&atilde;o</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="button" onclick="vai('gravaracao')" name="Submit2" value="Gravar" /></td>
              </tr>
              <?}?>
            </table></td>
        </tr>
      </table>
	  </span>
	  
	  <span id="aba5">
      <table width="100%" border="1" cellspacing="1" cellpadding="1">
        <tr>
          <td>Campos Referente a Encerramento </td>
        </tr>
      </table>
	  </span>
	  </td>
  </tr>
</table>
<input name="id_tipoitem" type="hidden" id="id_tipoitem" value="<?=$Info["id_tipo_item"]?>" />
<input name="acao" type="hidden" id="acao" value="nada" />
<input name="id" type="hidden" id="id" value="<?=$Info["idItem"]?>" />
<input name="id_status" type="hidden" id="id_status" value="<?=$Info["id_status"]?>" />

<?
	if ($disabled) {
?>
<input name="prazo1" type="hidden" id="prazo1" value="<?=$Info["prazo_acao"]?>" />
<input name="resp1" type="hidden" id="resp1" value="<?=$Info["responsavel_acao"]?>" />
<?
	}
?>
</form>
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
<script>

function ativaAba( tab, x ) {

  var tabela = tab;
  var posE, posD, porC, ancora, final
  final = Math.ceil((( 1 + tabela.rows[0].cells.length ) / 3 ));
     
  for ( var i = 1; i < final ; i++ ) {
  
    posE = (i-1) * 3;
	posD = posE + 2;
	posC = posE + 1;		
			
	tabela.rows[0].cells[posD].style.width = "10";
	tabela.rows[0].cells[posE].style.width = "12";		
	
	var ok = false;
	for (var j=0; j<tabela.rows[0].cells[posC].all.length; j++) {
     if (tabela.rows[0].cells[posC].all(j).tagName == 'A') {
	   ancora = tabela.rows[0].cells[posC].all(j)     ;
	   ancora.style.fontSize=12;
	   ok = true;
	 }
    }
	
	
	if ( x == i ) {  // Ativo		
    	if (ok) {
         ancora.style.color = "#CCCCCC";	
		 ancora.style.textDecoration = 'none';		
		}
		if (i!=1) { 
    		tabela.rows[0].cells[posE].innerHTML = "<img src=\"figuras/ativo_esq1.gif\">";
		} else {
       		tabela.rows[0].cells[posE].innerHTML = "<img src=\"figuras/ativo_esq.gif\">";
		}		
		
		if (i==(final-1)) {		
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/ativo_dir1.gif\">";
		} else {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/ativo_dir.gif\">";
		}

	    	
    	tabela.rows[0].cells[posE].style.backgroundColor = '#225398';
        tabela.rows[0].cells[posC].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
    } else { // Inativo	
	  if (ok) {
        ancora.style.color = "#0000FF";	
		ancora.style.textDecoration = 'none';
	  }
	    if ( i==1) {
          tabela.rows[0].cells[posE].innerHTML = '<img src=\"figuras/ativo_esq.gif\">';
		} else {
		  tabela.rows[0].cells[posE].innerHTML = '<img src=\"figuras/inativo_esq.gif\">';
		}
		
		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/inativo_dir1.gif\">";   		
		} else {
          tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/inativo_dir.gif\">";		
		}

		tabela.rows[0].cells[posC].style.backgroundColor = "#e1e1e1"
        tabela.rows[0].cells[posE].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;				
	}		
  }  
}  

function ativa(value) {
  var a;
  for (a=1; a<tabs.length; a++) {
    if (a==value) {
      tabs[a].style.display='';
    } else {
      tabs[a].style.display='none';
    }
  }
}

function aba(x) {
   ativa(x);
   ativaAba( abas, x);
 }

  
 function envia() {
 }


function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}  

var tabs = new Array;  
tabs[1] = aba1;
tabs[2] = aba2;  
tabs[3] = aba3;  
tabs[4] = aba4; 
tabs[5] = aba5;     


aba(<?=($Info["id_status"]) - 2000?>);

function alterna(obj, nome) {
  
}

function vai(aSetor) {

  if ( (document.form1.resumo.value==0) ) {
	window.alert('Resumo obrigatório');
	document.form1.resumo.focus();
	return false;
  }


  if (aSetor=='acaosenha') {
  
    if ( (document.form1.texto1.value==0) ) {
	  window.alert('Descrição da ação de melhoria obrigatório');
	  document.form1.texto1.focus();
	  return false;
	}  
  
    if ( (document.form1.resp1.value==0) || (document.form1.prazo1.value=='')) {
	  window.alert('Para aprovar a ação, o prazo e responsável devem ser preenchido');
	  document.form1.prazo1.focus();
	  return false;
	}
	document.form1.id_status.value = '<?=constant('STATUS_MEL_AG_ORCAMENTO')?>';
	document.form1.acao.value = "aprovaacao";
    document.form1.submit();
  }  
  if (aSetor=='gravaracao') {

    if ( (document.form1.texto1.value==0) ) {
	  window.alert('Descrição da ação de melhoria obrigatório');
	  document.form1.texto1.focus();
	  return false;
	}

	document.form1.acao.value = "gravaacao";
    document.form1.submit();
  }
}
</script>
