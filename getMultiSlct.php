<?php
include("dbConfig.php");
header('Content-Type: application/json; charset=utf-8');

class MultiSelect{
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
$sql="SELECT * FROM multi_select WHERE num='$paper_id'";
$result = $link -> query($sql);
$multiSelectArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $multiSelect = new MultiSelect();
        $multiSelect -> id = $row['id'];
        $multiSelect -> content = $row['content'];
        $multiSelect -> A = $row['a'];
        $multiSelect -> B = $row['b'];
        $multiSelect -> C = $row['c'];
        $multiSelect -> D = $row['d'];
        array_push($multiSelectArray, $multiSelect);
    }
}
$link -> close();

//response
echo json_encode($multiSelectArray);

