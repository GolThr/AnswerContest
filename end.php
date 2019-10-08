<?php
include("dbConfig.php");
//header('Content-Type: application/json; charset=utf-8');
session_start();
if (!isset($_SESSION['exam_id'])) {
    header('Location: index.html');
}
$exam_id = $_SESSION['exam_id'];
$sql = "SELECT score FROM student where exam_id = '$exam_id'";
$result = $link->query($sql);

$score = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>考试结束</title>
</head>
<body>
<h1>考试已结束</h1>
<h2>具体分数还请成绩公布之后查询！</h2>
</body>
</html>