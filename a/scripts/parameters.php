<?
	require_once('conn.php');
	
	define('PARAM_USUARIO_ADMINISTRADOR', 1);
	define('PARAM_DISPARA_EMAIL', 2);

	function params_obter($id_parametro)
	{
		$sql = "select vl_valor from parametros where id_parametro = $id_parametro";
		return conn_ExecuteScalar($sql);
	}
	
	function params_gravar($id_parametro, $valor)
	{
	}
	
?>