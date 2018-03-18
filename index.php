<style>
    .logo{
        background-image: url(http://webgiamgia.net/style/img/logo.png)!important;
    }
</style>
<?php
require 'getLastLink.php';

class cURL
{
    var $headers;
    var $user_agent;
    var $compression;
    var $cookie_file;
    var $proxy;

    function cURL($cookies = TRUE, $cookie = 'cook.txt', $compression = 'gzip', $proxy = '')
    {
        $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
        $this->headers[] = 'Connection: Keep-Alive';
        $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $this->user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0';
// $this->user_agent = 'Mozilla/5.0 (Linux; Android 7.0; SM-G935P Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.92 Mobile Safari/537.36';
        $this->compression = $compression;
        $this->proxy = $proxy;
        $this->cookies = $cookies;
        if ($this->cookies == TRUE) $this->cookie($cookie);
    }

    function user_agent($user_agent)
    {
        $this->user_agent = $user_agent;
    }

    function cookie($cookie_file)
    {
        global $rootpath;
        if (file_exists($cookie_file)) {
            $this->cookie_file = $cookie_file;
        } else {
            $this->cookie_file = $cookie_file;
        }
    }

    function ref($url)
    {
        $this->referer = $url;
    }

    function get($url)
    {
        global $rootpath;
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if (!file_exists($this->cookie_file)) {
            @fopen($this->cookie_file, 'w');
            @fclose($this->cookie_file);
        }
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        if ($this->referer == TRUE) curl_setopt($process, CURLOPT_REFERER, $this->referer);
        curl_setopt($process, CURLOPT_ENCODING, $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 3000);
//if ($this->proxy) curl_setopt($cUrl, CURLOPT_PROXY, ‘proxy_ip:proxy_port’);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function post($url, $data)
    {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        if ($this->referer == TRUE) curl_setopt($process, CURLOPT_REFERER, $this->referer);
        curl_setopt($process, CURLOPT_ENCODING, $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        if ($this->proxy) curl_setopt($process, CURLOPT_PROXY, $this->proxy);
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_POST, 1);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function error($error)
    {
        echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
        die;
    }
}



$request = $_SERVER['REQUEST_URI'];
$cc = new cURL();




$link = 'https://iprice.co.id'.$request;
$html = $cc->get($link);

preg_match('/\/r\/.*?\/\?\_id\=(.*?)$/',$request,$check);
if(count($check) == 2){
    $last_link = getLastLink($link);
    if($last_link != ''){
        echo $last_link;
        die;
    }else{
        $link = 'https://iprice.co.id'.$check[0];
        $html = file_get_contents($link);
        preg_match('/url=(.*?)%3Fsource/',$html,$result);
        if($result[1] != ''){
            preg_match('/url=(.*?)$/',$result[1],$last_link);
            $last_link = $last_link[1];
            echo $last_link;
            die;
        }
    };
}
$html = str_replace('','',$html);
$html = str_replace('https://iprice.co.id','http://webgiamgia.net',$html);
$html = str_replace('iPrice','Webgiamgia',$html);
echo $html;

?>