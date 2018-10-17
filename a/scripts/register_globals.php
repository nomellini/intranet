<?php

  if (isset($_COOKIE)) {
    while(list($var,$val) = myEach($_COOKIE)) {
      $$var = $val;
    }
  }

  if (isset($_SESSION)) {
    while(list($var,$val) = myEach($_SESSION)) {
      $$var = $val;
    }
  }

  if (isset($_REQUEST)) {
    while(list($var,$val) = myEach($_REQUEST)) {
      $$var = $val;
    }
  }

  if (isset($_POST)) {
    while(list($var,$val) = myEach($_FORM)) {
      $$var = $val;
    }
  }

?>