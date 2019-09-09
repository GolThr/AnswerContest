<?php
//前端不传数据
//后端传org_name：组织名称，org_password：组织登录密码，org_mailbox：组织邮箱，org_phone：组织电话
//org_avatar:组织头像，ad_name：组织负责人名称，ad_mailbox：负责人邮箱，ad_phone：负责人数据号，ad_id：负责人身份证号
include("dbconfig.php");
//$arr=json_decode($_GET['data'],true);

$sql="select * from organizer_user";
$obj=mysqli_query($link,$sql);
date_default_timezone_set('Asia/Shanghai');
$time=date('Y-m-d H:i:s',time());
$array = array();
while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{
    $count=2;
    $name=$rows["org_name"];
    $ad_name=$rows["ad_name"];
    $org_avatar=$rows["org_avatar"];
    $sqli="select * from acticity where Founder='$name'";
    $obji=mysqli_query($link,$sqli);

    if($obji&&mysqli_fetch_row()){
        while($rowsi=mysqli_fetch_array($obji,MYSQLI_ASSOC)){
            $count++;
        }
    }

   // $count=count($arr);

    $timep=strtotime($time)-strtotime($rows["time"]);
    $timep=(int)$timep/3600;
    $timep=round( $timep/10)*10;
    $p = [
        "name" => "$name",
        "ad_name" => "$ad_name",
        "count"=>"$count",
        "time"=>"$timep",
        "org_avatar"=>"$org_avatar",
    ];
    $array[] =$p;
}
// print_r($array);
echo json_encode($array);