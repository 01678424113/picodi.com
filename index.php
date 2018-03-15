<?php
function get_menu_lazada()
{
    $html = file_get_contents('https://www.lazada.vn/');
    preg_match_all('/<a href=\/\/(.*?)>/', $html, $result);
    $link_menu = [];
    for ($i = 6; $i < count($result[1]); $i++) {
        $link_menu[] = $result[1][$i];
    }
    return $link_menu;
}

function get_product($url)
{
    while (1) {
        $html = file_get_contents($url);
        if (!empty($html)) {
            break;
        }
    }
    preg_match_all('/\"productUrl\"\:\"\/\/(.*?)\"/', $html, $result);
    $link_product = array_unique($result[1]);
    return $link_product;
}

$link_menu = get_menu_lazada();
foreach ($link_menu as $item) {
    //Day la duong dan cua menu con
    $item = 'https://' . $item;
    $link_product_full = [];
    for ($i = 1; $i < 10; $i++) {
        $item = $item . '/?page=' . $i;
        $link_product = get_product($item);
        if (count($link_product) < 1) {
            break;
        }
        //Day la tat ca cac link san pham cua 1 menu con
        $link_product_full = array_merge($link_product_full, $link_product);
    }
}