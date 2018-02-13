<?php
$id = $_GET['id'];
function get_last_link($url)
{
    $web = file_get_contents("$url");
    $web = str_replace("<script>", '', $web);
    preg_match('/couponUrl = \'(.*?)\'/', $web, $result);

    // Neu co link accestrade
    /*  preg_match('/url=(.*?)$/', $result[1], $result2);
      $last_link = str_replace("%3A", ":", $result2[1]);
      $last_link = str_replace("%2F", "/", $last_link);*/
    $last_link = $result[1];
    return $last_link;
}

echo get_last_link("https://metric.picodi.net/vn/r/" . $id);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

</script>

