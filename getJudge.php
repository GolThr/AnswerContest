<?php
    header('Content-Type: application/json; charset=utf-8');
    $data=[
        [
            'content' => "根据宪法的重要性和地位，宪法被誉为国家的根本大法。",
            'A' => "√",
            'B' => "×",
        ],
        [
            'content' => "受教育权既是公民的权利,也是公民的义务。",
            'A' => "√",
            'B' => "×",
        ]
    ];
    echo json_encode($data);