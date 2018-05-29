<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<p>conversao</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<?

require("../scripts/conn.php");

$Destinatario = 98;
$Consultor = 98;

	$Email = PegaEmailUsuario($Destinatario);
	$NomeCliente = peganomeusuario($Destinatario);


$c = 1;
$temp = array();

/*
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - DIV/TESTES";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHV700A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRACTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAGE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAGEDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAGP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAGPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAMB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAMBDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAME.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAMEDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAPRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAPT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAPTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAUX.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAUXDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAV3.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAV3DB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVJ.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVJDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRAVMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRBCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRBCODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRBRI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRBRIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRBXA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCAC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCACDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCADDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCAP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCAPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCAV.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCAVDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCCC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCCCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCDC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCDCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCHK.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCHKDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCOL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCOLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCOM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCOMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCPC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCPCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCRI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCRIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCTM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCTMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCTR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRCTRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDCODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDIR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDIRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDTR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRDTRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECD.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECDDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRECUDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREMV.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREMVDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRENC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRENCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRERS.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRERSDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHREXTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFAM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFAMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFCL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFCLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFOR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFORDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFPC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFPCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFRL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFRLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFUA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFUADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFUC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRFUCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGEA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGEADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGER.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGERDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGUI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRGUIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRHID.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRHIDDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRHIS.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRHISDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRIMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRINT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRINTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLAN.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLANDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLAPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLAT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLATDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLAU.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLAUDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLTR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRLTRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMAG.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMAGDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMAI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMAIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMCL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMCLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMED.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMEDDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMEX.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMEXDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMOV.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMOVDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMTR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMTRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMVE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMVEDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMVM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRMVMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRNEC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRNECDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRNOM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRNOMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROBJ.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROBJDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROBP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROBPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHROCODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRORT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRORTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPAD.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPADDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPCH.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPCHDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPDP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPDPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPEP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPEPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPES.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPESDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPLA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPLADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPPRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPREDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRV.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPRVDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPSA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPSADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPSO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRPSODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQIN.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQINDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQST.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQSTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQUA.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRQUADB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRCL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRCLDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRECDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRELDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRREPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRFM.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRFMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRIS.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRISDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRKT.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRKTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMD.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMDDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMPMD.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRMPMDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRROC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRROCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRPP.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRRPPDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSEL.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSELDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSEQ.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSEQDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSOC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSOCDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSTR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRSTRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTBR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTBRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTPR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTPRDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTRE.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTREDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTRI.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTRIDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTST.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTSTDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTUR.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRTURDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRVAC.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRVACDB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRVCO.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHRVCODB.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA01A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA02A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA03A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA04A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA05A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA06A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIA07A.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RIMENU.CBL";
*/


$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS001.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS002.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS003.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS004.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS005.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS007.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS008.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS009.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS010.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS010G.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS011.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS012.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS013.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS014.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS015.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS016.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS019.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS020.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS021.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS022.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS024.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS025.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS026.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS027.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS028.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS029.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS030.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS031.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS032.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS033.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS034.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS035.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS036.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS037.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS038.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS039.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS040.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS041.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS042.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS043.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS044.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS045.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS046.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS047.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS050.CBL";
$temp[$c++] = "CONVERSAO FUJITSU - Servico Social - RHS053.CBL";

$SistemaId = 26; // Servico social
$CategoriaId = 1298;
$MotivoId = 47;
$ChamadoPaiId = 294378;
$ChamadoPaiMotivo = "P";

echo "<pre>";

$c--;
for ($i = 1; $i <= $c; $i++)
{

	$Chamado = $temp[$i];
	$Contato = "Chamado origem [$ChamadoPaiId]";


	
	$Chamado = mysql_real_escape_string ($Chamado);
	$Contato = mysql_real_escape_string ($Contato);	
    $datae = date("Y-m-d");
    $horae = date("H:i:s");	
	
		
	$sql = "insert into chamado ( ";
	$sql .= " consultor_id, cliente_id, sistema_id, categoria_id, ";
	$sql .= " prioridade_id, motivo_id, descricao, dataa, status, horaa, ";
	$sql .= " destinatario_id, remetente_id, diagnostico_id, email, lido, ";
	$sql .= " lidodono, nomecliente, datauc, horauc, visible, chamado_pai_id, chamado_pai_motivo  ) ";	
	$sql .= " values ( ";
	$sql .= " $Consultor, 'DATAMACE', $SistemaId, $CategoriaId, ";
	$sql .= " 1, $MotivoId, '$Chamado', '$datae', 2, '$horae', ";
	$sql .= " $Destinatario, $Consultor, 0, '$Email', 0, ";
	$sql .= " 1, '$NomeCliente', '$datae', '$horae', 1, $ChamadoPaiId, '$ChamadoPaiMotivo' )";
	
	mysql_query($sql) or die (mysql_error());			
	
	$sql = "select id_chamado from chamado where sistema_id = $SistemaId and remetente_id = $Consultor and destinatario_id = $Destinatario order by id_chamado desc limit 1";	
	
	$result = mysql_query($sql);
	
	$linha = mysql_fetch_object($result);
		
	$id_chamado = $linha->id_chamado;
	

	echo "[" . $id_chamado . "]<br>";

	
	
	$sql = "insert into contato ( ";
	$sql .= " chamado_id, pessoacontatada, origem_id, "; 
	$sql .= " historico, consultor_id, destinatario_id, status_id, "; 
	$sql .= " dataa, datae, horaa, horae, idc, publicar, fl_ativo ) "; 	
	$sql .= " values ( ";	
	$sql .= " $id_chamado, '$NomeCliente', 8, "; 
	$sql .= " '$Contato', 12, $Destinatario, 2, "; 
	$sql .= " '$datae', '$datae', '$horae', '$horae', $id_chamado, 0, 1"; 
	$sql .= " )";	
	
	mysql_query($sql) or die (mysql_error());
	
	
	
}
	
	echo "</pre>";
	
?>



</body>
</html>