<?php

if (!function_exists('http_post')) {

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @param boolean $post_file 是否文件上传
     * @return string content
     */
    function http_post($url, $param, $post_file = false)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param) || $post_file) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

}

if (!function_exists('http_get')) {

    /**
     * GET 请求
     * @param string $url
     */
    function http_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

}

if (!function_exists('current_date')) {
    function current_date()
    {
        return date('Y-m-d H:i:s');
    }
}

if (!function_exists('echoText')) {

    /**
     * 输出Text
     * @param type $arr
     * @return boolean
     */
    function echoText($arr)
    {
        header('Content-Type: text/plain; charset=utf-8');
        if (strpos(PHP_VERSION, '5.3') > -1) {
            // php 5.3-
            echo json_encode($arr);
        } else {
            // php 5.4+
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        }
        return true;
    }

}

if (!function_exists('echoMsg')) {

    /**
     * 输出JSON消息
     * @param type $code
     * @param type $msg
     * @return type
     */
    function echoMsg($code, $msg = '')
    {
        return echoJson(array(
            'ret_code' => $code,
            'ret_msg' => $msg
        ));
    }

}

if (!function_exists('echoSuccess')) {

    /**
     * 输出成功JSON消息
     * @param string $msg
     */
    function echoSuccess($msg = 'success')
    {
        echoMsg(0, $msg);
    }

}

if (!function_exists('dumpSuccess')) {

    /**
     * 输出成功JSON消息
     * @param string $msg
     */
    function dumpSuccess($msg = 'success')
    {
        $param['code'] = 0;
        $param['list'] = $msg;
        echoJson($param);
    }

}


if (!function_exists('dumpFail')) {

    /**
     * 输出成功JSON消息
     * @param string $msg
     */
    function dumpFail($msg = 'Fail')
    {
        $param['code'] = -1;
        $param['list'] = $msg;
        echoJson($param);
    }

}

if (!function_exists('echoFail')) {

    /**
     * 输出失败JSON消息
     * @param string $msg
     */
    function echoFail($msg = 'failed')
    {
        echoMsg(-1, $msg);
    }

}

if (!function_exists('echoJson')) {

    /**
     * 输出Json
     * @param type $arr
     * @return boolean
     */
    function echoJson($arr)
    {
        header('Content-Type: application/json; charset=utf-8');
        if (strpos(PHP_VERSION, '5.3') > -1) {
            // php 5.3-
            echo json_encode($arr);
        } else {
            // php 5.4+
            echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        }
        return true;
    }

}

if (!function_exists('toJson')) {

    /**
     * 数组转JSON
     * @param type $arr
     * @return type
     */
    function toJson($arr)
    {
        return print_r(json_encode($arr), true);
    }

}

if (!function_exists('dd')){
    function dd($var)
    {
        header("Content-Type:text/html;charset=gbk");
        if (is_bool($var)) {
            var_dump($var);
        } else if (is_null($var)) {
            var_dump(NULL);
        } else {
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
        }
        die;
    }
}

if (!function_exists('p')){
    function p($var)
    {
        header("Content-Type:text/html;charset=gbk");
        if (is_bool($var)) {
            var_dump($var);
        } else if (is_null($var)) {
            var_dump(NULL);
        } else {
            echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
        }
    }
}
