<?php
include("dbConfig.php");

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
$sql="SELECT * FROM related WHERE r_num='$paper_id'";
$result = $link -> query($sql);
$relatedArray = Array();
if ($result -> num_rows > 0) {
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $related = new Related();
        $related -> id = $row['related_id'];
        $related -> content = $row['content'];
        $related -> A = $row['r_a'];
        $related -> B = $row['r_b'];
        $related -> C = $row['r_c'];
        $related -> D = $row['r_d'];
        array_push($relatedArray, $related);
    }
}
$link -> close();

//response
echo json_encode($relatedArray);

