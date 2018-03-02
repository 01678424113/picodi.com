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


$content = file_get_contents('https://promotions.co.th/coupon/stores/lazada');
$link_coupons = preg_match_all('/<a.*?href\=\"(.*?)\".*?id\=\"coupon-link-(.*?)\".*?>/',$content,$result);

array_shift($result[1]);
array_shift($result[2]);
$link_coupons = $result[1];
$id_coupons = $result[2];
$last_link = [];
$i = 0;
foreach ($link_coupons as $link_coupon){
    $link_coupon = str_replace('https://promotions.co.th/coupon/coupon','https://promotions.co.th/coupon/go',$link_coupon);
    $last_link[] = getLastLink($link_coupon.'/'.$id_coupons[$i]);
    $i++;
}
echo $content;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


