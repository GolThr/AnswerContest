<?php
include("dbConfig.php");

class SingleSelect{
    public $id;
    public $content;
    public $A;
    public $B;
    public $C;
    public $D;
    public $E;
    public $F;
}

//read_post_data
$exam_id = $_POST['exam_id'];

//20191124
$paper_id = substr($exam_id, 5, 1);
echo $paper_id;

//mysql
$sql="SELECT * FROM single_select WHERE s_num='$paper_id'";
$result = $link -> query($sql);

$singleSelect = new SingleSelect();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $singleSelect -> id = $row['id'];
        $singleSelect -> content = $row['content'];
        $singleSelect -> A = $row['A'];
        $singleSelect -> B = $row['B'];
        $singleSelect -> C = $row['C'];
        $singleSelect -> D = $row['D'];
        $singleSelect -> E = $row['E'];
        $singleSelect -> F = $row['F'];
    }
}
$link -> close();

//response
echo json_encode($singleSelect);

