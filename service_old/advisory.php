<?php
//若前端传入的是视频则调用视频的信息
//若前端传入的是新闻则调用新闻的信息
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
$p=$arr['advisory'];
if($p=='视频')
{
    $array = array();
    $sql="select * from advisory_video";
    $obj=mysqli_query($link,$sql);
    while($rows=mysqli_fetch_array($obj))
    {
        $array[] = $rows;
    }
   // print_r($array);
    echo json_encode($array);
}
else{
    $array = array();
    $sql="select * from advisory_news";
    $obj=mysqli_query($link,$sql);
    while($rows=mysqli_fetch_array($obj))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);
}
