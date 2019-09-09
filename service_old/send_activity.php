<?php

// //活动发布成功a=1,活动发布失败a=0;
////前端获取活动名字：act_name，活动城市：act_city，活动类别：act_category，活动发布组织负责人regional_sponsors，
////活动时长Deadline，活动截止时间Ending_time，活动所需人数Recruitment，活动已招人数Rec_ing，活动内容content，发布活动的组织Founder，活动图片picture
////后端输出，活动次序：act_id，活动名字：act_name，活动城市：act_city，活动类别：act_category，活动发布组织负责人regional_sponsors，
//////活动时长Deadline，活动截止时间Ending_time，活动所需人数Recruitment，活动已招人数Rec_ing，活动介绍introduce=0，活动内容content，活动摘要abstract=0，发布活动的组织Founder，活动小注notes=0，点赞数，look=0，活动图片picture
////图片存在的目录为images/activity/
include("dbconfig.php");
//$arr=json_decode($_GET['data'],true);

$act_name=$_POST['act_name'];
//echo $act_name;
//$act_city=$_POST['act_city'];
//$act_category=$_POST['act_category'];
//$act_region=$_POST['act_region'];
$regional_sponsors=$_POST['regional_sponsors'];
date_default_timezone_set('Asia/Shanghai');
$Initiation_time=$release_date=date('Y-m-d H:i:s',time());//用时间戳获取
$Deadline=$_POST['deadline_year']+$_POST['deadline_month']+$_POST['deadline_day'];
$Ending_time=$_POST['Ending_time'];
//$Recruitment=$_POST['Recruitment'];
//$Rec_ing=$_POST['Rec_ing'];
$content=$_POST['content'];
//$Founder=$_POST['Founder'];
$picture='';
//echo $act_name;
//127.0.0.1/HeartVolunteer/service/send_activity.php?data={"act_name":"夕阳","act_city":"日照市","act_category":"生态环保","act_region":"东港","regional_sponsors":"哈哈","Deadline":"2","Ending_time":"11","Recruitment":"2","Rec_ing":"1","content":"公益","Founder":"心田地","picture":"children(6).jpg"}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 2048000)   // 小于 2000 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        //echo "错误：: " . $_FILES["file"]["error"] . "<br>";//空间不足
    }
    else
    {

        $picture= $_FILES["file"]["name"];//上传文件的名字
        echo $picture;
        if (file_exists("../images/community_images/" . $_FILES["file"]["name"]))
        {
            $jsonstr=array('a' => 0);
            //echo json_encode($jsonstr);
            //echo $_FILES["file"]["name"] . " 文件已经存在。 ";

        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "../images/activity_images/" . $_FILES["file"]["name"]);
            //echo "文件存储在: " . "images/computers/" . $_FILES["file"]["name"];
        }
        //move_uploaded_file($_FILES["file"]["tmp_name"], "images/heart_volunteer/" . $_FILES["file"]["name"]);
    }
}
//else
//{
//    echo "非法的文件格式";
//}


$sql="select * from activity where act_name='$act_name'";
$obj=mysqli_query($link,$sql);
if($obj&&mysqli_affected_rows($link)){
   // $jsonstr=array('a' => 0);
   // echo json_encode($jsonstr);
    //该活动已发
    echo "<script>alert('你已发布过该话题，点击返回修改！');history.back();</script>";

}
else{
    $sql="insert into activity (act_name,act_city,act_category,act_region,regional_sponsors,Initiation_time,Deadline,Ending_time,Recruitment,Rec_ing,introduce,content,abstract,Founder,notes,look,picture)
        values ('$act_name','济南市','生态环保','济南市沁东园','$regional_sponsors','$Initiation_time','$Deadline','$Ending_time','25','$Rec_ing',0,'$content','0','蓝天行','0','0','2.jpg')";
   // echo $sql;
    $obj=mysqli_query($link,$sql);
    if($obj){
        echo "<script>alert('发布成功，点击返回！');history.back();</script>";
    }else{
        echo "<script>alert('发布失败，请检查信息是否填写正确！');history.back();</script>";
    }
    //$jsonstr=array('a' => 1);
    //echo json_encode($jsonstr);
    //活动发布成功
}
//