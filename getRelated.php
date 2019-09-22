<?php
include("dbConfig.php");
header('Content-Type: application/json; charset=utf-8');

class Related{
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
$sql="SELECT * FROM related WHERE num='$paper_id'";
$result = $link -> query($sql);
$relatedArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $related = new Related();
        $related -> id = $row['id'];
        $related -> content = $row['content'];
        $related -> A = $row['a'];
        $related -> B = $row['b'];
        $related -> C = $row['c'];
        $related -> D = $row['d'];
        array_push($relatedArray, $related);
    }
}
$link -> close();

//response
echo json_encode($relatedArray);

