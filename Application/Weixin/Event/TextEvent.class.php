<?php
/**
 * Created by Green Studio.
 * File: TextEvent.class.php
 * User: TianShuo
 * Date: 14-2-25
 * Time: 下午8:33
 */

namespace Weixin\Event;


use Weixin\Controller\WeixinCoreController;

/**
 * Class TextEvent
 * @package Weixin\Event
 */
class TextEvent extends WeixinCoreController
{

    /**
     * @param $keyword
     * @return string
     */
    public function wechat($keyword)
    {

        $contentStr = '您的留言我们已经收到';
        return $contentStr;

    }

    /**
     * @param $keyword
     * @return mixed
     */
    public function weather($keyword)
    {
        $resultStr = "";
        if ($keyword == "") {
            $keyword = "南京";
            $resultStr .= "没有指定城市，默认显示南京";
        }
        $apihost = "http://api2.sinaapp.com/";
        $apimethod = "search/weather/?";
        $apiparams = array(
            'appkey'    => "0020120430",
            'appsecert' => "fa6095e113cd28fd",
            'reqtype'   => "text"
        );
        $apikeyword = "&keyword=" . urlencode($keyword);
        $apicallurl = $apihost . $apimethod . http_build_query($apiparams) . $apikeyword;
        $weatherJson = file_get_contents($apicallurl);
        $weather = json_decode($weatherJson, true);
        $contentStr = $weather ['text'] ['content'];

        return $contentStr;
    }


    /**
     * @param $position
     * @return mixed
     */
    public function poi($position)
    {

        $url = 'http://api.map.baidu.com/geocoder/v2/?ak=96a6bf4739da4e7c5bf6e916ff1ad51c';

        $location = $position['Location_X'] . ',' . $position['Location_Y'];
        $infourl = $url . '&location=' . $location . '&output=json&pois=1';
        $JsonInfo = file_get_contents($infourl);
        $poiInfo = json_decode($JsonInfo, true);
        $city = $poiInfo['result']['addressComponent']['city'];
        $length = mb_strlen($city, 'UTF8') - 1;
        $city = mb_substr($city,
            0, $length, 'UTF8');

        $contentStr = $this->weather($city);

        return $contentStr;

    }


}