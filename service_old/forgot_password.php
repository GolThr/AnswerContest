<?php
//获取用户邮箱和修改后的密码，修改成功返回1失败返回0
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$mailbox=$arr["mailbox"];//获取用户邮箱
$password=md5($arr["password"]);//获取修改后的 密码

$sql="select * from user_user where user_mailbox='$mailbox'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_fetch_array($obj)){
    $sql="update user_user set user_password='$password' where user_mailbox='$mailbox'";
    $obj=mysqli_query($link,$sql);
    $array = array('a'=>1);
    echo json_encode($array);
    //修改成功
}
else{
    $sql="select * from organizer_user where org_mailbox='$mailbox'";
    $obj=mysqli_query($link,$sql);
    if($obj&&mysqli_fetch_array($obj)){
        $sql="update organizer_user set org_password='$password' where org_mailbox='$mailbox'";
        $obj=mysqli_query($link,$sql);
        $array = array('a'=>1);
        echo json_encode($array);
        //修改成功
    }
    else{
        $array = array('a'=>0);
        echo json_encode($array);
        //修改失败
    }
}
//127.0.0.1/HeartVolunteer/service/forgot_password.php?data={"mailbox":"567488392@qq.com","password":"111"}