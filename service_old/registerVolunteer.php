<?php
    header('Content-type:text/html;charset=utf-8');
    //var_dump($_POST["data"]);
    $link=mysqli_connect('localhost:3306','root','root');
    $link->query("SET NAMES UTF8");
    if(!$link){
        //exit('数据库链接失败');
    }
    mysqli_select_db($link,'db_heart volunteer');

   $arr=json_decode($_GET['data'],true);
    //$arr=json_decode($_POST["data"],true);
    $email=$arr["email"];
    $nickname=$arr["nickname"];
    $password=md5($arr["password"]);
    $phoneNumber=$arr["phoneNumber"];
    $idCard=$arr["idCard"];
    $gender=$arr["gender"];
    $name=$arr["name"];
    date_default_timezone_set('Asia/Shanghai');
    $time=date('Y-m-d H:i:s',time());
    $sql="select * from user_user where nickname='$nickname'";
    $obj=mysqli_query($link,$sql);
    if($obj&&mysqli_affected_rows($link)){
        $jsonstr=array('a' => 0);
        echo json_encode($jsonstr);
    }
    else{
        $sql="insert into user_user(user_mailbox,nickname,user_password,user_phone,user_id,sex,name,time) values ('$email','$nickname','$password','$phoneNumber','$idCard','$gender','$name','$time')";
        //保证昵称小于32位，手机号11位身份证18位，密码（自己限定）
        $obj=mysqli_query($link,$sql);
        $jsonstr=array('a' => 1);
        echo json_encode($jsonstr);
    }

