<?php

    // 启动引擎：完成初始化，调用控制器

    $currentdir = dirname(__FILE__);

    include_once $currentdir.'/include.list.php';
    foreach ($paths as $name => $path) {
        include_once $currentdir.'/'.$path;
    }

    class Farzer
    {
        public static $controller;
        public static $method;
        private static $config;

        private static function init_db()
        {
            DB::init(self::$config['dbtype'], self::$config['dbconfig']);
        }

        private static function init_view()
        {
            VIEW::init(self::$config['viewtype'], self::$config['viewconfig']);
        }

        private static function init_controller()
        {
            self::$controller = isset($_GET['controller']) ? daddslashes($_GET['controller']) : 'test';
        }

        public static function init_method()
        {
            self::$method = isset($_GET['method']) ? daddslashes($_GET['method']) : 'test';
        }

        public static function run($config)
        {
            self::$config = $config;
            self::init_db();
            self::init_view();
            self::init_controller();
            self::init_method();

            C(self::$controller, self::$method);
        }
    }
