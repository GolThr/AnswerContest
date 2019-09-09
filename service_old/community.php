<?php
   //前端传话题类型class
   //后端传topic_name:话题名字，topic_class：话题类型，topic_image：话题图片，user_name：用户者名字，topic_content：话题内容，
   //like:点赞，release_date：话题发布时间
   include("dbconfig.php");
   $arr=json_decode($_GET['data'],true);
   $class=$arr["class"];

if($class=="全部"){
    $sql="select * from community";
    $obj=mysqli_query($link,$sql);
    $array = array();
    while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);


}else{
    $sql="select * from community where topic_class='$class'";
    $obj=mysqli_query($link,$sql);
    $array = array();
    while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);
}

