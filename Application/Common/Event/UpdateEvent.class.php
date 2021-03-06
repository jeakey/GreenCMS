<?php
/**
 * Created by Green Studio.
 * File: UpdateEvent.class.php
 * User: TianShuo
 * Date: 14-3-17
 * Time: 下午9:18
 */

namespace Common\Event;

use Common\Util\File;

/**
 * 升级事件
 * Class UpdateEvent
 * @package Common\Event
 */
class UpdateEvent {

    /**
     *
     */
    public function check(){


        $software_build = get_opinion('software_build', true);
        $url = Server_API . 'api/update/' . $software_build . '/';
        $json = json_decode(file_get_contents($url), true);

         if($json['lastest_version']>$json['user_version']){
            return $json;
        }else{
            return false;
        }

    }
}