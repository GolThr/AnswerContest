<?php
//前端传入活动的名字name，
//后端传act_id：活动序号，act_name：活动名字，act_city：活动的城市，act_category：活动类别，act_region：活动地点
//regional_sponsors:活动负责人，Initiation_time：活动发布时间，Deadline：活动时长，Ending_time：活动招募结束时间，
//Recruitment:活动需要招募人数，Rec_ing：活动已招募的人数，content：活动内容，Founder：活动发起组织，look：活动浏览量，picture：图片
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
$name=$arr['name'];

$sql="select  * from activity where act_name='$name'";
$obj=mysqli_query($link,$sql);

$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
$look=$arr['look'];

$sql="update activity set look=$look+1 whereand act_name='$name'";
$obj=mysqli_query($link,$sql);

$sql="select  * from activity where act_name='$name'";
$obj=mysqli_query($link,$sql);

$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
echo json_encode($arr);

$sql="select  * from act_post where act_name='$name'";
$obj=mysqli_query($link,$sql);
$array = array();
while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{
    $array[] = $rows;
}
// print_r($array);
echo json_encode($array);
