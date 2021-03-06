<?php
/**
 * Created by Green Studio.
 * File: HomeController.class.php
 * User: TianShuo
 * Date: 14-2-20
 * Time: 下午5:05
 */

namespace Weixin\Controller;


class HomeController extends WeixinBaseController
{
    public function index()
    {
        $this->display();
    }

    public function changePass()
    {
        $this->display();
    }

    public function changePassHandle()
    {
        $User = D('User', 'Logic');
        $User->user_id = (int)$_SESSION [C('USER_AUTH_KEY')];
        $User->user_pass = encrypt($_POST['password']);

        if ($User->save()) {
            $this->success('密码修改成功', U("Admin/Login/logout"), false);
        } else {
            $this->error('密码修改失败');
        }
    }

}