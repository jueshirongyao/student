<?php
namespace app\admin\controller;

use core\Controller;
use core\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use system\model\User;

class Login extends Controller {

    public function loginForm(){
        if ($_POST){
            //获取post数据
            $post = $_POST;
            //判断验证码是否正确
            if($_SESSION['code'] != $post['code']){
                return $this->redirect()->message('验证码输入错误');
            }
            //判断数据库中是否有当前填写的账号和密码的数据,如果有,代表登录是成功的,如果没有,代表登录失败
                $userInfo = User::where('username = "'.$post['username'].'" and password = "'.md5($post['password']) . '"')->get()->toArray();
            if ($userInfo){
                //判断用户是否勾选remember me,如果勾选了,会有autologin字段值,如果没勾选,就没有
                //如果勾选了,就可以在cookie中存一个7天有效期的值
                if (isset($post['autologin'])){
                    //存cookie
                    setcookie(session_name(),session_id(),time() + 7*24*3600,'/');
                }
                //将用户的名称和id存入session中
                $_SESSION['username'] = $userInfo[0]['username'];
                $_SESSION['uid'] = $userInfo[0]['id'];
                //登录成功
                return $this->redirect('index.php?s=admin/entry/index')->message('登录成功');
            }else{
                return $this->redirect()->message('账号或者密码输入错误');
            }

        }
        //加载后台登录模板
        return View::make();
    }

    /**
     * 生成验证码
     */
    public function code(){
        $phraseBuilder = new PhraseBuilder(4,'0');
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        $_SESSION['code'] = $builder->getPhrase();
    }

    public function logout(){
        //清楚session
        session_unset();
        session_destroy();
        //提示退出成功并跳转去登录
        return $this->redirect('index.php?s=admin/login/loginForm')->message('退出成功');
    }


}















?>