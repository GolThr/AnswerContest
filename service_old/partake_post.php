<?php

include("dbconfig.php");
//参与话题
$arr=json_decode($_GET['data'],true);
$name=$arr['name'];
$sql="select * from topic_post where user_name='$name'";
$obj=mysqli_query($link,$sql);

$array = array();


//while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{

    $pp=$rows["post_name"];
    $sql="select * from community where topic_name='$pp'";
   // var_dump($sql);
    $obj=mysqli_query($link,$sql);
    //var_dump($obj);
    $qq=mysqli_fetch_array($obj,MYSQLI_ASSOC);
    //echo $qq;
    $array[]= $qq;
}

echo json_encode($array);
//127.0.0.1/HeartVolunteer/service/partake_post.php?data={"name":"爱地球"}