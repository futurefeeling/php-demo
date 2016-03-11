<?php

  /**
   * 测试controller.
   */
  class testController
  {
      public function show()
      {
          global $smarty;

          $testModel = M('test');
          $data = $testModel->get();


          $smarty -> assign('name', 'Hello, world.');
          // exit;
          $smarty -> display('test.tpl');
      }
  }
