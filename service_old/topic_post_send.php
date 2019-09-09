<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$post_name=$arr['act_name'];
$user_name=$arr['user_name'];
$post_content=$arr['content'];
date_default_timezone_set('Asia/Shanghai');
$release_time=date('Y-m-d H:i:s',time());



$sql="insert into topic_post(post_name,user_name,post_content,release_time) values ('$post_name','$user_name','$post_content','$release_time')";
$obj=mysqli_query($link,$sql);

if($obj){
    $jsonstr=array('a' => 1);
    echo json_encode($jsonstr);
    //话题跟帖成功

}else{
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //话题跟帖失败

}



//127.0.0.1/HeartVolunteer/service/topic_post_send.php?data={"post_name"："青春你我","user_name":"222","post_content"："天气挺好的","release_time":"2019-03-03 3:30:3"}