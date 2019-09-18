<?php
    header('Content-Type: application/json; charset=utf-8');
    $data=[
        [
            'content' => "宪法的基本原则之一",
            'A' => "由列宁最早提出",
            'B' => "也是是党的根本组织原则",
            'C' => "指民主基础上的集中和集中指导下的民主相结合",
        ]
    ];
    echo json_encode($data);