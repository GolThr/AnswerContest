<?php
include("dbConfig.php");

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
$sql="SELECT * FROM single_select WHERE s_num='$paper_id'";
$result = $link -> query($sql);
$singleSelectArray = Array();
if ($result -> num_rows > 0) {
    $singleSelect = new SingleSelect();
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $singleSelect -> id = $row['single_select_id'];
        $singleSelect -> content = $row['content'];
        $singleSelect -> A = $row['s_a'];
        $singleSelect -> B = $row['s_b'];
        $singleSelect -> C = $row['s_c'];
        $singleSelect -> D = $row['s_d'];
    }
    array_push($singleSelectArray, $singleSelect);
}
$link -> close();

//response
echo json_encode($singleSelectArray);
