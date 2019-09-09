<?php
//header('Content-type:text/html;charset=utf-8');
////var_dump($_POST["data"]);
//$link=mysqli_connect('localhost:3306','root','root');
//$link->query("SET NAMES UTF8");
//if(!$link){
//    //exit('数据库链接失败');
//}
//mysqli_select_db($link,'db_heart volunteer');
//
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
//$arr=json_decode($_POST["data"],true);


$org_name=$arr["org_name"];
$org_mailbox=$arr["org_mailbox"];
$org_phone=$arr["org_phone"];
$org_password=md5($arr["org_password"]);
$ad_mailbox=$arr["ad_mailbox"];
$ad_name=$arr["ad_name"];
$ad_phone=$arr["ad_phone"];
$ad_id=$arr["ad_id"];
date_default_timezone_set('Asia/Shanghai');
$time=date('Y-m-d H:i:s',time());
$sql="select * from organizer_user where org_name='$org_name'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_affected_rows($link)){
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //组织账号已存在
}
else{
    $sql="insert into organizer_user(org_name,org_mailbox,org_phone,org_password,ad_mailbox,ad_name,ad_phone,ad_id,time) values ('$org_name','$org_mailbox','$org_phone','$org_password','$ad_mailbox','$ad_name','$ad_phone','$ad_id','$time')";
    $obj=mysqli_query($link,$sql);
    $jsonstr=array('a' => 1);
    echo json_encode($jsonstr);
    //插入成功
}
//127.0.0.1/HeartVolunteer/service/registerOrganizer.php?data={"org_name":"123","org_mailbox":"111","org_phone":"12345678900","org_password":"123456","ad_mailbox":"222","ad_name":"333","ad_phone":"12345678907","ad_id":"123456789009876543"}

