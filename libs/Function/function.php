<?php

  /**
   * 调用控制器.
   *
   * @param string $name   要调用的控制器名称
   * @param string $method 要调用控制器的方法名称
   */
  function C($name, $method)
  {
      require_once('./Controller/'.$name.'Controller.class.php');
      $controller = $name.'Controller';
      $newController = new $controller();
      $newController->$method();
  }

  /**
   * 创建Model实例.
   *
   * @param  string $name 要创建的Model实例名称
   *
   * @return object      返回创建的Model对象
   */
  function M($name)
  {
      require_once './Model/'.$name.'Model.class.php';
      $model = $name.'Model';
      $newModel = new $model();

      return $newModel;
  }

  /**
   * 创建View实例.
   *
   * @param  string $name 要创建的View实例名称
   *
   * @return object      返回创建的View对象
   */
  function V($name)
  {
      require_once './View/'.$name.'View.class.php';
      $view = $name.'View';
      $newView = new $view();

      return $newView;
  }

  /**
   * 对传入的非法参数进行过滤.
   *
   * @param  string $str 要过滤的字符串
   *
   * @return string      过滤后的字符串
   */
  function daddslashes($str)
  {
      return (!get_magic_quotes_gpc()) ? addslashes($str) : $str;
  }

?>
