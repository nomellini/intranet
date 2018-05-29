<?
	require("cabeca.php");	
	if ( isset($id_usuario) ) { $ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	

	$qry = "select count(1) as conta from usuario_empresa where id_usuario = $ok";
	$result = mysql_query($qry) or die(mysql_error() . '<br>' . $qry) ;
	$linha = mysql_fetch_object($result); 
	$qtde = $linha->conta;		
	if ($qtde>0) {
		$qry = "select count(1) as conta from usuario_empresa where id_cliente = '$id_cliente'";
		$result = mysql_query($qry) or die(mysql_error() . '<br>' . $qry) ;
		$linha = mysql_fetch_object($result); 		
		if ($qtde==0) {
			die ("sem direito");
		}
	}	

	$id_cliente = str_replace(",", "", $id_cliente);
	$semPontoNemEspaco = str_replace(".", "", $id_cliente);
	$semPontoNemEspaco = str_replace(" ", "", $semPontoNemEspaco);
	
	// Se o resultado for numérico, mantenho o número
	if (is_numeric($semPontoNemEspaco)) {
		$id_cliente = $semPontoNemEspaco;
	}
	
	
    $chamado = intval($id_cliente);
				
	if  ("-$chamado-" == "-$id_cliente-") {		
		if ($chamado != 0) {			
		  header("Location: historicochamado.php?id_chamado=$chamado");	 
		  die("teste");
		}
	}
	
	$id_cliente = eregi_replace("'", "`", $id_cliente);
	

    
	if ( ($fl_posvenda<>0) and ($fl_posvenda<>1)) {
	  $fl_posvenda = 0;
	}
	

    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	
	
	$codigo = strtoupper($id_cliente);
 	$sql = "Select count(1) conta from cliente where senha = '%$codigo%' or id_cliente = '%$codigo%';";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$qtde = $linha->conta;
	

	if (!$id_cliente_exato) {
	  $qtde = conn_ContaQuantidadeClientes($codigo);	 		
	  	  
	  if ($qtde == 0) { 
		  header ("Location: inicio.php?semresultado=1&id_cliente=$codigo");
		  die('a');
	  }
	  
	  if ($qtde > 1) {
		  header ("Location: inicio.php?pesquisa=$codigo&id_cliente=$codigo");
	  } else 
	  {    	
		$id_cliente_exato = conn_GetCodigoClienteExato($codigo);
	  }
	}
	
	if ($id_cliente) {
	    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente_exato));
		$p=$id_cliente;
	} else {
		$p=" ";
	}
	

	
	$bl = 0;
	if (!$inter) {	
	    $bl = $tmp["bloqueio"];
	}
	
	$CadastroCompleto = $tmp["cadastrocompleto"];
	$grau = $tmp["grau"];
	$grau = $grau == "ZZ" ? ""  : "[$grau]";

	$msgbl = "";	
	
	$UsaBanco = ($tmp["usa_banco"] == 1);	
	$msgBanco = "";
	if ($UsaBanco) 
	{
		$msgBanco = "<br /><b>Este cliente utiliza base SQL SERVER</b><br />";
	}
	
	if ($fl_posvenda == 1) {
		$msgbl = "<br><h3>Cliente em pós venda";
		//$bl =1 ;
	}


	
	/*
	  Se o usuário for da administração, eu libero o cliente,
	  mas aviso que o cliente está bloqueado.
	
	if  (!$atendimento)  {
      if ($fl_posvenda==1) {	  
	    $msgbl .= " - pós venda";
	  }
 	  $bl = 0;
	}
	*/
	
	  if ($bl) { 
	    $msgbl .= "<br><font color = #ff0000> bloqueado</font>"; 		
	  }
	
	/*
	   Qualquer alteração aqui deve ser feita em historicochamado.php, pois o código   é o mesmo
	*/	
    $fernando = ($ok == 12);
	$nunes = ($ok==141);
	$helio = ($ok == 3);		
	$EditaChamadoBloqueado = connPodeEditarChamadoBloqueado($ok);		
    if ( $EditaChamadoBloqueado ) {
	  $bl=0;
	}  
	

    $cliente = strtoupper($tmp["cliente"]);
	$senha = $tmp["senha"];
	$id_cliente = $tmp["id_cliente"];
	if ($cliente=="") {
	  header ("Location: inicio.php?pesquisa=$p&id_cliente=$banana");
	}

	$sql = "select fl_posvenda, data_inicioposvenda, Ic_Intersystem, Ic_Datacenter, Ic_SLA, Qt_SLA, Obs, Ic_PosVenda from clienteplus where id_cliente = '$id_cliente'";	

	$result = mysql_query($sql); $linha=mysql_fetch_object($result);
	$fl_posvenda = $linha->fl_posvenda;
	$data = $linha->data_inicioposvenda;
	$data = explode('-', $data);
	$datainicioposvenda = "$data[2]/$data[1]/$data[0]";
	$inter = $linha->Ic_Intersystem == 1;
	$ClienteIntersystem = $linha->Ic_Intersystem ? "<BR/><BR/><FONT COLOR=ff0000>INTERSYSTEM SERVIÇOS</font><BR/>" : "" ;	
	$ClienteDatacenter = '';
	$ClienteDatacenter = $linha->Ic_Datacenter ? "<BR/><B><FONT COLOR=ff0000>---> USA DATACENTER <---</font></b><BR/>" : "" ;
	
	
	$ClienteSLA = '';			
	$Qt_SLA = $linha->Qt_SLA;		
	$Qt_SLA .= nl2br(str_replace(" ", "&nbsp;", $linha->Obs));		
	$ClienteSLA = $linha->Ic_SLA ? "cliente com SLA diferenciado : $Qt_SLA - 348640" : '';
	
	$ClientePosVenda = '';
	$ClientePosVenda = $linha->Ic_PosVenda ? "<BR/><B><FONT COLOR=ff00000>---> ! PÓS VENDA ! <---</font></b><BR/>" : "" ;


   loga_online($ok, $REMOTE_ADDR,  $id_cliente);	
?>
<script src="coolbuttons.js"></script>
<script>

 if ('0' != '<?=$linha->Ic_SLA?>') {   
 	window.alert("SLA Diferenciado ");
 } 

 
  function vai() {

    if ('-<?=$bl?>' == '-1') {
	  window.alert('Consultoria Bloqueada');
	  return;
	}

    if ( !('2' == '<?=$ok?>') && (( '-1' == '-<?=$atendimento?>') && ('<?=$id_cliente?>' != 'DATAMACE') && ('<?=$senha?>' == '00 000') )) {
	  window.alert('Cliente Inativo');
	  return;
	}	
	

	document.form.submit();
  }

  function seleciona() {
    window.name = "pai";
    value = document.form.clientecodigo.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }
  
  
function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  
  
</script>
<html>
<head>
<title>Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<img src="figuras/topo_sad_e_900.jpg" width="900" height="79" >
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)">
        <img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">
        voltar
      </a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true">
        <img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">
        Logout
      </a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/">
        <img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">
        relat&oacute;rios
      </a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle">
      <a href="trocasenha.php">
        Alterar 
        Senha
      </a>
    </td>
    <td width="129" class="coolButton"><a href="inicio.php">
        <img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">
        voltar 
        ao in&iacute;cio
      </a></td>
    <td width="259" class="coolButton"><a href="../inicio.php" target="_blank">Intranet</a></td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center">
  <p align="center">
    <font size="3">
      Usu&aacute;rio
      <font color="#FF0000">
        :
        <b>
          <?=$nomeusuario?>
        </b>
      </font>
      <b>
      </b>
    </font>
  </p>
  <form name="form" method="post" action="chamado.php">
    <div align="left">
      <br>
      <br>
      <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
        <tr>
          <td width="50%">Rela&ccedil;&atilde;o de chamados para<br>
            <b>
              <font size="2">
                <?
				$cliente = "$cliente <br>[$id_cliente]";
				$msg = $cliente;
				$link = "http://192.168.0.14/a/relatorios/relat2.php?id_cliente=$id_cliente";
				if ($bl) { 
					$msg="<b><font color=#ff0000>$cliente</font></b>" ;
				} else {
					$msg = "<a href='$link'>$cliente $grau</a>";
				}
				echo "$msg ($senha) $msgbl  $ClienteIntersystem $ClienteDatacenter $ClienteSLA $ClientePosVenda" ;
			?>
              </font>
            </b>
            <font size="2"> <br>Cadastro DIP 
<?
			  if ($CadastroCompleto==1) {
			    echo "Completo<br>";
			  } else {
			    echo "<font color=\"#ff0000\"><b>Incompleto</b></font>";
			  }
	?>
             <?= $msgBanco?>    
            </font>
			<? if (!$_ReadyOnlyStatus) { ?>
            <input type="button" name="Button" value="Novo chamado" class="unnamed1" onClick="vai()">
            <? } ?>
          </td>
          <td width="50%"><p>Treinamentos cobrados<br>
              <select name="id_produto" class="unnamed1" >
                <option value=0 selected="selected">Selecione uma opção</option>
                <?
			  

			  
	$sistema = pegaSistemas($ok, $id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  $ve = $tmp["versao"];
	  
	  
	  if  ($tmp["32bit"]=="S") 
	    { 
			  echo "<option value=$id>$si</option>";
//		  $si="$si :: Treinamento com custo ";
		} 

	}

  ?>
              </select>
              <br>
              Sistemas:<br>
		  
          <select name="sistema" class="unnamed1" onChange="alteraCombo();"><OPTGROUP LABEL="Sistemas do cliente">				
<?
	$sistema = pegaSistemas($ok, $id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
//	  $ve = $tmp["versao"];
//	  if ($tmp["32bit"]) { $si="$si 32 bit";} 
	  echo "<option value='$id'>$si</option>";
	}
	if (!$qtde) {
      echo "<option value=-1>Sistema não cadastrado:: $ok :: $id_cliente</option>";	  
	}
?>
    </OPTGROUP>

              </select>		  
          <br>
<a href="javascript:selecionapessoa('<?=$id_cliente?>');">Contatos</a> <br>
<input name="emailcontatado" type="text" disabled="disabled" class="unnamed1" id="emailcontatado" size="30" maxlength="200" readonly >
          <input name="pessoacontatada" type="text" disabled="disabled" class="unnamed1" size="30" maxlength="100" readonly>
          </td>
        </tr>
      </table>
      <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
      <input type="hidden" name="id_ligacao" value="<?=$id_ligacao?>">
      <div align="center">
      </div>
    </div>
  </form>
  <p align="left">
    <!-- TABELA -->
    <?
   $chamadosemaberto = pegaChamadoCliente($atendimento, $id_cliente, 2, 0);
   $total_pendentes = count($chamadosemaberto);
?>
  </p>
  <p>
    <b>
      Chamados Pendentes :
      <?=$total_pendentes?>
      <br>
    </b>
  </p>
  Filtrar:<label for="textfield"></label>
  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" />
   <img src="../imagens/novo.gif" width="45" height="15"><br>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center" id="sf">
    <tr bgcolor="#FF0000">
      <td width="9%" align="center"><b>
          <font size="1" color="#FFFFFF">
            Chamado
          </font>
        </b></td>
      <td width="11%"><div align="center">
          <b>
            <font size="1" color="#FFFFFF">
              Data Abert.
            </font>
          </b>
        </div></td>
      <td width="18%" align="center"><b>
          <font color="#FFFFFF" size="1">
            Aberto Por -> Está com
          </font>
        </b></td>
      <td width="10%"><b>
          <font color="#FFFFFF" size="1">
            Prioridade
          </font>
        </b></td>
      <td width="52%"><b>
          <font size="1" color="#FFFFFF">
            Descri&ccedil;&atilde;o
          </font>
        </b></td>
    </tr>
    <? while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }

			   $status = $tmp["status"];
			   $statusStr = ""; 
			   if($status>3) {
			    $statusStr = "<br>".pegaStatus($status);
			   }			   
		   	   $pri = $tmp["prioridade"];			   
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $pri = "<b><font color=$cor>$pri</font></b>";	
			   $id = $tmp["id_cliente"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"];
			   $descricao = $tmp["descricao"];
			   $quem = $tmp["consultor"];
			   $sistema = $tmp["sistema"];
			   
			$destinatario = $tmp["destinatario"];
			   

			  $descricao = str_replace('\r\n', '<br>', $descricao);
			  $descricao = preg_replace('/\s\s+/', ' ', $descricao);
			  $descricao = preg_replace('/\s(\w+:\/\/)(\S+)/', ' <a href="\\1\\2" target="_blank">\\1\\2</a>', $descricao);
			  
			  	$semPontoNemEspaco = str_replace(".", "", $id_cliente);
			   
			?>
    <tr bgcolor="<?=$cor_fundo?>" valign="middle">
      <td width="9%" align="center"><a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>&id_ligacao=<?=$id_ligacao?>">
          <?="$chamado $statusStr"?>
        </a>
      </td>
      <td width="11%" align="center"><?=$dataAbertura?>
      </td>
      <td width="18%" align="center"><?="$quem -> <b>$destinatario</b><br>$sistema<br>"?>
      </td>
      <td width="10%" align="center"><?=$pri?>
      </td>
      <td width="52%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
          <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>&id_ligacao=<?=$id_ligacao?>">
            <?=$descricao?>
          </a>
        </font></td>
    </tr>
    <?}?>
  </table>
  <!-- TABELA -->
  <?
   $chamadosemaberto = pegaChamadoCliente($atendimento, $id_cliente, 1, 250);
   $total_pendentes = count($chamadosemaberto);
?>
  <p>
    <b>
      Chamados Encerrados :
      <?=$total_pendentes?>
    </b>
    <br>
  </p>
    Filtrar:<label for="textfield"></label>
  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf2', 1)" />
  <br>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center" id="sf2">
    <tr bgcolor="#666666">
      <td width="9%" align="center"><font size="1" color="#FFFFFF">
          Chamado
        </font></td>
      <td width="11%"><div align="center">
          <font size="1" color="#FFFFFF">
            Data Abert.
          </font>
        </div></td>
      <td width="18%"><font color="#FFFFFF" size="1">
          Aberto Por
        </font></td>
      <td width="10%"><font color="#FFFFFF" size="1">
          Prioridade
        </font></td>
      <td width="52%"><font size="1" color="#FFFFFF">
          Descri&ccedil;&atilde;o
        </font></td>
    </tr>
    <?
    while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }

		   	   $pri = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $pri = "<b><font color=$cor>$pri</font></b>";	
			   $id = $tmp["id_cliente"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"];
			   $descricao = $tmp["descricao"];
			   $quem = $tmp["consultor"];
			   $sistema = $tmp["sistema"];               
               
              $descricao = str_replace('\r\n', '<br>', $descricao);
               
			?>
    <tr bgcolor="<?=$cor_fundo?>">
      <td width="9%" align="center" valign="middle"><a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>&id_ligacao=<?=$id_ligacao?>">
          <?=$chamado?>
        </a>
      </td>
      <td width="11%" valign="middle" align="center"><?=$dataAbertura?>
      </td>
      <td width="18%" valign="middle" align="center"><?="$quem<br>$sistema"?>
      </td>
      <td width="10%" valign="middle" align="center"><?=$pri?>
      </td>
      <td width="52%" valign="bottom"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
          <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>&id_ligacao=<?=$id_ligacao?>">
            <?=$descricao?>
          </a>
        </font></td>
    </tr>
    <?}?>
  </table>
  <br>
  <table width="132" border="0" cellspacing="1" cellpadding="1" align="center" class="coolBar">
    <tr>
      <td align="center" class="coolButton"><a href="inicio.php">
          <img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">
          voltar 
          ao in&iacute;cio
        </a></td>
    </tr>
  </table>
</div>
</body>
</html>
<script>
function selecionapessoa(AClienteId) {
	window.open('selecionapessoa.php?cliente_id='+AClienteId,'','width=536, height=450');	
}
</script>