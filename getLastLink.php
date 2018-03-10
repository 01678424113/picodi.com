<?php
function getLastLink($url)
{
    $get_last_link = file_get_contents($url);
    preg_match('/.*?url\=(.*?)offer\_id/',$get_last_link,$result);
    $last_link = $result[1];
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

