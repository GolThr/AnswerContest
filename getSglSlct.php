<?php
    header('Content-Type: application/json; charset=utf-8');
    $data = [
        [
            'content' => "下列哪种说法是不正确的?",
            'A' => "饲养的动物造成他人损害的，动物饲养人或管理人应当承担民事责任",
            'B' => "由于受害人过错造成损害的，动物饲养人或管理人应当不承担民事责任",
            'C' => "由于第三人的过错造成损害的，第三人应当承担民事责任",
            'D' => "只要被动物咬伤，都要由动物主人赔偿"
        ]
    ];
    echo json_encode($data);