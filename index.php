<?php
function get_last_link($url)
{
    $web = file_get_contents("$url");
    $web = str_replace("<script>", '', $web);
    preg_match('/couponUrl = \'(.*?)\'/', $web, $result);
    preg_match('/url=(.*?)$/', $result[1], $result2);
    $last_link = str_replace("%3A", ":", $result2[1]);
    $last_link = str_replace("%2F", "/", $last_link);
    return $last_link;
}

?>

<?php


$request_url = $_SERVER['REQUEST_URI'];
if ($request_url == '/') {
    header("Location: http://webgiamgia.net/vn");
}
$content = file_get_contents('https://www.picodi.com/vn' . $request_url);
if ($content == '') {
    $content = file_get_contents('https://www.picodi.com' . $request_url);
}

$pattern = '/(https\:\/\/metric.picodi.net\/vn\/r\/[0-9]+)/';
preg_match_all($pattern, $content, $match);
if (count($match) > 0) {
    foreach ($match[1] as $item) {
        $last_link = get_last_link($item);
        $content = str_replace($item, $last_link, $content);
    }
}
//Delete blank web
$content = str_replace("type-code", "type-code-new", $content);
$content = str_replace("type-promo", "type-promo-new", $content);
$content = str_replace("type-coupon", "type-coupon-new", $content);

$content = str_replace("https://www.picodi.com", "http://webgiamgia.net/vn", $content);
$content = str_replace("Picodi.com", "Webgiamgia.net", $content);
$content = str_replace("Picodi", "Webgiamgia.net", $content);
$content = str_replace("https://cdn2.picodi.com/vn/bundles/view/img/logo-white.svg", "http://webgiamgia.net/style/img/logo.png", $content);
$content = str_replace("https://cdn2.picodi.com/vn/bundles/view/img/logo_svg.svg", "http://webgiamgia.net/style/img/logo.png", $content);
$content = str_replace("https://metric.picodi.net/vn", "http://webgiamgia.net/vn", $content);

$old_menu = "<ul class=\"dropdown-menu main-nav_dropdown is-category lazy-loader\" id=\"categoryDropdown\"></ul>";
$new_menu = "<ul class=\"dropdown-menu main-nav_dropdown is-category\" id=\"categoryDropdown\"><li><a href=\"/vn/category/electronics\"><i class=\"icon icon-electronics\"></i><span>Thiết bị điện tử</span></a></li><li><a href=\"/vn/category/health-and-beauty\"><i class=\"icon icon-healthandbeauty\"></i><span>Sức khỏe &amp; Làm đẹp</span></a></li><li><a href=\"/vn/category/hosting\"><i class=\"icon icon-hosting\"></i><span>Web hosting</span></a></li><li><a href=\"/vn/category/jewelery\"><i class=\"icon icon-jewelery\"></i><span>Trang sức</span></a></li><li><a href=\"/vn/category/shoes\"><i class=\"icon icon-shoes\"></i><span>Giày dép</span></a></li><li><a href=\"/vn/category/fashion\"><i class=\"icon icon-fashion\"></i><span>Thời trang</span></a></li><li><a href=\"/vn/category/books\"><i class=\"icon icon-books\"></i><span>Sách</span></a></li><li><a href=\"/vn/category/sport\"><i class=\"icon icon-sport\"></i><span>Thể thao</span></a></li><li><a href=\"/vn/category/baby\"><i class=\"icon icon-baby\"></i><span>Trẻ nhỏ</span></a></li><li><a href=\"/vn/category/travel-and-transport\"><i class=\"icon icon-travelandtransport\"></i><span>Du lịch &amp; Vận tải</span></a></li><li><a href=\"/vn/category/airline\"><i class=\"icon icon-airline\"></i><span>Hàng không</span></a></li><li><a href=\"/vn/category/food\"><i class=\"icon icon-food\"></i><span>Thực phẩm</span></a></li><li><a href=\"/vn/category/restaurant\"><i class=\"icon icon-restaurant\"></i><span>Nhà hàng ăn</span></a></li><li><a href=\"/vn/category/eyewear\"><i class=\"icon icon-glasses\"></i><span>Kính mắt</span></a></li><li><a href=\"/vn/category/consumer-electronics\"><i class=\"icon icon-mobilehardware\"></i><span>Thiết bị điện tử dân dụng</span></a></li><li><a href=\"/vn/category/ecommerce-platform\"><i class=\"icon icon-ecommerceplatform\"></i><span>Nền tảng Thương mại Điện tử</span></a></li><li><a href=\"/vn/category/multi\"><i class=\"icon icon-multi\"></i><span>Cửa hàng bách hóa</span></a></li><li><a href=\"/vn/category/watches\"><i class=\"icon icon-watches\"></i><span></span></a></li></ul>";
$content = str_replace($old_menu, $new_menu, $content);

$old_store = "<ul class=\"brand-list\" id=\"shopDropdown\"></ul>";
$new_store = "<ul class=\"brand-list\" id=\"shopDropdown\"><li><a href=\"/vn/lazada\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/lazada_2_001.png?v=1490266701\" alt=\"Lazada những sự giảm giá\"></figure><figcaption>Lazada</figcaption></a></li><li><a href=\"/vn/thegioididong\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/thegioididong_8_001.png?v=1490266975\" alt=\"Thế Giới Di Động chương trình khuyến mãi\"></figure><figcaption>Thế Giới Di Động</figcaption></a></li><li><a href=\"/vn/sendo\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/sendo_10_001.png?v=1490266841\" alt=\"Sendo chương trình khuyến mãi\"></figure><figcaption>Sendo</figcaption></a></li><li><a href=\"/vn/tiki\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/tiki_12_001.png?v=1490266756\" alt=\"Tiki những sự giảm giá\"></figure><figcaption>Tiki</figcaption></a></li><li><a href=\"/vn/shop-tre-tho\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/shop-tre-tho_34_001.png?v=1490267014\" alt=\"Shop Trẻ Thơ chương trình khuyến mãi\"></figure><figcaption>Shop Trẻ Thơ</figcaption></a></li><li><a href=\"/vn/juno\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/juno_50_001.png?v=1490266946\" alt=\"Juno chương trình khuyến mãi\"></figure><figcaption>Juno</figcaption></a></li><li><a href=\"/vn/vienthonga\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/vienthonga_89_001.png?v=1490267054\" alt=\"Vienthonga những sự giảm giá\"></figure><figcaption>Vienthonga</figcaption></a></li><li><a href=\"/vn/yes24\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/yes24_93_001.png?v=1490267085\" alt=\"Yes24 chương trình khuyến mãi\"></figure><figcaption>Yes24</figcaption></a></li><li><a href=\"/vn/adayroi\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/adayroi_120_001.png?v=1490266805\" alt=\"A Đây Rồi những sự giảm giá\"></figure><figcaption>A Đây Rồi</figcaption></a></li><li><a href=\"/vn/top-m-t\"><figure style=\"background-color: null\"><img src=\"https://cdn.picodi.com/vn/shop/thumb_100/top-m-t_133_001.png?v=1490267108\" alt=\"TOP MỐT chương trình khuyến mãi\"></figure><figcaption>TOP MỐT</figcaption></a></li></ul>";
$content = str_replace($old_store, $new_store, $content);
echo $content;
?>
<style>
    .newsletter.in-footer {
        display: none;
    }

    .social-list {
        display: none;
    }

    .sidebar_block-newsletter {
        display: none;
    }

    .newsletter_btn {
        display: none;
    }

    .flags {
        display: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $(".adsbygoogle").remove();
    });

    $(".promo-btn").click(function () {
        var id = $(this).offsetParent().offsetParent().offsetParent().attr("id");
        id = id.split("_");
        id = id[2];
        link_goc = "<?php echo $request_url ?>";
        link_goc = link_goc.split("?");
        link = "http://webgiamgia.net" + link_goc[0] + "?cid=" + id;
        window.location.href = link;
        window.open("http://webgiamgia.net/getLastLink.php?id=" + id, "_blank");
    });

    $(".btn-label").click(function () {
        var id = $(this).offsetParent().offsetParent().offsetParent().offsetParent().attr("id");
        id = id.split("_");
        id = id[2];
        link_goc = "<?php echo $request_url ?>";
        link_goc = link_goc.split("?");
        link = "http://webgiamgia.net" + link_goc[0] + "?cid=" + id;
        window.location.href = link;
        window.open("http://webgiamgia.net/getLastLink.php?id=" + id, "_blank");
    })
</script>
<?php
if ($request_url == '/vn/top') {
    ?>
    <script>
        $label = $(".nav-links_item label");
        $label.each(function (index) {
            $(this).attr("for", "");
        });
    </script>
    <?php
}
?>



