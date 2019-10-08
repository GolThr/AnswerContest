<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
$data = [];
if (isset($_SESSION['exam_id'])){
    if ($_SESSION['exam_id'] == $_POST['exam_id']){
        if (isset($_SESSION['m_num']) && isset($_SESSION['Type'])){
            $data[0] = $_SESSION['m_num'];
            $data[1] = $_SESSION['Type'];
        } else {
            $data[0] = 0;
            $data[1] = 0;
        }
    }
    else {
        die('Error');
    }
}
echo json_encode($data);