<?php
    header('Content-Type: application/json; charset=utf-8');
    $data = [
        0=>'1',
        1=>'1',
        2=>'9'
    ];
    echo json_encode($data);