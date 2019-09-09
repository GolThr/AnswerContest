<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$name=$arr["name"];
$password=md5($arr["password"]);


$sql="select * from sign_in where name='$name' and password='$password'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_affected_rows($link)){
    $arr=mysqli_fetch_array($obj);
    $p=$arr['identity'];
    if($p==="组织用户")
    {
        // $jsonstr=array('a' => 1,'b'=>0);
        // echo json_encode($jsonstr);
        //登录成功组织用户
        $sql="select * from organizer_user where org_name='$name'";
        $obj=mysqli_query($link,$sql);
//        var_dump($obj);
        if($obj){
            $arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);

        }
        $jsonstr=array('a' => 1,'b'=>0,'org_name'=>$arr['org_name'],'org_password'=>$arr['org_password'],'org_mailbox'=>$arr['org_mailbox'],'org_province'=>$arr['org_province'],'introduce'=>$arr['introduce'],'org_phone'=>$arr['org_phone'],'org_city'=>$arr['org_city'],'org_avatar'=>$arr['org_avatar'],'ad_name'=>$arr['ad_name'],'ad_mailbox'=>$arr['ad_mailbox'],'ad_phone'=>$arr['ad_phone'],'ad_id'=>$arr['ad_id'],'time'=>$arr['time']);
        //增加了org_province组织省份introduce组织介绍org_city组织城市time组织注册时间
        // $jsonstr=array('org_name'=>$arr['org_name'],'org_password'=>$arr['org_password'],'org_mailbox'=>$arr['org_mailbox'],'org_phone'=>$arr['org_phone'],'org_avatar'=>$arr['org_avatar'],'ad_name'=>$arr['ad_name'],'ad_mailbox'=>$arr['ad_mailbox'],'ad_phone'=>$arr['ad_phone'],'ad_id'=>$arr['ad_id']);
    }
    else{
        //$jsonstr=array('a' => 1,'b'=>1);
        //登录成功个人用户
        $sql="select * from user_user where nickname='$name'";
        $obj=mysqli_query($link,$sql);

        if($obj){
            //   echo mysqli_error($link);
            $arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
        }
        $jsonstr=array('a' => 1,'b'=>1,'user_mailbox'=>$arr['user_mailbox'],'nickname'=>$arr['nickname'],'user_avatar'=>$arr['user_avatar'],'user_password'=>$arr['user_password'],'user_phone'=>$arr['user_phone'],'user_id'=>$arr['user_id'],'sex'=>$arr['sex'],'province'=>$arr['province'],'city'=>$arr['city'],'introduce'=>$arr['introduce']);

    }
    echo json_encode($jsonstr);
//    echo json_encode($jsonstr);
}
else{
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //登录失败
}
//127.0.0.1/HeartVolunteer/service/login.php?data={"name":"001","password":"111"}