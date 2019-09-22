<?php
    //用于提交多段式题目
    include("dbConfig.php");
    var_dump($_POST);
    //所以提交过来的数据是啥？？？
    $answer = json_decode($_POST[''], true);
    $count = count($answer);
    $exam_id = $answer[0]['exam_id'];
    $sql = "SELECT * FROM student WHERE exam_id='$exam_id'";
    $result = $link->query($sql);
//    $question_type = ['single_select', 'multi_select', 'judge', 'related', 'logic', 'quick_response'];
    if ($result->num_rows > 0) {   //查询是否存在该考生
        for ($i = 1; $i < $count; $i++) {
            $id = $answer[$i]['id'];
            $type = $answer[$i]['type'];
            $answer1 = $answer[$i]['answer'];

            $other_sql = "SELECT * from quick_response where id = $id";
            $result = $link -> query($other_sql);
            $question_detail=mysqli_fetch_array($result,MYSQLI_ASSOC);

            if($answer == $question_detail['q_ans']){
                $score = $question_detail['q_sco'];
                $sql="UPDATE student SET score = score + $score where exam_id = '$exam_id'";
                $result = $link -> query($sql);
            }
        }
    } else {
        echo "<script>alert('身份错误！')<script>";
    }

//else if($type == 5){
//            $other_sql = "SELECT * from $question_type[$type] where id = $id";
//            $result = $link -> query($other_sql);
//            $question_detail=mysqli_fetch_array($result,MYSQLI_ASSOC);
//            if($answer == $question_detail['ans']){
//                $score = $question_detail['score'];
//                $sql="UPDATE student SET score = score + $score where exam_id = $exam_id";
//                $result = $link -> query($sql);
//            }
//}