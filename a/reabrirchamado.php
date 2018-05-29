<script>

  function seleciona() {
    window.name = "pai";
    value = document.form.clientecodigo.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }
</script>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form name="form" method="post" action="">
  <font color="#0000FF"><b> 
  <input type="text" name="clientecodigo">
  <br>
  </b>&nbsp;[<a href="javascript:seleciona(); ">pesquisa empresa</a>]<b></b></font> 
</form>
</body>
</html>
