<?php

    class adminModel
    {
        public $_table = 'admin';

        // 取用户信息，通过用户名
        function findOneByUsername($username)
        {
            $sql = 'SELECT * FROM '.$this->_table.' WHERE username="'.$username.'"';
            return DB::findOne($sql);
        }

        // 核对用户信息 --> authModel
    }

 ?>
