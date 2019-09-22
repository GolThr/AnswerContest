<?php
include("dbConfig.php");
header('Content-Type: application/json; charset=utf-8');
class Judge{
    public $id;
    public $content;
    public $A = "√";
    public $B = "×";
}

//read_post_data
$exam_id = $_POST['exam_id'];

//20191124
$paper_id = substr($exam_id, 5, 1);

//mysql
$sql="SELECT * FROM judge WHERE num='$paper_id'";
$result = $link -> query($sql);
$judgeArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $judge = new Judge();
        $judge -> id = $row['id'];
        $judge -> content = $row['content'];
        array_push($judgeArray, $judge);
    }
}
$link -> close();

//response
echo json_encode($judgeArray);
