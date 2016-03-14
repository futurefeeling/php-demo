<?php
    /**
     * 新闻模型
     */
    class newsModel
    {
        public $_table = 'news';

        public function count()
        {
            $sql = 'SELECT count(*) FROM '.$this->_table;

            return DB::findResult($sql, 0, 0);
        }

        public function getNewsInfo($id)
        {
            if (empty($id)) {
                return array();
            } else {
                $id = intval($id);  // 防止sql注入
                $sql = 'SELECT * FROM '.$this->_table." WHERE id=$id";

                return DB::findOne($sql);
            }
        }

        public function newsSubmit($data)
        {
            extract($data);
            if (empty($title) || empty($content)) {
                return 0;
            }

            $title = addslashes($title);
            $content = addslashes($content);
            $author = addslashes($author);
            $source = addslashes($source);
            $dateline = time();

            $data = array(
                'title' => $title,
                'content' => $content,
                'author' => $author,
                'source' => $source,
                'dateline' => $dateline,
            );

            if ($_POST['id'] != '') {
                DB::update($this->_table, $data, "id=$id");

                return 2;
            } else {
                DB::insert($this->_table, $data);

                return 1;
            }
        }

        public function findAllOrderByDateline()
        {
            $sql = 'SELECT * FROM '.$this->_table.' ORDER BY dateline DESC';

            return DB::findAll($sql);
        }

        public function delById($id)
        {
            return DB::del($this->_table, "id=$id");
        }
    }
