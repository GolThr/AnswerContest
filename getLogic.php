<?php
    header('Content-Type: application/json; charset=utf-8');
$exam_id = $_POST['exam_id'];
    $data=[
        [
            'content' => "$exam_id[4]",
            'A' => "人民代表大会",
            'B' => "全国人民代表大会",
            'C' => "地方各级人民代表大会",
            'D' => "人民代表大会常务委员会"
        ],
    ];
    echo json_encode($data);