<?php
/**
 * Created by Green Studio.
 * File: PostController.class.php
 * User: TianShuo
 * Date: 14-1-23
 * Time: 下午5:02
 */

namespace Home\Controller;
use Common\Logic\PostsLogic;
use Common\Util\File;

/**
 * 文章控制器
 * Class PostController
 * @package Home\Controller
 */
class PostController extends HomeBaseController
{

    /**
     * 文章单页显示 支持年月日限定
     * @param $info 指定单页的信息
     */
    public function single($info = -1)
    {

        $map['post_date'] = array('like', I('get.year', '%') . '-' . I('get.month', '%') . '-' . I('get.day', '%') . '%');
        $map['post_type'] = 'single';

        $Posts = new PostsLogic();
        $post_res = $Posts->detail($info, true, $map);

        $Posts->viewInc($post_res['post_id']); //浏览计数
        $this->if404($post_res, "非常抱歉，你需要的文章暂时不存在，可能它已经躲起来了。.");

        $this->assign('post', $post_res); // 赋值数据集

        if (File::file_exists(T('Home@Post/' . $post_res['post_template']))) {
            $this->display($post_res['post_template']);
        } else {
            $this->display('single');
        }


    }

    /**
     * 页面单页显示 支持年月日限定
     * @param $info
     */
    public function page($info = -1)
    {
        $map['post_date'] = array('like', I('get.year', '%') . '-' . I('get.month', '%') . '-' . I('get.day', '%') . '%');
        $map['post_type'] = 'page';

        $Posts = new PostsLogic();
        $post_res = $Posts->detail($info, true, $map);
        $this->if404($post_res, "非常抱歉，你需要的页面暂时不存在，可能它已经躲起来了。.");

        $Posts->viewInc($post_res['post_id']);

        $this->assign('post', $post_res); // 赋值数据集
        if (File::file_exists(T('Home@Post/' . $post_res['post_template']))) {

            $this->display($post_res['post_template']);
        } else {
            $this->display('page');
        }
    }

    /**
     * 未知类型单页显示 支持年月日限定
     * @param $method 魔术方法名称 即文章类型
     * @param $args
     */
    public function _empty($method, $args)
    {
        //TODO 通用模板机制

        $Posts = new PostsLogic();

        $info = I('get.info');

        $post_res = $Posts->detail($info, true);
        $Posts->viewInc($post_res['post_id']);

        $this->assign('post', $post_res); // 赋值数据集

        if (File::file_exists(T('Home@Post/' . $post_res['post_template']))) {

            $this->display($post_res['post_template']);
        } else {

            //TODO   这里怎么处理却决于你自己了。
            $this->error404('缺少对应的模版而不能显示');
            //  $this->display('single');
        }

        // $this->display($post_res['post_type']);


    }


}