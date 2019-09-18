<?php
    header('Content-Type: application/json; charset=utf-8');
    if (isset($_POST)){
        if (isset($_POST['exam_id']) && isset($_POST['name'])){
            $exam_id = $_POST['exam_id'];
            $name = $_POST['name'];
            if ($exam_id == '123456' && $name == '张三'){
                echo '{
                    "ifsuccess": 1,
                    "school": "QFNU",
                    "region": "QD"
                    }';
            } else {
                echo '{
                    "ifsuccess": 0
                    }';
            }
        }
    }