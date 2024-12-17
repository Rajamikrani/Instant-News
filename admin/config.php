<?php
$hostname = "http://localhost/php_practice/news-site";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news-site";

$conn = mysqli_connect($servername , $username  , $password , $dbname ) or die("connection failed :" . mysqli_connect_error());

?>