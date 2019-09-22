<?php
include("dbConfig.php");
header('Content-Type: application/json; charset=utf-8');

class LogicSelect
{
    public $id;
    public $content;
    public $A;
    public $B;
    public $C;
    public $D;
}

//read_post_data
$exam_id = $_POST['exam_id'];

//20191124
$paper_id = substr($exam_id, 5, 1);

//mysql
$sql = "SELECT * FROM logic WHERE num='$paper_id'";
$result = $link->query($sql);
$logicSelectArray = Array();
if ($result->num_rows > 0) {
    // 输出每行数据
    while ($row = $result->fetch_assoc()) {
        $logicSelect = new LogicSelect();
        $logicSelect->id = $row['id'];
        $logicSelect->content = $row['content'];
        $logicSelect->A = $row['a'];
        $logicSelect->B = $row['b'];
        $logicSelect->C = $row['c'];
        $logicSelect->D = $row['d'];
        array_push($logicSelectArray, $logicSelect);
    }
}
$link->close();
//response
echo json_encode($logicSelectArray);

//    header('Content-Type: application/json; charset=utf-8');
//$exam_id = $_POST['exam_id'];
//
//    $data=[
//        [
//            'content' => "$exam_id[4]",
//            'A' => "人民代表大会",
//            'B' => "全国人民代表大会",
//            'C' => "地方各级人民代表大会",
//            'D' => "人民代表大会常务委员会"
//        ],
//    ];
//    echo json_encode($data);
