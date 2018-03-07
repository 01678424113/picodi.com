<?php

function getLastLink($url)
{
    $header = get_headers($url);
    $header = implode(" ", $header);
    $location = preg_match('/Location:\s(.*?)\sCache-Control/', $header, $result);
    $last_link = '';
    if(count($result) > 0){
        $last_link = $result[1];
    }
    return $last_link;
}
$request = $_SERVER['REQUEST_URI'];
if($request == '/'){
    $content = file_get_contents('https://promotions.co.th/coupon/stores/lazada');
}else{
    $content = file_get_contents('https://promotions.co.th/'.$request);
    if($content == ''){
        echo $request;
    }
}
$link_coupons = preg_match_all('/<a.*?href=\"https\:\/\/promotions.co.th\/coupon\/go(.*?)\".*?id=\"coupon-link-(.*?)\".*?class=\"coupon-code-link\".*?target=\"\_blank\".*?data-clipboard-text=\".*?\"><span>.*?<\/span><\/a>/',$content,$result);

$link_coupons = $result[1];
$id_coupons = $result[2];
$last_link = [];
$i = 0;
foreach ($link_coupons as $link_coupon){
    $link_coupon = 'https://promotions.co.th/coupon/go'.$link_coupons[$i];
    $last_link = getLastLink($link_coupon);
    $last_link = 'http://webgiamgia.net/'.str_replace('http://','',$last_link);
    $content = str_replace($link_coupon,$last_link,$content);
    $i++;
}
echo $content;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


