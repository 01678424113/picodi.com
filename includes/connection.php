<?php
$sever_username = "root";
$sever_password = "";
$server_host = "localhost";
$database = "webgiamgia.net";

$conn = mysqli_connect($server_host,$sever_username,$sever_password,$database) or die("Không thể kết nối tới cơ sở dữ liệu");
mysqli_query($conn,"SET NAMES 'UTF8'");