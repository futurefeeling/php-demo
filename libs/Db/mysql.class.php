<?php
  /**
   * Mysql 操作类.
   */
  class mysql
  {
      /**
       * 报错函数.
       *
       * @param  string $error mysql返回的错误信息
       *
       * @return string        报错信息
       */
      public function err($error)
      {
          // die 相当于 echo 与 exit 的结合
          die('对不起，您操作有误，原因为：'.$error);
      }

      /**
       * 连接数据库.
       *
       * @param  array $config  一维关联数组形式的数据库配置文件
       *
       * @return bool           返回连接结果
       */
      public function connect($config)
      {
          // extract 将数组转化变量
          extract($config);
          if (!($con = mysql_connect($HOST, $USERNAME, $PASSWORD))) {
              $this->err(mysql_error());
          }
          if (!($database = mysql_select_db($DBNAME, $con))) {
              $this->err(mysql_error());
          }
          mysql_query('SET NAMES '.$DBCHARSET);
      }

      /**
       * mysql 查询.
       *
       * @param  string $sql mysql查询语句
       *
       * @return bool        执行成功返回资源，失败返回false
       */
      public function query($sql)
      {
          if (!($query = mysql_query($sql))) {
              $this->err($sql.'<br/>'.mysql_error());
          } else {
              return $query;
          }
      }

      /**
       * 获得全部查询结果.
       *
       * @param  source $query mysql查询成功后返回的资源
       *
       * @return array         结果集
       */
      public function findAll($query)
      {
          while ($row = mysql_fetch_array($query, MYSQL_ASSOC)) {
              $list[] = $row;
          }

          return isset($list) ? $list : '';
      }

      /**
       * 获得一条查询结果.
       *
       * @param  source $query mysql查询后返回的资源
       *
       * @return array         返回一条信息数组
       */
      public function findOne($query)
      {
          $result = mysql_fetch_array($query, MYSQL_ASSOC);

          return $result;
      }

      /**
       * 查找指定行指定字段的数据.
       *
       * @param  source  $query mysql查询返回的资源
       * @param  int     $row   指定的行数
       * @param  int     $filed 置顶的字段索引
       *
       * @return array          返回指定行指定字段的值
       */
      public function findResult($query, $row = 0, $filed = 0)
      {
          $result = mysql_result($query, $row, $field);

          return $result;
      }
      /**
       * 向数据库插入数据.
       *
       * @param  string $table 数据库表名
       * @param  array  $arr   要插入的键值对的一维数组
       *
       * @return int           成功插入数据后数据的id值
       */
      public function insert($table, $arr)
      {
          // insert into tb_name(field...) values(values...)
          foreach ($arr as $key => $value) {
              $value = mysql_real_escape_string($value);
              $keyArr[] = '`'.$key.'`';
              $valueArr[] = "'".$value."'";
          }

          // implode 将数组变成字符串
          $keys = implode(',', $keyArr);
          $values = implode(',', $valueArr);

          $sql = 'INSERT INTO '.$table.'('.$keys.') VALUES('.$values.')';
          $this->query($sql);

          return mysql_insert_id();
      }

      public function update($table, $arr, $where)
      {
          // update tb_name set field=value[,...] where ...
          foreach ($arr as $key => $value) {
              $value = mysql_real_escape_string($value);
              $keyAndValueArr[] = '`'.$key."`='".$value."'";
          }

          $keyAndValueArr = implode(',', $keyAndValueArr);
          $sql = 'UPDATE '.$table.' set '.$keyAndValueArr.' where '.$where;

          $this->query($sql);
      }
      public function del($table, $where)
      {
          $sql = 'DELETE FROM '.$table.' where '.$where;

          $this->query($sql);
      }
  }
