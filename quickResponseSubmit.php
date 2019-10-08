<?php
    //用于提交多段式题目
var_dump($_POST);
    include("dbConfig.php");

    class Qr{
        public $id;
        public $answer;
        public $duration;
        public function __construct($i, $a, $d){
            $this->id = $i;
            $this->answer = $a;
            $this->duration = $d;
        }
    }

    //read_post_data
    $exam_id = $_POST[0]['exam_id'];
    //$exam_id = '20191124';

    //20191124
    $paper_id = substr($exam_id, 5, 1);

    $question_num = 2;
    //mysql
    for($i = 1; $i <= $question_num; $i++){
        $qr = new Qr($_POST[1][$i-1]['id'], $_POST[1][$i-1]['answer'], $_POST[1][$i-1]['duration']);
        //$qr = new Qr('1', '宪法是国家的根本法', '123');
        $sql="SELECT * FROM quick_response WHERE q_num='$paper_id' AND id='$qr->id'";
        $result = $link -> query($sql);
        var_dump($result);
        if ($result -> num_rows > 0) {
            // 输出每行数据
            while($row = $result -> fetch_assoc()) {
                var_dump($row);
                if($qr->answer == $row['q_ans']){
                    $update_sql="UPDATE student SET qr".$i."_dura = '$qr->duration' where exam_id = '$exam_id'";
                    $update_result = $link -> query($update_sql);
                }
            }
        }
    }
    $link -> close();

    //response
