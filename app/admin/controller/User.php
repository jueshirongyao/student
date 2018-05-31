<?php
namespace app\admin\controller;

use core\Controller;
use core\view\View;
use system\model\User as u;
class User extends Common {

    /**
     *
     * 加载修改密码模板方法
     *
     * @return mixed
     */
    public function changePassword(){
        //加载修改密码模板
        return View::make();
    }

    /**
     * 处理修改密码方法
     */
    public function password(){
        //接收post数据
        $post = $_POST;
        //先判断两次密码是否相同,如果不相同,返回并提示
        if ($post['password'] != $post['password2']){
            return $this->redirect()->message('两次密码输入不一致!!');
        }
        //如果两次密码相同,我们再去数据库中找当前已经登录的用户的数据
        $userInfo = u::find($_SESSION['uid'])->toArray();
        //判断用户输入的原密码是否和数据库中的密码相同
        if (md5($post['oldPassword']) != $userInfo['password']){
            return $this->redirect()->message('原密码输入错误!!');
        }
        //如果在严谨一点,可以判断新密码的位数是否满足6-20位,如果小于6位,或者大于20位,也不能进行修改
        if (strlen($post['password']) > 20 || strlen($post['password']) < 6){
            return $this->redirect()->message('新密码的长度要再6-20位之间!!');
        }
        //修改当前用户的密码,并退出登录
        $data = [
            'password' => md5($post['password']),
        ];
        $result = u::edit($data);
        if ($result){
            return $this->redirect('index.php?s=admin/login/logout')->message('密码修改成功,请重新登录');
        }else{
            return $this->redirect()->message('密码修改失败!!请检查');
        }
    }

}

?>