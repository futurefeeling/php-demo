<?php
    /**
     * 后台控制器.
     */
    class adminController
    {
        public $auth = '';

        public function __construct()
        {
            // 判断是否登录
            // 如果不是登录页并且没有登录，跳到登录页
            $authobj = M('auth');
            $this->auth = $authobj->getAuth();

            if (empty($this->auth) && (FARZER::$method != 'login')) {
                $this->showmessage('请登录后再操作', 'admin.php?controller=admin&method=login');
            }
        }

        public function login()
        {
            if ($_POST) {
                // 登录处理
                // 登录处理的业务逻辑放到adminModel authModel
                // adminModel: 从数据库取用户信息
                // authModel: 进行信息核对
                $this->checkLogin();
            } else {
                VIEW::display('admin/login.html');
            }
        }

        public function logout()
        {
            $authobj = M('auth');
            $authobj->logout();
            $this->showmessage('退出成功', 'admin.php?controller=admin&method=login');
        }

        public function index()
        {
            $newsobj = M('news');
            $newsnum = $newsobj->count();

            VIEW::assign(array(
                'newsnum' => $newsnum,
                'login' => true,
                'location' => 'index'
            ));
            VIEW::display('admin/index.html');
        }

        private function checkLogin()
        {
            $authobj = M('auth');
            if ($authobj->loginsubmit()) {
                $this->showmessage('登录成功', 'admin.php?controller=admin&method=index');
            } else {
                $this->showmessage('登录失败', 'admin.php?controller=admin&method=login');
            }
        }

        public function newsadd()
        {
            // 判断是否有post数据,如果没有显示主界面
            if (empty($_POST)) {
                // 读取就信息，需要传递id $_GET['id'],即如果$_GET['id']不为空说明是修改
                if (isset($_GET['id'])) {
                    $data = M('news')->getNewsInfo($_GET['id']);
                } else {
                    $data = array();
                }
                VIEW::assign(array(
                    'data' => $data,
                    'login' => true,
                    'location' => 'newsadd'
                ));
                VIEW::display('admin/newsadd.html');
            } else {
                $this->newsSubmit();
            }
        }

        public function newsdel()
        {
            if (intval($_GET['id'])) {
                M('news')->delById($_GET['id']);
                $this->showmessage('删除成功', 'admin.php?controller=admin&method=newslist');
            }
        }

        public function newslist()
        {
            $newsobj = M('news');
            $data = $newsobj->findAllOrderByDateline();
            VIEW::assign(array(
                'data' => $data,
                'login' => true,
                'location' => 'newslist'
            ));
            VIEW::display('admin/newslist.html');
        }

        public function showmessage($str, $href)
        {
            echo "<script>alert('$str');window.location.href='$href';</script>";
        }

        private function newsSubmit()
        {
            $result = M('news')->newsSubmit($_POST);
            switch ($result) {
                case 0:
                    $this -> showmessage('操作失败', 'admin.php?controller=admin&method=newsadd&id'.$_POST['id']);
                    break;
                case 1:
                    $this -> showmessage('添加成功', 'admin.php?controller=admin&method=newslist');
                    break;
                default:
                    $this -> showmessage('修改成功', 'admin.php?controller=admin&method=newslist');
                    break;
            }
        }
    }
