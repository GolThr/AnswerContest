<?php
include("dbConfig.php");
header('Content-Type: application/json; charset=utf-8');

class SingleSelect{
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
$sql="SELECT * FROM single_select WHERE num='$paper_id'";
$result = $link -> query($sql);
$singleSelectArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $singleSelect = new SingleSelect();
        $singleSelect -> id = $row['id'];
        $singleSelect -> content = $row['content'];
        $singleSelect -> A = $row['a'];
        $singleSelect -> B = $row['b'];
        $singleSelect -> C = $row['c'];
        $singleSelect -> D = $row['d'];
        array_push($singleSelectArray, $singleSelect);
    }

}
$link -> close();

//response
echo json_encode($singleSelectArray);
