<?php
include "getLastLink.php";


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


$link = 'https://www.offers.vn' . $request;
$html = $cc->get($link);

$check_link = explode('?url=', $request);
if (count($check_link) > 1) {
    $last_link = $check_link[1];
    echo $last_link;
    die;
}
$check_link_2 = explode('out', $request);
if (count($check_link_2) > 1) {
    $last_new = 'https://www.offers.vn' . $request;
    $last_link_2 = getLastLink($last_new);
    echo $last_link_2;
    die;
}

$html = str_replace('https://www.offers.vn', 'http://webgiamgia.net', $html);
$html = str_replace('Offers.vn', 'Webgiamgia.net', $html);
$html = str_replace('http://webgiamgia.net/file', 'https://www.offers.vn/file', $html);

preg_match_all('/window\.open\(\'(.*?)\'/', $html, $link_access_trades);
$link_access_trades = $link_access_trades[1];
preg_match_all('/window\.open\(\'.*?url\=(.*?)\'/', $html, $link_checks);
$link_checks = $link_checks[1];
if (count($link_checks) == 0) {
    preg_match_all('/window\.open\(\'.*?url(.*?)offer\_id/', $html, $link_checks);
    $link_checks = $link_checks[1];
}
$i = 0;
foreach ($link_checks as $link_check) {
    $link_check = 'http://webgiamgia.net?url=' . $link_check;
    $html = str_replace($link_access_trades[$i], $link_check, $html);
    $i++;
}

preg_match_all('/https\:\/\/fast.accesstrade.com.vn\/deep\_link\/.*?url=(.*?)\"/', $html, $link_check_2s);
$i = 0;
foreach ($link_check_2s[1] as $link_content) {
    $link_content = 'http://webgiamgia.net?url=' . $link_content;
    $link_need_change = str_replace('"', '', $link_check_2s[0][$i]);
    $html = str_replace($link_need_change, $link_content, $html);
    $i++;
}


echo $html;

?>