<?php
    header('Content-Type: application/json; charset=utf-8');
    $data=[
        [
            'content' => "我国宪法规定，中华人民共和国公民对于任何国家机关和国家工作人员的违法失职行为，有向有关国家机关提出（  ）的权利。",
            'A' => "申诉",
            'B' => "上诉",
            'C' => "控告",
            'D' => "检举"
        ],
        [
            'content' => "现行宪法规定，宪法的修改，由 (   )提议，并由全国人民代表大会通过。 ",
            'A' => "全国人民代表大会主席团",
            'B' => "全国人大常委会",
            'C' => "全国人民代表大会的各个专门委员会",
            'D' => "1/5 以上的全国人民代表大会代表"
        ]
    ];
    echo json_encode($data);