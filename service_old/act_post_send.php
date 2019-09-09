<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);


date_default_timezone_set('Asia/Shanghai');
$release_time=date('Y-m-d H:i:s',time());

$act_name=$arr['act_name'];
$user_name=$arr['user_name'];
$content=$arr['content'];


    $sql="insert into act_post(act_name,user_name,content,release_time) values ('$act_name','$user_name','$content','$release_time')";
    $obj=mysqli_query($link,$sql);
   //  var_dump($obj);
    if($obj){
        $jsonstr=array('a' => 1);
        echo json_encode($jsonstr);
        //活动评论发布成功
    }else{
        $jsonstr=array('a' => 0);
        echo json_encode($jsonstr);
        //活动评论发布失败
    }





//127.0.0.1/HeartVolunteer/service/act_post_send.php?data={"act_name"："青春你我","user_name":"222","content"："天气挺好的","release_time":"2019-03-03 3:30:3"}