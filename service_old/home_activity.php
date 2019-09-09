<?php
//  home_activity.php?data={"clas":"生态保护","city":"日照"}
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
 $class=$arr['class'];
 $city=$arr['city'];
if($class=="全部"){
    $sql="select * from activity where act_city='$city'";
    $obj=mysqli_query($link,$sql);
        $array = array();
        while($rows=mysqli_fetch_array($obj))
        {
            $array[] = $rows;
        }
        // print_r($array);
        echo json_encode($array);

}else{
    $sql="select * from activity where act_category='$class' and act_city='$city'";
    var_dump($sql);
    $obj=mysqli_query($link,$sql);

    $array = array();
    while($rows=mysqli_fetch_array($obj))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);

}
