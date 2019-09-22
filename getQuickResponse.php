<?php
include("service/dbConfig.php");
header('Content-Type: application/json; charset=utf-8');

//20191124
$exam_id = $_POST['exam_id'];
$paper_id = substr($exam_id, 5, 1);
class Date{
//    public $quick_response_id;
    public $id;
    public $content;
    public $A;
    public $B;
    public $C;
    public $D;
    public $E;
}
$sql = "SELECT * from quick_response where q_num = $paper_id";
$result = $link -> query($sql);
$data =array();
if ($result -> num_rows > 0) {
    while($row = $result -> fetch_assoc()) {
//        $date -> quick_response_id = $row['quick_response_id'];
        $date = new Date();
        $date -> id = $row['id'];
        $date -> content = $row['q_content'];
        $date -> A = $row['q_reminder1'];
        $date -> B = $row['q_reminder2'];
        $date -> C = $row['q_reminder3'];
        $date -> D = $row['q_reminder4'];
        $date -> E = $row['q_reminder5'];
        $data[] = $date;
    }
}
$link -> close();
//    $data=[
//        [
//            'content' => "宪法的基本原则之一",
//            'A' => "由列宁最早提出",
//            'B' => "也是是党的根本组织原则",
//            'C' => "指民主基础上的集中和集中指导下的民主相结合",
//        ],
//            [
//            'content' => "宪法的基本原则之一",
//            'A' => "由列宁最早提出",
//            'B' => "也是是党的根本组织原则",
//            'C' => "指民主基础上的集中和集中指导下的民主相结合",
//        ],
//    ];
    echo json_encode($data);