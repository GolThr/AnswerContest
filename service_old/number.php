<?php
//volunteer_num注册的志愿者人数，activity_num发布的活动数
include("dbconfig.php");
//$arr=json_decode($_GET['data'],true);



$sql="select * from user_user";
//var_dump($sql);
$obj=mysqli_query($link,$sql);

if($obj){
    //$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
    $rows=[];
    while($arr=mysqli_fetch_array($obj,MYSQLI_ASSOC)){
        $rows[]=$arr;
        // var_dump($arr);
    }
    $volunteer_num=count($rows);
    // echo $num;

        //$jsonstr=array($rows[$i]);
    //$jsonstr=array('a' =>  $volunteer_num);
    //echo json_encode($jsonstr);

}
$sql="select * from activity";
//var_dump($sql);
$obj=mysqli_query($link,$sql);

if($obj){
    //$arr=mysqli_fetch_array($obj,MYSQLI_ASSOC);
    $rows=[];
    while($arr=mysqli_fetch_array($obj,MYSQLI_ASSOC)){
        $rows[]=$arr;
        // var_dump($arr);
    }
    $activity_num=count($rows);
    // echo $num;

    //$jsonstr=array($rows[$i]);
   // $jsonstr=array('b' => $activity_num);
   // echo json_encode($jsonstr);
    //  echo "<br/>";

}
$jsonstr=array('volunteer_num' => $volunteer_num,'activity_num' => $activity_num);
 echo json_encode($jsonstr);
