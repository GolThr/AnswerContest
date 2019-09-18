<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>在线考试系统</title>
        <link href="./css/style.css" rel="stylesheet" type="text/css" />
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./js/main.js"></script>
    </head>
    <body>
    <div id="main">
        <!-- 答题页面 -->
        <div id="top">
            <p id="Type"></p>
            <!-- 倒计时 -->
            <b id="time"></b>
        </div>
        <!-- 题目详情 -->
        <div id="problem">
            <!-- 题目题干 -->
            <strong id="topic_id"></strong><hr><div id="topic"></div>
            <form id="select">
            </form>
        </div>
        <div id="Button">
            <button onclick="Next()">下一题</button>
        </div>
        <!-- 进度条 -->
        <div id="pg">
            <progress max="100" value="" id="pg_p"></progress>
            <b id="pg_b"></b>
        </div>
    </div>
    </body>
</html>
