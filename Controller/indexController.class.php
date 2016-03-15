<?php

    /**
     *	前台入口
     */
    class indexController
    {
        public function index()
        {
            $data = $this->getIndexData();
            $this->showAbout();
            VIEW::assign(array('data' => $data));
            VIEW::display('client/index.html');
        }

        public function newsDetail()
        {
            $data = $this->getNewsDetailData();
            $this->showAbout();
            VIEW::assign(array('data'=>$data));
            VIEW::display('client/post.html');
        }

        private function showAbout()
        {
            $data = M('about')->aboutInfo();
            VIEW::assign(array('about' => $data));
        }

        /**
         * 获取前台首页需要的数据
         * @return array 一个包含前台渲染页面需要的数据的数组
         */
        public function getIndexData()
        {
            return M('news')->getNewsList();
        }

        /**
         * 获取新闻详情的数据
         * @return array 一个包含新闻详情渲染页面需要的数据的数组
         */
        public function getNewsDetailData()
        {
            $id = intval($_GET['id']);
            return M('news')->getNewsInfo($id);
        }

    }
