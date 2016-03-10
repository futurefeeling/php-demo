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
       * @param  [type] $config [description]
       *
       * @return bool           返回连接结果
       */
      public function connect($config)
      {
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
       * @return array        返回一条信息数组
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
       * @param  int $row   指定的行数
       * @param  int $filed 置顶的字段索引
       *
       * @return array          返回指定行指定字段的值
       */
      public function findResult($query, $row = 0, $filed = 0)
      {
          $result = mysql_result($query, $row, $field);

          return $result;
      }
  }
