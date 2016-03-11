<?php
    /**
     * 后台控制器.
     */
    class adminController
    {
        public function test()
        {
            echo 'hello';
        }

        public function login()
        {
            VIEW::display("admin/login.html");
        }
    }
?>
