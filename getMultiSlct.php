<?php
include("dbConfig.php");

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
$sql="SELECT * FROM multi_select WHERE m_num='$paper_id'";
$result = $link -> query($sql);
$multiSelectArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $multiSelect = new MultiSelect();
        $multiSelect -> id = $row['multi_select_id'];
        $multiSelect -> content = $row['content'];
        $multiSelect -> A = $row['m_a'];
        $multiSelect -> B = $row['m_b'];
        $multiSelect -> C = $row['m_c'];
        $multiSelect -> D = $row['m_d'];
        array_push($multiSelectArray, $multiSelect);
    }
}
$link -> close();

//response
echo json_encode($multiSelectArray);

