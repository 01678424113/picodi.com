<?php
$header = get_headers("https://goo.gl/9B9vhG");
$header = implode(" ",$header);
preg_match('/Location\: (.*?)\s/',$header,$result);
$last_link = $result[1];
die;