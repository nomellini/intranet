<?
	require("cabeca.php");


	if ($_POST["action"] == "gravar")
	{
		$Text_Atual = $_POST["documentacao"];

		$Text_Atual = mysql_escape_string ($Text_Atual);


		$sql = "insert into chamado_documentacao (id_chamado, documentacao, DataHora, id_usuario) values ($id_chamado, '$Text_Atual', '$Data_Atual $Hora_Atual', $ok)";
        conn_ExecuteNonQuery($sql);
		$sql = "update chamado set documentacao = '$Text_Atual' where id_chamado = $id_chamado";
		conn_ExecuteNonQuery($sql);
	}

	$Area = pegaArea($ok);
	$PodeEditar = ($Area == 2) || ($Area == 3) ||($Area == 11) ;
	$descricao_chamado = conn_ExecuteScalar("select left(descricao, 100) des from chamado where id_chamado = $id_chamado");
	$sql = "select documentacao from chamado where id_chamado = $id_chamado";

	$text = conn_ExecuteScalar($sql);

	$Label = "Criar documenta��o";
	if ($text != "")
	{
		$Label = "Editar documenta��o";
		$descricao = preg_replace('/\s\s+/', ' ', $text);
		$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
		$text = str_replace(array("\n", "\r"), array('\n', '\r'), $descricao );
		$text = str_replace("\"", "'", $text);
		$text = str_replace("\\", "\\\\", $text);
	} else {
		$descricao = "Chamado sem documenta��o<br><br>";
		if ($PodeEditar)
		{
			$descricao .= "Clique em <b>Criar documenta��o</b> para come�ar";
		}
	}


?>
<!doctype html>
<html>
<head>
<script src="../scripts/jquery-1.4.2.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documenta&ccedil;&atilde;o para o chamado <?=$id_chamado?></title>
</head>
<body style="font-family:Arial; font-size:15px">
<div align="center" ><H3>Documenta&ccedil;&atilde;o para o chamado <?=$id_chamado?></H3></div>
<hr size=1px>
<strong>Descri&ccedil;&atilde;o do chamado</strong>:
<?= $descricao_chamado?>
<hr size=1px>
<div id="ver" style="display:">
  <strong>Documenta��o</strong>:<br><br>
  <div id="text" >
    <?=$descricao?>
  </div>

<?
		if ($PodeEditar)
		{
?>
	<hr size=1px>
  <input type="button" value="<?=$Label?>" onClick="startEdit()">

<?
		}
?>


</div>


<div id="editar" style="display:none">

  <form name="form1" method="post">
    <div id="gravando" style="border:solid 1px; display:none; z-index:2; position:absolute; background-color:#FFF"></div>
    <textarea name="documentacao" cols="120" rows="20" style="width:100%"><?=$texto?>
    </textarea> <br>
    <input type="submit" name="gravar" value="gravar" id="Gravar">
    <input type="hidden" name="horaa" value="00:00:00">
    <input type="hidden" name="action" value="gravar">
     <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
  </form>
</div>
<p><span style="display:">
  <input type="button" value="Fechar" onClick="window.close()">
</span></p>
</body>
</html>

<script>

	$("#ver").children("p").select();

	var CKEDITOR_T = '';
	var CKEDITOR_H = '';

    function startEdit() {

		$("#ver").hide();
		$("#editar").show();

		CKEDITOR.replace( 'documentacao',
			{
				extraPlugins: 'colorbutton,justify,smiley,horizontalrule,autogrow',
				on: { 'instanceReady': function(evt) {
					CKEDITOR.instances.documentacao.focus();
				   }
				},
				language: 'pt-br',
				setFocusOnStartup : true,
				enterMode		: 2,
				toolbar :
				[
					{ name: 'clipboard', items: ['Cut', 'Copy', 'Paste'] },
					{ name: 'text', items: ['Bold', 'Italic', 'Underline' ]} ,
					{ name: 'colors', items: ['TextColor','BGColor']} ,

					[ 'Table', '-',
					  'JustifyLeft','JustifyCenter','JustifyRight', 'HorizontalRule', '-',
					  'Smiley', '-',
					  'NumberedList', 'BulletedList', '-',
					  'Link', 'Unlink']
				]

			});

		editor_data = "<?=$text?>";
		CKEDITOR.instances.documentacao.setData(editor_data);

		setInterval(saveDraft, 1000);
	}

function saveDraft() {


		if (CKEDITOR.instances.documentacao.getData() != "") {

			if ( (document.form1.horaa.value != CKEDITOR_H) ||
				 (CKEDITOR.instances.documentacao.getData() != CKEDITOR_T)){

				CKEDITOR_T = CKEDITOR.instances.documentacao.getData();
				CKEDITOR_H = document.form1.horaa.value;

				$("#gravando").show();
				$("#gravando").text("Gravando...");

				$.ajax({
					type: "POST",
					url: "SaveDraft_documentacao.php",
					data: ({
						documentacao:  CKEDITOR.instances.documentacao.getData(),
						id_chamado: <?=$id_chamado?>,
						id_usuario: <?=$ok?>,
						hora_inicio: document.form1.horaa.value
					}),
					success: function (response) {
						//$("#gravando").text("");
						$("#gravando").fadeOut("fast");
					}
				});
			}
		}

	}



</script>