<?php

    /**
     * 数据库工厂模式.
     */
    class DB
    {
        // 将要实例的对象
        public static $db;

        /**
         * 对象实例初始化
         * @param  string $dbtype 要进行实例的对象名称
         * @param  array  $config 实例对象的配置数组
         * @return obj            具体类的实例化
         */
        public static function init($dbtype = 'mysql', $config)
        {
            self::$db = new $dbtype();
            self::$db->connect($config);
        }

        /**
         * 数据库查询
         * @param  string $sql 数据库查询语句
         * @return source      成功返回查询资源，失败返回false
         */
        public static function query($sql)
        {
            return self::$db->query($sql);
        }

        /**
         * 执行查询语句和查询所有查询结果
         * @param  string $sql 数据库查询语句
         * @return array       返回数据库全部查询结果
         */
        public static function findAll($sql)
        {
            $query = self::$db -> query($sql);
            return self::$db->findAll($query);
        }

        /**
         * 查询一条查询结果
         * @param  string $sql 数据库查询语句
         * @return array       返回一条查询结果
         */
        public static function findOne($sql)
        {
            $query = self::$db -> query($sql);
            return self::$db->findOne($query);
        }

        /**
         * 查询指定行指定字段数据
         * @param  string  $sql   数据库查询语句
         * @param  integer $row   指定的查询结果的行号
         * @param  integer $field 指定查询结果的字段索引号
         * @return array          查询结果数据
         */
        public static function findResult($sql, $row = 0, $field = 0)
        {
            $query = self::$db -> query($sql);
            return self::$db->findResult($query, $row, $field);
        }

        /**
         * 数据表插入记录操作
         * @param  string $table 数据库表明
         * @param  array  $arr   要插入的纪录键值数组对
         * @return int           成功插入数据后的id值
         */
        public static function insert($table, $arr)
        {
            return self::$db->insert($table, $arr);
        }

        /**
         * 更新数据表数据
         * @param  string $table 目标的数据表
         * @param  array  $arr   要更新数据键值对数组
         * @param  string $where 查询条件
         * @return source        返回更新资源
         */
        public static function update($table, $arr, $where)
        {
            return self::$db->update($table, $arr, $where);
        }

        /**
         * 删除记录
         * @param  string $table 目标的数据表名
         * @param  array  $where 要删除的条件
         * @return source        返回删除的资源
         */
        public static function del($table, $where)
        {
            return self::$db->del($table, $where);
        }
    }
