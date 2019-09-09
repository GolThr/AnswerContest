<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);

$name=$arr["name"];
$old_password=md5($arr["old_password"]);
$password=md5($arr["password"]);


$sql="select * from sign_in where name='$name'and password='$old_password'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_affected_rows($link)){
    $arr=mysqli_fetch_array($obj);
    $p=$arr['identity'];
    if($p="组织用户"){
        $sql="update organizer_user set org_password='$password' where org_name='$name'";
        $obj=mysqli_query($link,$sql);
    }
    else{
        $sql="update user_user set user_password='$password' where nickname='$name'";
        $obj=mysqli_query($link,$sql);
    }
    $jsonstr=array('a' => 1);
    echo json_encode($jsonstr);
    //成功
}
else{
    $jsonstr=array('a' => 0);
    echo json_encode($jsonstr);
    //密码错误
}
