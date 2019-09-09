<?php
//header('Content-type:text/html;charset=utf-8');
//var_dump($_POST["data"]);
//$link=mysqli_connect('localhost:3307','root','root');
//$link->query("SET NAMES UTF8");
//if(!$link){
//exit('数据库链接失败');
//}
//mysqli_select_db($link,'db_heart volunteer');
include("dbconfig.php");

$arr=json_decode($_GET['data'],true);
//$arr=json_decode($_POST["data"],true);

$old_nickname=$arr["old_nickname"];//用户信息

//更改信息
$email=$arr["email"];
$nickname=$arr["nickname"];
$phoneNumber=$arr["phoneNumber"];
$idCard=$arr["idCard"];
$gender=$arr["gender"];
$name=$arr["name"];
$introduce=$arr["introduce"];

$sql="update user_user set email='$email',nickname='$nickname',phoneNumber='$phoneNumber',idCard='$idCard',gender='$gender',name='$name',introduce='$introduce' where nickname='$old_nickname'";
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

