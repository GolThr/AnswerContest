<?php

include("dbconfig.php");
//已发活动
$arr=json_decode($_GET['data'],true);
$name=$arr['name'];

$sql="select * from activity where Founder='$name'";
$obj=mysqli_query($link,$sql);

$array = array();

while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{
    $array[] = $rows;
}
echo json_encode($array);
//127.0.0.1/HeartVolunteer/service/already_activity.php?data={"name":"心田地"}