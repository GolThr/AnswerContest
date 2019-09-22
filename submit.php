<?php
include("dbConfig.php");
var_dump($_POST);
//所以提交过来的数据是啥？？？
// $answer = json_decode($_POST[''],true);//解析答案
$answer = $_POST;
$count = count($answer[1]);//计算json数组的个数
$exam_id = $answer[0]['exam_id'];//获取考号
$sql="SELECT * FROM student WHERE exam_id='$exam_id'";
$result = $link -> query($sql);
$question_type = ['single_select', 'multi_select', 'judge', 'related', 'logic', 'quick_response'];
if ($result -> num_rows > 0) {   //查询是否存在该考生
    for ($i = 0; $i < $count; $i++) {//循环获取答案
        //获取提交来的题目的ID，类型，及答案
        $id = (int)$answer[1][$i]['id'];
        $type = $answer[1][$i]['type'];
        $answer1 = $answer[1][$i]['answer'];
        //单独验证类型为判断题的答案
//        if($type == 2){
//            $single_select_sql = "SELECT * from $question_type[$type] where id = $id";
//            $result = $link -> query($single_select_sql);
//            $question_detail=mysqli_fetch_array($result,MYSQLI_ASSOC);
//            if($answer == $question_detail['ans']){
//                $score = $question_detail['score'];
//                $sql="UPDATE student SET score = score + $score where exam_id = '$exam_id'";
//                $result = $link -> query($sql);
//            }
//        }else{
        $other_sql = "SELECT * from $question_type[$type] where id = $id";
        $result = $link -> query($other_sql);
        $question_detail=mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($answer1 == $question_detail['ans']){
            $score = $question_detail['score'];
            $sql="UPDATE student SET score = score + $score where exam_id = '$exam_id'";
            $result = $link -> query($sql);
        }
//        }
    }
}else{
    echo "身份错误";
}
