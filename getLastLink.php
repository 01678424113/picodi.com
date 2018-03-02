<?php
function getLastLink($url)
{
    $header = get_headers($url);
    $header = implode(" ", $header);
    $location = preg_match('/Location:\s(.*?)\sCache-Control/', $header, $result);
    $last_link = '';
    if(count($result) > 0){
        $last_link = $result[1];
    }
    return $last_link;
}

?>


