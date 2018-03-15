<?php
include "getLastLink.php";
$request = $_SERVER['REQUEST_URI'];

$check_link = explode('/', $request);

if (count($check_link) > 0 && $check_link[1] == 'COut') {
    $request_new = 'https://www.collectoffers.com/th'.$request;
    $url = getLastLink($request_new);
    echo $url;
    die;
}

if ($request == '/') {
    $content = file_get_contents('https://www.collectoffers.com/th');
    $link_presents = preg_match_all('/href\=\"javascript\:void\(0\)\;\".*?onclick=\"return ShowOfferInPopUp.*?\/th\/(.*?)\&R\=.*?\"/', $content, $result_2);
    $link_presents = $result_2[0];
    $ids = $result_2[1];

    $i = 0;
    foreach ($link_presents as $link_present) {
        $link_change = 'href="http://webgiamgia.net/' . $ids[$i] . '""';
        $content = str_replace($link_present, $link_change, $content);
        $i++;
    }
} else {
    $content = file_get_contents('https://www.collectoffers.com/th' . $request);
    if (empty($content)) {
        $content = file_get_contents('https://www.collectoffers.com/th');
        $link_presents = preg_match_all('/href\=\"javascript\:void\(0\)\;\".*?onclick=\"return ShowOfferInPopUp.*?\/th\/(.*?)\&R\=.*?\"/', $content, $result_2);
        $link_presents = $result_2[0];
        $ids = $result_2[1];

        $i = 0;
        foreach ($link_presents as $link_present) {
            $link_change = 'href="http://webgiamgia.net/' . $ids[$i] . '""';
            $content = str_replace($link_present, $link_change, $content);
            $i++;
        }
    } else {
        $link_changes = preg_match_all('/onclick=\"return ViewVoucherCodePopUp(.*?)th.*?\"/', $content, $result_2);
        $link_changes = array_unique($result_2[1]);
        $link = [];
        foreach ($link_changes as $link_change) {
            $link_change = explode(',',$link_change);

            if (count($link_change) > 1) {
                $o = str_replace(['#39;','(','&'],'',$link_change[0]);
                $m = str_replace(['#39;','(','&'],'',$link_change[2]);
                $lin = '<a href="/th/COut/?M='.$m.'&O='.$o.'"';
                $link[] = $lin;
            }
        };


        $link_fulls = preg_match_all('/<a.*?id=\"(.*?)\".*?onclick=\"return ViewVoucherCodePopUp(.*?)th.*?\"/', $content, $result_1);

        $link_fulls = array_unique($result_1[0]);
        $ids = array_unique($result_1[1]);

        $i = 0;
        foreach ($link_fulls as $link_full) {
            $j = $i / 3;
            $j = intval($j);
            if ($i % 3 == 0) {
                $link_new = $link[$j] . ' id="' . $ids[$i] . '"';
            } elseif ($i % 3 == 1) {
                $link_new = $link[$j] . ' id="' . $ids[$i] . '"' . ' class="btn btn-offers"';
            } else {
                $split = explode('&O=',$link[$j]);
                $check_request = explode('?O=',$request);
                if(count($check_request) > 0){
                    $link_j = '<a href="http://webgiamgia.net'.$check_request[0].'?O='.$split[1].'"';
                }else{
                    $link_j = '<a href="http://webgiamgia.net'.$request.'?O='.$split[1].'"';
                }
                $link_new = $link_j . ' id="' . $ids[$i] . '"' . ' class="deal-button"';
            }
            $content = str_replace($link_full, $link_new, $content);
            $i++;
        }
    }
}


$content = str_replace('https://www.collectoffers.com/th', 'http://webgiamgia.net/COut/', $content);
$content = str_replace('/th/COut/', 'http://webgiamgia.net/COut/', $content);
$content = str_replace('/th', 'https://www.collectoffers.com/th', $content);
$content = str_replace('img src="', 'img src="https://www.collectoffers.com/th/', $content);
$content = str_replace('a href="https://www.collectoffers.com/th/', 'a href="http://webgiamgia.net/', $content);
$content = str_replace('<a class="" href="https://www.collectoffers.com/th', '<a href="http://webgiamgia.net', $content);
$content = str_replace('<a class="btn btn-offers btn-big" target="_blank" rel="nofollow" href="https://www.collectoffers.com/th/', '<a class="btn btn-offers btn-big" target="_blank" rel="nofollow" href="http://webgiamgia.net/', $content);
$content = str_replace('https://www.collectoffers.com/th/deals', 'http://webgiamgia.net/deals', $content);

preg_match_all('/https\:\/\/clk.omgt3.com(.*?)\"/',$content,$link_tracks);
if(count($link_tracks) > 0){
    foreach ($link_tracks as $link_track){
        $link_track = str_replace('"','',$link_track);
        $link_track_new = getLastLink($link_track);
        $content = str_replace($link_track,$link_track_new,$content);
    }
}
preg_match_all('/http://invol.co/aff(.*?)\"/',$content,$link_tracks);
if(count($link_tracks) > 0){
    foreach ($link_tracks as $link_track){
        $link_track = str_replace('"','',$link_track);
        $link_track_new = getLastLink($link_track);
        $content = str_replace($link_track,$link_track_new,$content);
    }
}


echo $content;
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var btn_get_offer = $('a.btn-get-offer');
    $.each(btn_get_offer, function (key, value) {
        console.log(value);
    });
    $(document).ready(function () {

    });
    $('.merchant-share').css('display','none');
    $('#ContentPlaceHolder*_RptMerchantOffers_ctlMerchantOffer*_*_SpnCodeCover_*').css('display','none');

</script>


