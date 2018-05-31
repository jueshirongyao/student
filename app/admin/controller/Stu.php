<?php
namespace app\admin\controller;

use core\model\Model;
use core\view\View;
use system\model\Grade;
use system\model\Stu as s;
class Stu extends Common
{


    //学生管理列表
    public function index()
    {
        //获取所有学生数据
//        $stu = s::get()->toArray();
        //因为需要展示班级名称,所以单独取学生数据不够,这个时候需要自己写sql语句,调用框架提供的query方法来执行自己的sql语句
        $sql = "select stu.*,grade.gname from stu join grade on stu.gid = grade.id";
        $stu = s::query($sql)->toArray();
        //加载学生列表模板
        return View::make()->with('stu', $stu);
    }


    //加载添加学生模板方法
    public function create()
    {
        //获取所有班级数据
        $grade = Grade::get()->toArray();
        //加载添加学生模板
        return View::make()->with('grade', $grade);
    }


    //处理学生添加
    public function add()
    {
        //获取post数据
        $post = $_POST;
        //将post数据交给框架的add方法,添加到stu表中
        $result = s::add($post);
        //判断$result是否为真,如果为真,代表添加成功,如果为假,代表添加失败
        if ($result) {
            return $this->redirect('index.php?s=admin/stu/index')->message('添加成功');
        } else {
            return $this->redirect()->message('添加失败');
        }
    }

    public function edit()
    {

        //获取所有班级数据并分配
        $grade = Grade::get()->toArray();
        //获取需要修改的学生id
        $id = $_GET['id'];
        //通过$id找到对应学生的数据
        $stu = s::find($id)->toArray();
        if ($_POST) {
            //获取post数据
            $post = $_POST;
            //调用框架提供的edit方法来修改学生数据
            $result = s::edit($post);
            if ($result) {
                return $this->redirect('index.php?s=admin/stu/index')->message('修改成功');
            } else {
                return $this->redirect()->message('修改失败');
            }
        }
        //加载编辑学生模板,分配需要修改的学生数据
        return View::make()->with('stu', $stu)->with('grade', $grade);
    }


    // 删除学生数据
    public function delete()
    {
        //获取get参数中的需要删除的学生id
        $id = $_GET['id'];
        //根据自己框架开发的逻辑原理进行删除
        $result = s::delete($id);
        //判断$result是否为真,如果为真,代表删除成功,如果为假,代表删除失败
        if ($result) {
            return $this->redirect('index.php?s=admin/stu/index')->message('删除成功');
        } else {
            return $this->redirect()->message('删除失败');
        }
    }
}
?>