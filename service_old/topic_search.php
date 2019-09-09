<?php
   include("dbconfig.php");
   $arr=json_decode($_GET['data'],true);

  $name=$arr["name"];//获取活动搜索关键字

  $sql="select * from community where topic_name like '%$name%'";
  $obj=mysqli_query($link,$sql);

  $array = array();
  while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
{
    $array[] = $rows;
}
  // print_r($array);
  echo json_encode($array);
