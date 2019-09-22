<?php
include("dbConfig.php");
//header('Content-Type: application/json; charset=utf-8');
$exam_id = $_GET['exam_id'];
$sql="SELECT score FROM student where exam_id = '$exam_id'";
$result=$link->query($sql);

$score=mysqli_fetch_array($result,MYSQLI_ASSOC);
var_dump( $score);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>考试结束</title>
</head>
<body>
<h1>考试已结束</h1>
<h2>你目前客观题分数为：<?php echo $score['score']; ?></h2>
<h2>具体分数还请成绩公布之后查询！</h2>
</body>
</html>