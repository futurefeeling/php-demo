<?php

  // url 形式 index.php?controller=控制器名&method=方法名

  require_once('./function.php');
  require_once('config.php');
  // 定义允许访问的控制器和方法
  $controllerAllow = array('index', 'test');
  $methodAllow = array('index', 'show', 'test');

  require('./libs/ORG/Smarty/Smarty.class.php');
  $smarty = new Smarty();
  // $smarty -> testInstall();
  $smarty -> left_delimiter = '{';
  $smarty -> right_delimiter = '}';

  // 检测是否存在控制器和方法
  $controller = in_array($_GET['controller'], $controllerAllow) ? daddslashes($_GET['controller']) : 'index';
  $method = in_array($_GET['method'], $methodAllow) ? daddslashes($_GET['method']) : 'index';

  C($controller, $method);

?>
