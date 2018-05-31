<?php
namespace app\admin\controller;

use core\Controller;

class Common extends Controller{

    public function __construct()
    {
        //判断用户是否登录,如果存在session中的username,代表登录成功,不存在,哪里都不准去,去登录
        if (!isset($_SESSION['username'])){
            die($this->redirect('index.php?s=admin/login/loginForm')->message('兄die,我这里不是谁都能来的!'));
        }
    }


}








?>