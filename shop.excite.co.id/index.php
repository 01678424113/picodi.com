<?php
require 'getLastLink.php';
$request = $_SERVER['REQUEST_URI'];

$check = explode('trackst',$request);
if (count($check)>1){
    $link_aff = 'https://aft.excite.co.id'.$request;
    $lats_link = getLastLink($link_aff);
    echo $lats_link;
    die;
}

$html =file_get_contents('https://shop.excite.co.id'.$request);


$html = str_replace('href="https://shop.excite.co.id/','href="http://webgiamgia.net/',$html);
$html = str_replace('Excite','Webgiamgia.net',$html);
$html = str_replace(['https://image.excite.co.id/shop/images/exciteshop_logo.png','https://image.excite.co.id/shop/images/excitepoint_logo.png'],'http://webgiamgia.net/style/img/logo.png',$html);
$html = str_replace('https://aft.excite.co.id','http://webgiamgia.net',$html);
$html = str_replace('<div class="bb1"><h2 style="font-size: 22px">Tentang Agoda</h2></div>
                                	<div class="mb20 bb1"><img src="https://excite-point.s3-ap-southeast-1.amazonaws.com/Affiliates/1017_59d30f956730a_agoda2-min.png" class="img-responsive center-block" alt="" /></div>
                                <div class="bb1"><p><i class="fa fa-external-link"></i> <b>Situs Resmi:</b> <a href=https://shop.excite.co.id/store/storedetail/?ai=22&n=agoda target="_blank">Agoda</a></p></div>
','',$html);

echo $html;