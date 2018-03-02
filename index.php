<?php
include "getLastLink.php";
$request = $_SERVER['REQUEST_URI'];

$check_link = explode('/', $request);
if (count($check_link) > 0 && $check_link[1] == 'COut') {
    $url = getLastLink($request);
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
            $result_3 = explode('&#39;', $link_change);
            $check = explode('O=', $request);
            if (count($check) > 1) {
                $link[] = '<a href="http://webgiamgia.net' . $check[0] . 'O='.$result_3[1].'"';
            } else {
                $link[] = '<a href="http://webgiamgia.net' . $request . '?O=' . $result_3[1] . '"';
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
                $link_new = $link[$j] . ' id="' . $ids[$i] . '"' . ' class="deal-button has-code"';
            }
            $content = str_replace($link_full, $link_new, $content);
            $i++;
        }
    }
}


$content = str_replace('https://www.collectoffers.com/th', 'http://webgiamgia.net/COut/', $content);
$content = str_replace('/th/COut/', 'http://webgiamgia.net/COut/', $content);
$content = str_replace('/th', 'https://www.collectoffers.com/th', $content);
$content = str_replace('img src="', 'img src="https://www.collectoffers.com/th', $content);
$content = str_replace('a href="https://www.collectoffers.com/th/', 'a href="http://webgiamgia.net/', $content);
$content = str_replace('<a class="" href="https://www.collectoffers.com/th', '<a href="http://webgiamgia.net/', $content);
$content = str_replace('<a class="btn btn-offers btn-big" target="_blank" rel="nofollow" href="https://www.collectoffers.com/th/', '<a class="btn btn-offers btn-big" target="_blank" rel="nofollow" href="http://webgiamgia.net/', $content);
$content = str_replace('<li><a href="http://webgiamgia.net/deals/on+sale/-/co-o1">On Sale</a></li>', '', $content);

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

</script>


