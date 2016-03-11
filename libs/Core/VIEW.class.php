<?php

    /**
     * 视图引擎工厂模式
     */
    class VIEW
    {
        public static $view;

        /**
         * 引擎初始化
         * @param  string $viewtype 要实例化的引擎名称
         * @param  array  $config   引擎初始化配置
         * @return object           初始化的对象
         */
        public static function init($viewtype, $config)
        {
            self::$view = new $viewtype;

            foreach ($config as $key => $value) {
                self::$view -> $key = $value;
            }
        }

        /**
         * 引擎注册变量
         * @param  array  $data 要注册的变量
         * @return object       注册后的对象
         */
        public static function assign($data)
        {
            foreach ($data as $key => $value) {
                self::$view -> assign($key, $value);
            }
        }

        /**
         * 运行模版
         * @param  string $template 模版路径
         * @return object           运行模版
         */
        public static function display($template)
        {
            self::$view -> display($template);
        }
    }

 ?>
