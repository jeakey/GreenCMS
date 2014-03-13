<?php
/**
 * Created by Green Studio.
 * File: MenuController.php
 * User: TianShuo
 * Date: 14-2-20
 * Time: 下午5:37
 */

namespace Weixin\Controller;

use Weixin\Event\MenuEvent;

class MenuController extends WeixinBaseController
{
    public function index()
    {
        $Menu = new MenuEvent();
        $Weixin_menu_decode = json_decode(trim(C('Weixin_menu')), true);
        $Weixin_menu_decode=$Weixin_menu_decode['button'];
        dump($Weixin_menu_decode);


        $this->display();
    }

    public function del()
    {
        $Menu = new MenuEvent();
        $Menu->delete();
    }

    public function restore()
    {
        $Menu = new MenuEvent();
        $Menu->restore();
    }

    public function sync()
    {
        $Menu = new MenuEvent();


     }


    public function advance()
    {
        $this->display();

    }

}