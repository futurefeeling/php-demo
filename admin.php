<?php

  // url 形式 index.php?controller=控制器名&method=方法名

  header("Content-type:text/html; charset=utf-8");
  session_start();

  require_once('config.php');
  require_once('libs/farzer.php');

  FARZER::run($config);

?>
