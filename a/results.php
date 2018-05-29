<?php
	$db = mysql_connect("10.98.0.5", "sad", "data1371");
	if( !$db )
	{
		die("Error connecting to the Server");
		exit;
	}
	$result = mysql_select_db("sad", $db);
	if( !$result )
	{
		die("Error selecting Database");
		exit;
	}

	// code checking here
	//
?>


<html>


<head>


<title></title>


<style type="text/css">


BODY


{


    FONT-SIZE: 8pt;


    COLOR: black;


    FONT-FAMILY: Verdana, Arial, Tahoma;


    BACKGROUND-COLOR: white


}


BODY HR


{


    BORDER-RIGHT: black 1px;


    BORDER-TOP: black 1px;


    BORDER-LEFT: black 1px;


    BORDER-BOTTOM: black 1px solid;


    HEIGHT: 1pt


}


TABLE.WSGTableResults


{


    BORDER-RIGHT: firebrick 1px solid;


    BORDER-TOP: firebrick 1px solid;


    FONT-SIZE: 9pt;


    BORDER-LEFT: firebrick 1px solid;


    BORDER-BOTTOM: firebrick 1px solid;


    FONT-FAMILY: Verdana, Arial, Tahoma;


    BACKGROUND-COLOR: aliceblue


}


TR.WSGResultsHeader


{


    FONT-WEIGHT: bolder;


    FONT-SIZE: 9pt;


    COLOR: white;


    FONT-FAMILY: Verdana, Arial, Tahoma;


    HEIGHT: 15pt;


    BACKGROUND-COLOR: firebrick


}


TR.WSGResultsRowA


{


    FONT-SIZE: 9pt;


    BACKGROUND-COLOR: oldlace


}


TR.WSGResultsRowB


{


    FONT-SIZE: 9pt;


    BACKGROUND-COLOR: lightyellow


}


TABLE.WSGTableForm


{


    BORDER-RIGHT: darkgray 1px solid;


    BORDER-TOP: darkgray 1px solid;


    FONT-SIZE: 9pt;


    BORDER-LEFT: darkgray 1px solid;


    BORDER-BOTTOM: darkgray 1px solid;


    BACKGROUND-COLOR: whitesmoke


}


TR.WSGFormHeader


{


    FONT-WEIGHT: bolder;


    COLOR: black;


    HEIGHT: 15pt;


    BACKGROUND-COLOR: darkgray


}


TR.WSGField


{


}


TD.WSGFieldHeader


{


}


TD.WSGFieldData


{


}


INPUT.WSGInputText


{


    BORDER-RIGHT: dimgray 1px solid;


    BORDER-TOP: dimgray 1px solid;


    BORDER-LEFT: dimgray 1px solid;


    BORDER-BOTTOM: dimgray 1px solid


}


INPUT.WSGInputCheckBox


{


}


INPUT.WSGInputRadioBox


{


}


INPUT.WSGInputButton


{


    BORDER-RIGHT: dimgray 1px solid;


    BORDER-TOP: dimgray 1px solid;


    BORDER-LEFT: dimgray 1px solid;


    BORDER-BOTTOM: dimgray 1px solid


}





</style>


</head>


<body border="0" bgcolor="#ffffff">


<table width="100%" align="center">


<tr>


    <td>


       
<!-- Form Starts Here -->
	<form method="POST" action="<? echo $_SERVER['PHP_SELF'];?>" name="form_data">
		<div align="center">
		<center>
		<table class="WSGTableForm" border="0" cellpadding="1" cellspacing="1" width="50%">
		<tr class="WSGFormHeader"><td colspan="2" align="center">Enter your Data</td></tr>
		  <tr class="WSGField">
		    <td class="WSGFieldHeader">id</td>
		    <td class="WSGFieldData" align="right"><input class="WSGInputText"  type="text" name="id" value=""></td>
		  </tr>
		<tr><td colspan="2">&nbsp</td></tr>
		  <tr class="WSGField">
		    <td class="WSGFieldData" colspan="2" align="center"><input class="WSGInputButton" type="submit" name="submit" value="Search"></td>
		  </tr>
		</table>
		</center>
		</div>
	</form>
<!-- Form Ends Here -->



    </td>


</tr>


<tr>


    <td>&nbsp;</td>


</tr>


<tr>


    <td>
<!-- Results Start Here -->
<div align="center">
     <center>
     <table class="WSGTableResults" border="0" cellpadding="0" cellspacing="1" width="100%">
<?php
    $query  = "SELECT descricao FROM area WHERE id = '$id'";
    $result = mysql_query($query,$db);
     if( !$result )
     {
        die("Error executing query");
     }
     echo "<tr class=\"WSGResultsHeader\">";
     echo "<td align=\"center\">descricao</td>";
     echo "</tr>";
     $altrow = 0;
     while( $row = mysql_fetch_array($result))
     {
           $class="A";
           if($altrow) $class="B";
           $altrow = !$altrow;
			  echo "<tr class=\"WSGResultsRow$class\">\n";
			  echo " <td align=\"left\">".$row[0]."</td>\n";
			  echo "</tr>";
        $nrow++;
     }
     mysql_free_result($result);
     mysql_close($db);
?>
     </table>
     </center>
</div>
<!-- Results End Here -->
</td>


</tr>


</table>


</body>


</html>