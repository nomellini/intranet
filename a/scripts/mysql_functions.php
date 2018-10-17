<?php

if ("PHPVersion" == "5") {

  die ("opa");
if (!function_exists("mysql_connect")) {
  function mysql_connect($host, $user, $pwd)
  {
    return mysqli_connect($host, $user, $pwd);
  }
}

if (!function_exists("mysql_set_charset")) {
  function mysql_set_charset($MyConnection, $charset)
  {
    return mysqli_set_charset($MyConnection, $charset);
  }
}

if (!function_exists("mysql_select_db")) {
  function mysql_select_db($MyConnection, $base)
  {
    global $MyConnection;
    return mysqli_select_db($MyConnection, $base);
  }
}

  if (!function_exists("mysql_affected_rows")) {
    function mysql_affected_rows()
    {
      global $MyConnection;
      return mysqli_affected_rows($MyConnection);
    }
  }

if (!function_exists("mysql_fetch_array")) {
  function mysql_fetch_array($rs)
  {
    global $MyConnection;
    return mysqli_fetch_array($rs);
  }
}

if (!function_exists("mysql_query")) {
  function mysql_query($sql)
  {
    global $MyConnection;
    return mysqli_query($MyConnection, $sql);
  }
}

if (!function_exists("mysql_escape_string")) {
  function mysql_escape_string($string)
  {
    global $MyConnection;
    return mysqli_escape_string($MyConnection, $string);
  }
}

if (!function_exists("mysql_fetch_assoc")) {
  function mysql_fetch_assoc($rs)
  {
    return mysqli_fetch_assoc($rs);
  }
}

if (!function_exists("mysql_fetch_object")) {
  function mysql_fetch_object($result)
  {
    return mysqli_fetch_object($result);
  }
}

if (!function_exists("mysql_error")) {
  function mysql_error() {
    global $MyConnection;
    return mysqli_error($MyConnection);
  }
}

if (!function_exists("mysql_num_rows")) {
  function mysql_num_rows($rs) {
    return mysqli_num_rows($rs);
  }
}

if (!function_exists("mysql_fetch_row")) {
  function mysql_fetch_row($rs) {
    return mysqli_fetch_row($rs);
  }
}

if (!function_exists("mysql_free_result")) {
  function mysql_free_result($rs)
  {
    return mysqli_free_result($rs);
  }
}
}
?>