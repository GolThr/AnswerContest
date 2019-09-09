<?php
//前端传出话题的名字name，
//后端传topic_name：话题名称，topic_class：话题类别，topic_image：话题图片，
//user_name:用户名称，topic_content：话题内容，like：点赞数，release_date：话题发布时间
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
$name=$arr['name'];

$sql="select  * from community where topic_name='$name'";
$obj=mysqli_query($link,$sql);

$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
$like=$arr['like'];

$sql="update community set $like = $like+1 where topic_name='$name'";
$obj=mysqli_query($link,$sql);

$sql="select  * from community where topic_name='$name'";
$obj=mysqli_query($link,$sql);

$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
echo json_encode($arr);


//127.0.0.1/HeartVolunteer/service/community_one.php?data={"name":"11"}
