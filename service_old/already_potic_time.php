<?php

  include("dbconfig.php");
  $arr=json_decode($_GET['data'],true);
  $class=$arr["class"];//搜索时间类型
  $name=$arr["name"];//话题发布者

  if($class=="全部"){

      $sql="select * from community where user_name='$name'";
      $obj=mysqli_query($link,$sql);
      $array = array();

      while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
      {
          $array[] = $rows;
      }
      echo json_encode($array);
// print_r($array);

}elseif ($class=="月"){
      date_default_timezone_set('Asia/Shanghai');
      $be_time=date('Y-m-d H:i:s',strtotime('-30 days'));//用时间戳获取

      $sql="select * from community where user_name='$name'and release_date> '$be_time' ";
      $obj=mysqli_query($link,$sql);
      //var_dump($obj);
      $array = array();
      while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
      {
          $array[] = $rows;
      }
      echo json_encode($array);
  }elseif($class=="周"){
      date_default_timezone_set('Asia/Shanghai');
      $be_time=date('Y-m-d H:i:s',strtotime('-7 days'));//用时间戳获取

      $sql="select * from community where user_name='$name'and release_date> '$be_time' ";
      $obj=mysqli_query($link,$sql);
      //var_dump($obj);
      $array = array();
       while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
      {
          $array[] = $rows;
      }
     echo json_encode($array);
  }elseif($class=="年"){
      date_default_timezone_set('Asia/Shanghai');
      $be_time=date('Y-m-d H:i:s',strtotime('-365 days'));//用时间戳获取

      $sql="select * from community where user_name='$name'and release_date> '$be_time' ";
      $obj=mysqli_query($link,$sql);
      //var_dump($obj);
      $array = array();
      while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
      {
          $array[] = $rows;
      }
      echo json_encode($array);
  }

