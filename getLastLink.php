<?php
function getLastLink($url)
{
    $header = get_headers($url);
    var_dump($header);
    $header = implode(" ", $header);
    preg_match('/Location\:\s.*?\&url=(.*?)\%3Fsource/', $header, $last_link);
    $last_link = $last_link[1];
    $last_link = str_replace("%3A", ":", $last_link);
    $last_link = str_replace("%3a", ":", $last_link);
    $last_link = str_replace("%2F", "/", $last_link);
    $last_link = str_replace("%2f", "/", $last_link);
    preg_match('/ho.lazada(.*?)/', $last_link, $result);
    if (count($result) == 2) {
        $header = get_headers($last_link);
        $header = implode(" ", $header);
        preg_match('/Location\:(.*?)\?offer\_id/', $header, $last_link_2);
        $last_link = $last_link_2[1];
    }
    return $last_link;
}

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#links').hide();
        $('#mega-menu-amp').hide();
        $('#disclaimer').hide();
        $('amp-facebook-like').hide();

    })
</script>

