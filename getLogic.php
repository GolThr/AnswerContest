<?php
    header('Content-Type: application/json; charset=utf-8');
    $data=[
        [
            'content' => "这是题干",
            'A' => "人民代表大会",
            'B' => "全国人民代表大会",
            'C' => "地方各级人民代表大会",
            'D' => "人民代表大会常务委员会"
        ],
    ];
    echo json_encode($data);