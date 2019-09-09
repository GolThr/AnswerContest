<?php
   include("dbconfig.php");
   $arr=json_decode($_GET['data'],true);
   $name=$arr["name"];//发布者
   $word=$arr["word"];//搜索关键词

   $sql="select * from community where topic_name like '%$word%' and user_name='$name'";
   $obj=mysqli_query($link,$sql);
   //var_dump($obj);
   $array = array();
   while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
  {
      $array[] = $rows;
  }

  echo json_encode($array);