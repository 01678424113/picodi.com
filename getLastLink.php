<?php
function getLastLink($url)
{
    $header = get_headers($url);
    $header = implode(" ", $header);
    $location = preg_match('/Location\:.*?\&url=(.*?)\s/', $header, $result);
    if(count($result) == 0){
        $location = preg_match('/Location\:.*?\&r=(.*?)\s/', $header, $result);
    }
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
        $('.flag').hide();
        $('.signup-nav').hide();
        $('.merchant-info-sidebar').hide();
        $('.extension').hide();
    })

</script>

