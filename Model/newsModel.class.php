<?php
    /**
     *
     */
    class newsModel
    {
        public $_table = 'news';

        public function count()
        {
            $sql = 'SELECT count(*) FROM '.$this->_table;
            return DB::findResult($sql);
        }
    }

 ?>
