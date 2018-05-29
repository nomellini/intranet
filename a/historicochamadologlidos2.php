<?	
	require("cabeca.php");
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 0  ) );  	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=iso-8859-1>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tudo</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<script>
setInterval(teste(), 1000);

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

  </head>


<body>
<div class="col-md-10">
	<h2>Movimentação do sad : <?=$_REQUEST['last_update']?></h2>
</div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
	
<script>
function teste() {
	$(function () {
		$.ajax({
			dataType: "json",
			type: "GET",
			url: "http://192.168.0.14/a/historicochamadologlidosJson.php",
			success: function (dados) {
				$(dados).each(function (i) {
					document.writeln(dados[i].chamado + " - em " + dados[i].data + ", " + dados[i].nome + " " + dados[i].acao + " do cliente " + dados[i].cliente + " <br>")
				});
			}
		});
	});
}

</script>
</body>
</html>
