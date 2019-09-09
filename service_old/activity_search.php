<?php
  include("dbconfig.php");
  $arr=json_decode($_GET['data'],true);

  $name=$arr["name"];//获取活动搜索关键字
  $class=$arr["class"];//获取活动标签

  if($class=="全部"){
      $sql="select * from activity where act_name like '%$name%'";
      $obj=mysqli_query($link,$sql);

      $array = array();
      while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
      {
          $array[] = $rows;
      }
      // print_r($array);
      echo json_encode($array);
  }else{
      $sql="select * from activity where act_name like '%$name%'and act_category='$class'";
      $obj=mysqli_query($link,$sql);

          $array = array();
          while($rows=mysqli_fetch_array($obj,MYSQLI_ASSOC))
          {
              $array[] = $rows;
          }

          echo json_encode($array);

  }
