<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$old_org_name=$arr["old_org_name"];//获取当前用户

//更改的信息
$org_name=$arr["org_name"];
$org_phone=$arr["org_phone"];
$org_province=$arr["org_province"];
$org_city=$arr["org_city"];
$introduce=$arr["introduce"];
$org_mailbox=$arr["org_mailbox"];
$ad_phone=$arr["ad_phone"];
$ad_id=$arr["ad_id"];
$ad_mailbox=$arr["ad_mailbox"];
$ad_name=$arr["ad_name"];



$sql="update organizer_user set org_name='$org_name',set org_mailbox='$org_mailbox',org_province='$org_province',introduce='$introduce',org_phone='$org_phone',org_city='$org_city',ad_mailbox='$ad_mailbox',ad_name='$ad_name',ad_mailbox='$ad_mailbox',ad_phone='$ad_phone',ad_id='$ad_id' where org_name='$old_org_name'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_affected_rows($link)){
    $jsonstr=array('a' => 1);
    echo json_encode($jsonstr);
    //成功
}else{
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //失败
}

