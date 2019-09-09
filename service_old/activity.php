<?php
//  127.0.0.1/HeartVolunteer/service/home_activity.php?data={"clas":"生态保护","city":"日照"}
//根据城市和标签筛选活动
//前端传活动的标签和城市
//后端传act_id：活动序号，act_name：活动名字，act_city：活动的城市，act_category：活动类别，act_region：活动地点
//regional_sponsors:活动负责人，Initiation_time：活动发布时间，Deadline：活动时长，Ending_time：活动招募结束时间，
//Recruitment:活动需要招募人数，Rec_ing：活动已招募的人数，content：活动内容，Founder：活动发起组织，look：活动浏览量，picture：图片
include("dbconfig.php");
$arr=json_decode($_GET['data'],true);
$class=$arr['class'];
 $city=$arr['city'];
if($class=="全部"){
    $sql="select * from activity where act_city='$city'";
    $obj=mysqli_query($link,$sql);
        $array = array();
        while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
        {
            $array[] = $rows;
        }
        // print_r($array);
        echo json_encode($array);

}else{
    $sql="select * from activity where act_category='$class' and act_city='$city'";
    //var_dump($sql);
    $obj=mysqli_query($link,$sql);

    $array = array();
    while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
    {
        $array[] = $rows;
    }
    // print_r($array);
    echo json_encode($array);

}
