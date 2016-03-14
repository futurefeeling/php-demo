<?php
    /**
     * 用户信息核对.
     */
    class authModel
    {
        private $auth = ''; // 当前管理员信息

        public function __construct()
        {
            if (isset($_SESSION['auth']) && (!empty($_SESSION['auth']))) {
                $this->auth = $_SESSION['auth'];
            }
        }

        /**
         * 登录验证
         *
         * @return bool 登录验证结果
         */
        public function loginSubmit()
        {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                return false;
            }
            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);

            if ($this->auth = $this->checkUser($username, $password)) {
                $_SESSION['auth'] = $this->auth;

                return true;
            } else {
                return false;
            }
        }

        private function checkUser($username, $password)
        {
            $adminobj = M('admin');
            $auth = $adminobj->findOneByUsername($username);

            if ((!empty($auth)) && ($auth['password'] == $password)) {
                return $auth;
            } else {
                return false;
            }
        }

        public function getAuth()
        {
            return $this->auth;
        }

        public function logout()
        {
            unset($_SESSION['auth']);
            $this->auth = '';
        }
    }
