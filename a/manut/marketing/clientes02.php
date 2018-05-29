<?
	require("../../scripts/conn.php");	
	require("../../scripts/connm.php");		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
  


    $sql = "SELECT * from clienteplus WHERE id_cliente = '$id_cliente';";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
    $quando = explode("-", $linha->previsao);
    $dataa = "$quando[2]/$quando[1]/$quando[0]";		  
	$cliente = $linha->cliente;
	$atendimento = "Não" ;
	if ($linha->atendimento) {
      $atendimento = "Sim" ;
	}
?>
<html>
<head>
<script src="../../coolbuttons.js"></script>
<script>
  function abre(value) {
    window.open('detalhes.php?id_pessoa=' + value ,'','width=440,height=300,top=100,left=100,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,maximized=no,minimized=no');
  }	
</script>
<link rel="stylesheet" href="../../stilos.css" type="text/css">
<title>Detalhes</title>
<body bgcolor="#FFFFFF" text="#000000">
<table width="50%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/manut/marketing.php"><img src="../../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ manuten&ccedil;&atilde;o</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> 
<?echo "Olá, $nomeusuario, hoje é ";?>
</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
<script language="JavaScript">

function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('../selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }

function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}

      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "segunda-feira";
      diasemana[2] = "terça-feira";
      diasemana[3] = "quarta-feira";
      diasemana[4] = "quinta-feira";
      diasemana[5] = "sexta-feira";
      diasemana[6] = "sábado";
      diasemana[7] = "domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   

     document.write (diasemana[diaindex] + ' ' +  dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
</font></font><br>
<img src="../../figuras/intro.gif" width="321" height="21"> <br>
<br>
<b><font color="#0000FF"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<?="$linha->cliente   [ $id_cliente ]  - Senha: $linha->senha"?>
</font></b><b><font color="#0000FF"><br>
[<a href="alteradados.php?id_cliente=<?=rawurlencode($id_cliente)?>">alterar 
      dados do cliente</a>]<br>
</font></b> <br>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr> 
    <td width="52%" valign="top"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#CCCCCC">
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="<?=($linha->bloqueio ? "#FFECEC" : "#E8ECFF") ?>">Bloqueado 
            ? </td>
          <td width="58%" bgcolor="<?=($linha->bloqueio ? "#FFECEC" : "#E8ECFF") ?>"> 
            <?=($linha->bloqueio ? "Sim" : "Não") ?>
          </td>
        </tr>
        <tr valign="top">
          <td align="right" bgcolor="#FCE9BC">INTERSYSTEM ? </td>
          <td bgcolor="#FCE9BC"><?=($linha->Ic_Intersystem ? "Sim" : "Não") ?></td>
        </tr>
        <tr valign="top">
          <td align="right" bgcolor="#FCE9BC">SLA ?</td>
          <td bgcolor="#FCE9BC"><?=($linha->Ic_SLA ? "Sim" : "N&atilde;o") ?></td>
        </tr>
        <tr valign="top">
          <td align="right" bgcolor="#FCE9BC">Tempo SLA: </td>
          <td bgcolor="#FCE9BC">&nbsp;<?=$linha->Qt_SLA?></td>
        </tr>
        <tr valign="top">
          <td align="right" bgcolor="#FCE9BC">Pós Venda ?</td>
          <td bgcolor="#FCE9BC"><?=($linha->Ic_PosVenda ? "Sim" : "N&atilde;o") ?></td>
        </tr>
        <tr valign="top">
          <td align="right" bgcolor="#FCE9BC">DATACENTER </td>
          <td bgcolor="#FCE9BC"><?=($linha->Ic_Datacenter ? "Sim" : "N&atilde;o") ?></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Ramo 
            de Atividade : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=pegaRamo($linha->ramo_id)?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Email 
            oficial : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->email?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Site 
            : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->site?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Como 
            ficou sabendo : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=pegaOnde($linha->onde_id)?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">&nbsp;</td>
          <td width="58%" bgcolor="#FCE9BC"><font color="#0000FF"></font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Endere&ccedil;o 
            : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font color="#0000FF"> 
            <?=$linha->endereco?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Bairro 
            : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->bairro?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC"><font size="1">Cidade 
            : </font></td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->cidade?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Uf : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->uf?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">CEP : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->cep?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Telefone : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->telefone?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Fax : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->fax?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">CNPJ : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->cnpj?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">INSC : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->insc?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC" height="14">Funcion&aacute;rios 
            : </td>
          <td width="58%" bgcolor="#FCE9BC" height="14"><font size="1" color="#0000FF"> 
            <?=$linha->funcionarios?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">Sistema de Atendimento : </td>
          <td width="58%"><font size="1" color="#0000FF"> 
            <?=$atendimento?>
            </font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">&nbsp;&nbsp;</td>
          <td width="58%"><font color="#0000FF"></font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">GIP : </td>
          <td width="58%"> <font color="#0000FF"><b> 
            <?=$linha->gip?>
            </b> Funcion&aacute;rios</font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">Financial Contabil : </td>
          <td width="58%"><font color="#0000FF"><b> 
            <?=$linha->contabil?>
            </b> Lan&ccedil;amentos</font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">Financial Ativo : </td>
          <td width="58%"><font color="#0000FF"><b> 
            <?=$linha->ativo?>
            </b>Itens</font></td>
        </tr>
        <tr valign="top" bgcolor="#FCE9BC"> 
          <td width="42%" align="right">[<a href="javascript:mostra(mais);"><span id=texto>Mostra</span></a>]</td>
          <td width="58%">&nbsp;</td>
        </tr>
      </table>
      <span id=mais style="DISPLAY: none"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#CCCCCC" >
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Quantas pessoas no DP 
            : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->pessoasnodp?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Folha Anterior e quanto 
            tempo utiliza : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->folhaanterior?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Previs&atilde;o de implanta&ccedil;&atilde;o 
            do sistema de folha datamace : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$dataa?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Convers&atilde;o de 
            dados ? : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->conversao?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Servi&ccedil;os Intersystem 
            ? : </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->intersystem?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Rede + Sistema Oper.: 
          </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->rede?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Banco de dados: </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->banco?>
            </font></td>
        </tr>
        <tr valign="top"> 
          <td width="42%" align="right" bgcolor="#FCE9BC">Obs: </td>
          <td width="58%" bgcolor="#FCE9BC"><font size="1" color="#0000FF"> 
            <?=$linha->obs?>
            </font></td>
        </tr>
      </table>
      </span></td>
    <td width="48%" valign="top"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
        <tr bgcolor="#333333"> 
          <td width="52%"><b><font color="#FFFFFF">Sistema</font></b></td>
          <td width="26%"><b><font color="#FFFFFF">vers&atilde;o</font></b></td>
          <td width="22%"><font color="#FFFFFF"><b>Estado</b></font></td>
        </tr>
        <?
          $sql1 = "select clisis.ativo, clisis.sistema as sis, sistema.sistema, clisis.versao,clisis.32bit as bit from clienteplus, sistema, clisis where sistema.id_sistema = clisis.sistema and clienteplus.id_cliente = clisis.cliente and clisis.cliente = '$id_cliente';";				  
		  $result = mysql_query($sql1);
		  while ($linha = mysql_fetch_object($result)) {  
		    
			$msg = "";			
			if( $linha->bit ) {
			  $msg = " 32 bits";
			}
      ?>
        <tr bgcolor="<?=( !$linha->ativo ? "#FFECEC" : "#E8ECFF") ?>"> 
          <td width="52%"> 
            <?="$linha->sistema $msg"?>
          </td>
          <td width="26%"> 
            <?=$linha->versao?>
          </td>
          <td width="22%"> <a href="alteraestado.php?id_cliente=<?=rawurlencode($id_cliente)?>&id_sistema=<?=$linha->sis?>">
            <?=( $linha->ativo ? "Ativo" : "Inativo") ?>
            </a> </td>
        </tr>
        <?}?>
      </table>
      [<a href="alterasistemas.php?id_cliente=<?=rawurlencode($id_cliente)?>">alterar sistemas</a>]<br>
      <?
    $sql = "SELECT * from pessoa WHERE cliente_id = '$id_cliente' order by nome;";
//	print $sql;
	$result = mysql_query($sql);
?>
      <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
        <tr bgcolor="#666666"> 
          <td width="35%"><b><font size="1" color="#FFFFFF">Nome</font></b></td>
          <td width="36%"><b><font size="1" color="#FFFFFF">Cargo</font></b></td>
          <td width="23%"><b><font color="#FFFFFF">Telefone</font></b></td>
          <td width="6%">M</td>
        </tr>
        <?while ( 	$linha = mysql_fetch_object($result) ){ ?>
        <tr bgcolor="#FCE9BC"> 
          <td width="35%" bgcolor="#FCE9BC"><a href="javascript:abre(<?=$linha->id_pessoa?>);"> 
            <?=$linha->nome?>
            </a></td>
          <td width="36%"> 
            <?=pegaCargo($linha->cargo_id)?>
          </td>
          <td width="23%"> 
            <?=$linha->telefone?>
          </td>
          <td width="6%"><a href="manutpessoa.php?id_pessoa=<?=$linha->id_pessoa?>">M</a></td>
        </tr>
        <?}?>
      </table>
    </td>
  </tr>
</table>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr> 
    <td>[<a href="alteradados.php?id_cliente=<?=rawurlencode($id_cliente)?>">alterar 
      dados do cliente</a>]</td>
    <td align="right">[<a href="javascript:document.form.submit();">cadastrar 
      mais pessoas</a>]</td>
  </tr>
  <tr>
    <td>[<a href="clientes01.php">voltar p/ pesquisa de cliente</a>]</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<blockquote> 
  <p>&nbsp;</p>
</blockquote>
<form name="form" method="post" action="pessoa.php">
  <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
  <input type="hidden" name="cliente" value="<?=$cliente?>">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p> 
  <script>
function mostra(item){
 if (item.style.display=='none'){
   item.style.display='';
   texto.innerHTML='Esconde';
 } else {
   item.style.display='none'
   texto.innerHTML='Mostra';
 }
}
</script>
</p>
</body>
</html>
