<?php
include("service/dbConfig.php");

class User{
    public $ifsuccess = '0';
    public $exam_id;
    public $name;
    public $school;
    public $region;
    public $score = 0;
}

//read_post_data
$exam_id = $_POST['exam_id'];
$name = $_POST['name'];

//mysql
$sql="SELECT * FROM student WHERE exam_id='$exam_id' AND name='$name'";
$result = $link -> query($sql);

$user = new User();
if ($result -> num_rows > 0) {
    $user -> ifsuccess = '1';
    // 输出每行数据
    while($row = $result -> fetch_assoc()) {
        $user -> exam_id = $row['exam_id'];
        $user -> name = $row['name'];
        $user -> school = $row['school'];
        $user -> region = $row['region'];
    }
} else {
    $user -> ifsuccess = '0';
}
$link -> close();

//response
echo json_encode($user);
