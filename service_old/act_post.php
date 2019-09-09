<?php
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
$act_name=$arr['act_name'];


    $sql="select * from act_post where act_name='$act_name'";
    $obj=mysqli_query($link,$sql);
    $array = array();
    while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);

