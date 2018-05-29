<?
// Autor: Lucas Oliveira Silva 
// Data: 01/03/2011 20:30
// Local: Home
// Objetivo: Retorna o XML dos slects para que seja montada a grid "JQUERY"

$ACESSO = ''; // Verifica se o acesso é permitido de acordo com o usuário
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

$page = $_REQUEST['page']; // get the requested page
$limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
$sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
$sord = $_REQUEST['sord']; // get the direction
if(!$sidx) $sidx =1;

$wh = "";
$searchOn = Strip($_search);
if($searchOn=='true') {
	$fld = Strip($searchField);
	$fldata = Strip($searchString);
	$foper = Strip($searchOper);

	switch ($TipHelp) {
    	case 'config':
			switch ($fld){
				case "conf_data":
					$fldata = substr($fldata,6,4) . '-' . substr($fldata,3,2) . '-' . substr($fldata,0,2);
					break;
				case "conf_hora_inicial":
				case "conf_hora_final":
					$fldata	= str_replace(':','',$fldata);
					break;
			}
		break;
	}

	$wh .= " WHERE ".$fld;
	switch ($foper) {
		case "eq": // text: "is equal to"
			if(is_numeric($fldata)) {
				$wh .= " = ".$fldata;
			} else {
				$wh .= " = '".$fldata."'";
			}
			break;
		case "ne": // text: "is not equal to"
			if(is_numeric($fldata)) {
				$wh .= " <> ".$fldata;
			} else {
				$wh .= " <> '".$fldata."'";
			}
			break;
		case "lt": // text: "is less than"
			if(is_numeric($fldata)) {
				$wh .= " < ".$fldata;
			} else {
				$wh .= " < '".$fldata."'";
			}
			break;
		case "le": // text: "is less or equal to"
			if(is_numeric($fldata)) {
				$wh .= " <= ".$fldata;
			} else {
				$wh .= " <= '".$fldata."'";
			}
			break;
		case "gt": // text: "is greater than"
			if(is_numeric($fldata)) {
				$wh .= " > ".$fldata;
			} else {
				$wh .= " > '".$fldata."'";
			}
			break;
		case "ge": // text: "is greater or equal to"
			if(is_numeric($fldata)) {
				$wh .= " >= ".$fldata;
			} else {
				$wh .= " >= '".$fldata."'";
			}
			break;
		case "in": // text: "is in"
				$wh .= " IN (".$fldata.")";
			break;
		case "ni": // text: "is not in"
				$wh .= " NOT IN (".$fldata.")";
			break;
		case "bw": // text: "begins with"
			$wh .= " LIKE '".$fldata."%'";
			break;
		case "bn": // text: "does not begin with"
			$wh .= " NOT LIKE '".$fldata."%'";
			break;
		case "ew": // text: "ends with"
			$wh .= " LIKE '%".$fldata."'";
			break;
		case "en": // text: "does not end with"
			$wh .= " NOT LIKE '%".$fldata."'";
			break;
		case "cn": // text: "contains"
			$wh .= " LIKE '%".$fldata."%'";
			break;
		case "nc": // text: "does not contain"
			$wh .= " NOT LIKE '%".$fldata."%'";
			break;
		default :
			$wh = "";
			break;
	}
}

switch ($TipHelp) {
    case 'config':
		$SQL = "SELECT count(1) as count FROM config $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT conf_id, conf_hora_inicial, conf_hora_final, date_format(conf_data, '%d/%m/%Y') as conf_data FROM config $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=utf-8"); } else {
  		header("Content-type: text/xml;charset=utf-8");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='utf-8'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['conf_id']."'>";			
			$res .= "<cell>". $row['conf_id']."</cell>";
			$res .= "<cell>". $row['conf_data']."</cell>";
			$res .= "<cell>". substr($row['conf_hora_inicial'],0,2) . ":" . substr($row['conf_hora_inicial'],2,2)."</cell>";
			$res .= "<cell>". substr($row['conf_hora_final'],0,2) . ":" . substr($row['conf_hora_final'],2,2)."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "perguntas":
	case "treino":
	case "sistemas":
	case "conceitos":
	
		if ($TipHelp == "conceitos") $PreTab = "con_";
		
		$SQL = "SELECT count(1) as count FROM ".$TipHelp." $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT ".$PreTab."id, ".$PreTab."descricao FROM ".$TipHelp." $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row ".$PreTab."id='". $row[$PreTab.'id']."'>";			
			$res .= "<cell>". $row[$PreTab.'id']."</cell>";
			$res .= "<cell>". $row[$PreTab.'descricao']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "modulos":
		$SQL = "SELECT count(1) as count FROM modulos $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT M.id as ID, M.descricao as DES, S.descricao as SIS FROM modulos as M " .
				" left join sistemas as S on S.id = M.cod_sistema " .
				" $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['ID']."'>";			
			$res .= "<cell>". $row['ID']."</cell>";
			$res .= "<cell>". $row['DES']."</cell>";
			$res .= "<cell>". $row['SIS']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "provas":
		$SQL = "SELECT count(1) as count FROM provas $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT id, descricao, qtd_perguntas FROM provas $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['id']."'>";			
			$res .= "<cell>". $row['id']."</cell>";
			$res .= "<cell>". $row['descricao']."</cell>";
			$res .= "<cell>". $row['qtd_perguntas']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "treinando":
		$SQL = "SELECT count(1) as count FROM cadastrotreinamento $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT rg, nome, date_format(hoje,'%d/%m/%Y') as hoje FROM cadastrotreinamento $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['rg']."'>";			
			$res .= "<cell>". $row['rg']."</cell>";
			$res .= "<cell>". $row['nome']."</cell>";
			$res .= "<cell>". $row['hoje']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "instrutor":
		$SQL = "SELECT count(1) as count FROM instrutor $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT * FROM instrutor $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['ins_id']."'>";			
			$res .= "<cell>". $row['ins_id']."</cell>";
			$res .= "<cell>". $row['ins_nome']."</cell>";
			$res .= "<cell>". $row['ins_email']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

	case "revisao_formulario":
		$SQL = "SELECT count(0) as count FROM revisao_formulario $wh ORDER BY ".$sidx ." ".$sord; //." LIMIT ".$start." , ".$rows
		$result	= mysql_query($SQL);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ($start<0) $start = 0;
		$SQL = "SELECT rf_id, rf_descricao, concat('Rev: ', right(concat('0',cast(rf_revisao as char(2))), 2)) as rf_revisao FROM revisao_formulario $wh ORDER BY ".$sidx ." ".$sord . " LIMIT ".$start." , ".$rows;

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=iso-8859-1"); } else {
  		header("Content-type: text/xml;charset=iso-8859-1");
		}
	  	$et = ">";
  		$res = "<?xml version='1.0' encoding='iso-8859-1'?$et\n";
		$res .= "<rows>";
		$res .= "<page>".$page."</page>";
		$res .= "<total>".$total_pages."</total>";
		$res .= "<records>".$count."</records>";
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$res .= "<row id='". $row['rf_id']."'>";			
			$res .= "<cell>". $row['rf_id']."</cell>";
			$res .= "<cell>". $row['rf_descricao']."</cell>";
			$res .= "<cell>". $row['rf_revisao']."</cell>";
			$res .= "</row>";
		}
		$res .= "</rows>";
		echo $res;
		break;

}

if (count($DEBUG) > 0){
	$handle = fopen('DEB.txt', 'w') ;
	for ($i=0; $i<count($DEBUG); $i++){
		fwrite($handle, $DEBUG[$i]) ;
	}
	fclose($handle);
}

?>