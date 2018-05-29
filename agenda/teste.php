<?
 require("../a/scripts/conn.php");		
 $ok=12;
 /*
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
   $nomeusuario=peganomeusuario($ok);	
 */
 ?> 
 
 
 
 <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <tr>
                      <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#A2C8DB">
<?
  $ok=11;
  $sql = "Select id, hora, resumo, local from compromisso WHERE data = '$ano-$mes-$dia' Order by hora";
  echo $sql;
  $result1 = mysql_query($sql);
  while ($linha1=mysql_fetch_object($result1)) { 
    $sql  = "select compromissousuario.confidencial, compromissousuario.lido, compromissousuario.id_usuario, usuario.nome ";
	$sql .= "from compromissousuario, usuario where id_compromisso=$linha1->id and ";	
    $sql .= "  compromissousuario.id_usuario = usuario.id_usuario ";
    $sql .= "  AND ( ";
    $sql .= "      ( compromissousuario.confidencial = 0 and compromissousuario.id_usuario <> $ok ) OR ";
    $sql .= "      ( compromissousuario.id_usuario = $ok ) ";
    $sql .= " ) ORDER BY nome";
	$result = mysql_query($sql);
	echo $sql;
    $nomes = "";
     if (mysql_affected_rows()==1) {	 
       $linha=mysql_fetch_object($result);
	   $nome = $linha->nome;
       if ($linha->id_usuario==$ok) {
        $nome = "<b>$nome</b>";
       }	  
	 } else {
       $nome = "grupo";
       while ($linha=mysql_fetch_object($result)) { 
	     if ($nomes!="") { $nomes.=", ";}
           $nomes .= "$linha->nome";
	   }
	 }
	 
 $m=1;
//    $icones = "";    
//	if ( $linha->id_usuario==$ok &&  !$linha->lido ) {
//      $icones .= "<img src=../a/figuras/idea01.gif>";
//	}	

/*	
	$m=1;
	if ($linha->confidencial) {
	  $m=0;
      if ($linha->id_usuario==$ok) {
	    $m = 1;
      }
	  $icones .= "<img src=../a/figuras/senha.gif>";
	}	
	*/
    if ($m) {
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td colspan="4" align="center" valign="middle"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
                                <tr> 
                                  <td bgcolor="#E1EFF4"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <tr valign="top"> 
                      <td width="14%" align="center">&nbsp; 
                        <?//=$icones?>
                        <?=$linha1->hora?>
                        &nbsp;</td>
                      <td width="22%"> <A HREF="detalhe.php?id_compromisso=<?=$linha->id?>" TARGET="detalhe" class="fundoclaro"> 
                        <?=$nome?>
                        </a></td>
                      <td><a href="#" class="fundoclaro"> 
                        <?=$linha1->resumo?>
                        </a> </td>
                    </tr>
                    <tr valign="top"> 
                      <td align="center">&nbsp;</td>
                      <td>&nbsp; </td>
                      <td> 
                        <?=$linha1->local?>
                      </td>
                    </tr>
					
					<? if ($nome=="grupo") {?>
                    <tr valign="top"> 
                      <td align="center">&nbsp;</td>
                      <td colspan="2"><?=$nomes?></td>
                    </tr>
					<?}?>
					
                  </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <? 
}
 } if (mysql_affected_rows()==0) {
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td colspan="4"><strong>Nenhum Compromisso para essa 
                              data</strong></td>
                          </tr>
                          <?
 }
?>
                        </table></td>
                    </tr>
                  </table>
 
 
 
<font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;Nomes 
selecionados : <span id="nomes"></span></font> <br><br>



   <table width="90%" border="0" cellspacing="0" cellpadding="0" id="abas">
  <tr>
 <?
	$sql = "select distinct left(nome, 1) as nome from usuario where ativo order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
      echo "<td></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"javascript:aba($qtde)\">$l</a></font></td><td></td>";	  
	}
?>	
	  </tr>
</table>
	
	<?
	$sql = "select distinct left(nome, 1) as nome from usuario where ativo order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
	
   ?><span id="nomes<?=$l?>" style="Display: none">


<table width="90%" border="0" cellpadding="1" cellspacing="1" bgcolor="225398">
  <tr>
    <td bgcolor="#FFFFFF">
	
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">

  <?	  
	  $sql2 = "select id_usuario, nome, email from usuario where ativo and left(nome,1)='$l'";
  	  $result2 = mysql_query($sql2);
      while ($linha2=mysql_fetch_object($result2)) { 
	    $s = "";
	    if ($ok == $linha2->id_usuario) {
		  $s="checked";
		}
   ?>
  <tr> 
    <td width="1%"  bgcolor="#FFFFFF"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input id="<?=$linha2->nome?>" type="checkbox" name="checkbox" value="<?=$linha2->id_usuario?>" onClick="atualiza()" <?=$s?>  >
      </font></td>
    <td width="99%" bgcolor="#FFFFFF"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$linha2->nome?>
      ( 
      <?=$linha2->email?>
      )</font></td>
  </tr>
  <?	  
	  }
  ?>
</table>	
	
	
	</td>
  </tr>
</table>


</span> 
<?
  	}
?>

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
  <?
    $qtde=0;
	$sql = "select distinct left(nome, 1) as nome from usuario where ativo order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
	  echo "tabs[".$qtde."] = nomes".$l.";";
	}
  ?>
aba(1);

function alterna(obj, nome) {
  
}
</script>
<script>
/*
 * Alterado por Fernando Nomellini 15.03.2003
 * function mudaTodos
 */
function atualiza() {
    var doc_tables = document.all.tags("input");
    var nome, linha, tipo, ativo;
	linha = "";
    for (i=0; i<doc_tables.length; i++)  { 
		 tipo  = doc_tables(i).type;
		 ativo = doc_tables(i).checked;
         nome  = doc_tables(i).id;
         if ( tipo == "checkbox" && ativo) {
		   if (linha != "") { linha = linha + ", ";}
           linha = linha + nome;
         }
        }
  if (linha == "") {
    window.alert("Você deve selecionar pelo menos um nome");
	linha = "<font color=#ff0000>Selecione pelo menos um nome</font>";
  }
  nomes.innerHTML = linha;		
}
atualiza();
</script>