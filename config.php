<?php
$host="localhost";
$user="root";
$pwd="";
$db="babynames";
@mysql_connect($host,$user,$pwd) or die(mysql_error());
@mysql_select_db($db) or die(mysql_error()) ;
//echo "run succes";


?>
