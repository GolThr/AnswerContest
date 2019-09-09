<?php
    include("dbconfig.php");
    //$arr=json_decode($_GET['data'],true);

    date_default_timezone_set('Asia/Shanghai');
    $release_date=date('Y-m-d H:i:s',time());
    $topic_name=$_POST['article_title'];
    $topic_class=$_POST['uisex'];
    $user_name=$_POST['user_name'];//换成前端传来js的的POST里面的session值
    $topic_content=$_POST['article_words'];
    $likes=0;
    $topic_image='';

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

        $topic_image= $_FILES["file"]["name"];//上传文件的名字
        if (file_exists("../images/community_images/" . $_FILES["file"]["name"]))
        {
            $jsonstr=array('a' => 0);
            //echo json_encode($jsonstr);
            //echo $_FILES["file"]["name"] . " 文件已经存在。 ";

        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "../images/community_images/" . $_FILES["file"]["name"]);
            //echo "文件存储在: " . "images/computers/" . $_FILES["file"]["name"];
        }
        //move_uploaded_file($_FILES["file"]["tmp_name"], "images/heart_volunteer/" . $_FILES["file"]["name"]);
    }
}
else
{
    echo "非法的文件格式";
}

//127.0.0.1/HeartVolunteer/service/send_topic.php?data={"topic_name":"啦啦","topic_class":"生态保护","user_name":"爱地球"，"topic_content":"就这样"，}
      $sql="select * from community where topic_name = '$topic_name' and user_name= '$user_name'";
      $obj=mysqli_query($link, $sql);
     if(mysqli_num_rows($obj)>0){
         echo "<script>alert('你已发布过该话题，点击返回修改！');history.back();</script>";

     }
   else{
       $sql="insert into community (topic_name,topic_class,topic_image,user_name,topic_content,likes,release_date)
        values ('$topic_name','$topic_class','$topic_image','$user_name','$topic_content','$likes','$release_date')";
    $obj=mysqli_query($link,$sql);
       //echo $sql;
      // var_dump($obj);
    if($obj){
        echo "<script>alert('发布成功，点击返回！');history.back();</script>";
    }else{
        echo "<script>alert('发布失败，请检查信息是否填写正确！');history.back();</script>";
    }

}

