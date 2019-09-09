<?php
header("charset=utf-8");
include("dbconfig.php");
    $session_info=$_POST['session_info'];
    $cpicture='';
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
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            //   	$sFileName = "sda.php";
            // $sOriginalFileName = $sFileName;
            // $sExtension = s str($sFileName, (strrpos($sFileName, '.') + 1));//找到扩展名
            // $sExtension = strtolower($sExtension);
            // $sFileName = date("YmdHis").rand(100, 200).".".$sExtension; //这样就是我们的新文件名了，全数字的不会有乱码了哦。
            //iconv("GBK", "UTF-8", $content);
            $name = iconv("GBK", "UTF-8", $_FILES["file"]['name']);
            $cpicture = $name;
            if (file_exists("../picture/" . $_FILES["file"]["name"]))
            {
                $sql="UPDATE user_user set user_avatar = '$cpicture' where nickname = '$session_info'";
                $res=$link->query($sql);
                if($res){
                    echo "<script>alert('更换头像成功，下次登录时更新！'); location.href='../mine.html';</script>";
                }else{
                    echo "<script>alert('更换头像失败！'); location.href='../mine.html';</script>";
                }
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "../picture/" . $_FILES["file"]["name"]);
                //echo "文件存储在: " . "images/computers/" . $_FILES["file"]["name"];
            }
        }
    }
    else
    {
        echo "非法的文件格式,返回重新选择！";
    }

$sql="UPDATE user_user set user_avatar = '$cpicture' where nickname = '$session_info'";
    $res=$link->query($sql);
    //echo $sql;
    if($res){
        echo "<script>alert('更换头像成功，下次登录时更新！'); location.href='../mine.html';</script>";
        //echo "236";
    }else{
        echo "<script>alert('更换头像失败！'); location.href='../mine.html';</script>";
    }

    mysqli_close($link);
?>