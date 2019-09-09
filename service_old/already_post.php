<?php

include("dbconfig.php");
//已发话题
$arr=json_decode($_GET['data'],true);
$name=$arr['name'];

$sql="select * from community where user_name='$name'";
$obj=mysqli_query($link,$sql);
$array = array();
while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{
    $array[] = $rows;
}
// print_r($array);
echo json_encode($array);