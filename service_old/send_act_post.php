<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$act_name=$arr["act_name"];//活动名称
$user_name=$arr["user_name"];//评论用户名称
$content=$arr["content"];//评论内容
$user_avatar=$arr["user_avatar"];//评论用户头像
date_default_timezone_set('Asia/Shanghai');
$release_time=date('Y-m-d H:i:s',time());//评论发布时间

$sql="select * from act_post";
$obj=mysqli_query($link,$sql);
if($obj){
    $sql="insert into act_post(act_name,user_name,content,release_time,user_avatar)values('$act_name','$user_name','$content','$release_time','$user_avatar')";
    $obj=mysqli_query($link,$sql);
    $jsonstr=array('a' => 1);
    echo json_encode($jsonstr);
    //评论发布成功
}else{
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //评论发布失败
}

