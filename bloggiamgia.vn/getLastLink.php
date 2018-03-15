<?php
function getLastLink($url)
{
    $header = get_headers($url);
    $header = implode(" ", $header);
    $location = preg_match('/Location\:.*?\?url=(.*?)\s/', $header, $result);
    $last_link = $result[1];
    $last_link = str_replace("%3A", ":", $last_link);
    $last_link = str_replace("%3a", ":", $last_link);
    $last_link = str_replace("%2F", "/", $last_link);
    $last_link = str_replace("%2f", "/", $last_link);
    return $last_link;
}

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#custom_html-36').hide();
        $('#text-42').hide();
        $('#text-41').hide();
        $('#custom_html-35').hide();
        $('.entry-share').hide();
        $('.content-note').hide();
        $('.site-footer').hide();
    })
</script>

