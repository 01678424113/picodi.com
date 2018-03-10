<?php
function getLastLink($url)
{
    $header = get_headers($url);
    $header = implode(" ", $header);
    $location = preg_match('/Location\:.*?url\%3D(.*?)\%253Foffer\_id/', $header, $result);
    if(count($result) == 0){
        $location = preg_match('/Location\:.*?\&url=(.*?)\s/', $header, $result);
    }
    $last_link = $result[1];
    $last_link = str_replace("%253A", ":", $last_link);
    $last_link = str_replace("%253a", ":", $last_link);
    $last_link = str_replace("%252F", "/", $last_link);
    $last_link = str_replace("%252f", "/", $last_link);
    return $last_link;
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#links').hide();
        $('#mega-menu-amp').hide();
    })
</script>

