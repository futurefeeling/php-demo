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

            if (empty($this->auth) && (FARZER::$method!='login')) {
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
                $this -> checkLogin();
            } else {
                VIEW::display("admin/login.html");
            }
        }

        public function logout()
        {
            $authobj = M('auth');
            $authobj -> logout();
            $this -> showmessage('退出成功', 'admin.php?controller=admin&method=login');
        }

        public function index()
        {
            $newsobj = M('news');
            $newsnum = $newsobj -> count();

            VIEW::assign(array('newsnum' => $newsnum));
            VIEW::display('admin/index.html');
        }

        private function checkLogin()
        {
            $authobj = M('auth');
            if ($authobj->loginsubmit()) {
                $this->showmessage('登录成功', 'admin.php?controller=admin&method=index');
            } else {
                echo "fail";
                exit;
                $this->showmessage('登录失败', 'admin.php?controller=admin&method=login');
            }
        }

        public function showmessage($str, $href)
        {
            echo "<script>alert('$str');window.location.href='$href';</script>";
        }
    }
?>
