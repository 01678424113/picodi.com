<?php
function getLastLink($url)
{
    $header = get_headers($url);

    $header = implode(" ", $header);
    preg_match('/Location\:.*?url%3D(.*?)\%253F/', $header, $result);
    if ($result[1] == ''){
         preg_match('/Location\:.*?url%3D(.*?)\%26/', $header, $result);
    }
    $last_link = $result[1];

    $last_link = str_replace("%253A", ":", $last_link);
    $last_link = str_replace("%%253a", ":", $last_link);
    $last_link = str_replace("%252F", "/", $last_link);
    $last_link = str_replace("%252f", "/", $last_link);
    return $last_link;
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#bs-carousel5').hide();
        $('.fb-like').hide();
        $('.footer').hide();
        $('.menu-2').hide();
        $('img[src="https://image.excite.co.id/shop/images/banner-364x303.jpg"]').hide();
    })
</script>

