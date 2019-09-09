<?php

include("dbconfig.php");
$arr = json_decode($_GET['data'],true);

var_dump($arr);

$name = $arr["name"];

