<?php
  include("dbconfig.php");
  $arr=json_decode($_GET['data'],true);
  $name=$arr["name"];//发布者
  $word=$arr["word"];//搜索关键词

  $sql="select * from topic_post where user_name='$name'and post_name like '%$word%'";
  $obj=mysqli_query($link,$sql);
  $array = array();
  while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
  {
      $topic_name=$rows["post_name"];
      $sql="select * from community where topic_name='$topic_name'";
      $obj=mysqli_query($link,$sql);
      $arr=mysqli_fetch_array($obj);
      $array[] = $arr;
   }
  // print_r($array);
  echo json_encode($array);