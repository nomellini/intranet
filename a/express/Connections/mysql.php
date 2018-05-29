<?/*
		' FileName="Connection_php_mysql.htm"
		' Type="ADO"
		' HTTP="false"
		' Catalog=""
		' Schema=""
		MM_mysql_STRING = "dsn=MySQL;uid=mysql;pwd=napoleao;"
		*/
		$MM_mysql_HOSTNAME = "192.168.0.5";
		$MM_mysql_DATABASE = "teste";
		$MM_mysql_USERNAME = "sad";
		$MM_mysql_PASSWORD = "data1371";
		$mysql = mysql_connect($MM_mysql_HOSTNAME, $MM_mysql_USERNAME, $MM_mysql_PASSWORD) or DIE(mysql_error());
		mysql_select_db($MM_mysql_DATABASE, $mysql)

		?>
		