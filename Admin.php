<?php
require_once 'Admin-session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者メニュー</title>
    <style>
        h2{
            color: white;
        }
          .back{
            background: linear-gradient(90deg, rgb(22, 135, 237), rgb(20, 55, 90));
            border-radius: 40px 40px 40px 40px;
            width: 80%;
            margin-left: 10%;
            margin-top: 40px;
            padding-top: 10px;
            padding-bottom:100px;
        }
        .title {
            text-align:center;
            font-size: 200%;
        }
        .btn01{
            /*影の基点とするためrelativeを指定*/
            position: relative;
             /*ボタンの形状*/
            text-decoration: none;
            display: inline-block;
            text-align: center;
            background: transparent;
            border-radius: 25px;
            border: solid 1px #333;
            outline: none;
           /*アニメーションの指定*/
            transition: all 0.2s ease;
        }
        .btn01:hover{
             border-color:transparent; 
        }
        /*ボタンの中のテキスト*/
        .btn01 span {
            position: relative;
             z-index: 2;/*z-indexの数値をあげて文字を背景よりも手前に表示*/
            /*テキストの形状*/
            display: block;
            padding: 10px 30px;
            background:#fff;
            border-radius: 25px;
            color:#333;
            /*アニメーションの指定*/
            transition: all 0.3s ease;
        }
        /*影の設定*/
        .pushright:before {
            content: "";
            /*絶対配置で影の位置を決める*/
            position: absolute;
            z-index: -1;
            top: 4px;
            left: 4px;
            /*影の形状*/
            width: 100%;
            height: 100%;
            border-radius: 25px;
            background-color: #333;
        }
        /*hoverの際にX・Y軸に4pxずらす*/
        .pushright:hover span {
            background-color: #333;
            color: #fff;
            transform: translate(4px, 4px);
        }
        .btn02{
            /*影の基点とするためrelativeを指定*/
            position: relative;
             /*ボタンの形状*/
            text-decoration: none;
            display: inline-block;
            text-align: center;
            background: transparent;
            border-radius: 25px;
            border: solid 1px #333;
            outline: none;
           /*アニメーションの指定*/
            transition: all 0.2s ease;
        }
        .btn02:hover{
           border-color:transparent; 
        }
        /*ボタンの中のテキスト*/
        .btn02 span {
            position: relative;
             z-index: 2;/*z-indexの数値をあげて文字を背景よりも手前に表示*/
            /*テキストの形状*/
            display: block;
            padding: 10px 30px;
            background:#fff;
            border-radius: 25px;
            color:#333;
            /*アニメーションの指定*/
            transition: all 0.3s ease;
        }
        /*影の設定*/
        .pushright:before {
            content: "";
            /*絶対配置で影の位置を決める*/
            position: absolute;
            z-index: -1;
            top: 4px;
            left: 4px;
            /*影の形状*/
            width: 100%;
            height: 100%;
            border-radius: 25px;
            background-color: #333;
        }
        /*hoverの際にX・Y軸に4pxずらす*/
        .pushright:hover span {
            background-color: #333;
            color: #fff;
            transform: translate(4px, 4px);
        }
        .button_wrapper2{
            margin-top: 10%;
        }
    </style>
</head>
<body>
<div class="back">
    <div class="title">
        <h2>管理者メニュー</h2>

    <div class="button_wrapper1">
        <a href="Admin-List.php" class="btn01 pushright"><span>記事の一覧</span></a>
    </div>

    <div class="button_wrapper2">
        <a href="Post.php" class="btn02 pushright"><span>記事の投稿</span></a>
    </div>

    <div class="button_wrapper2">
        <a href="userch.php" class="btn02 pushright"><span>ユーザー情報の変更</span></a>
    </div>

    <div class="button_wrapper2">
        <a href="Logout.php" class="btn02 pushright"><span>ログアウト</span></a>
    </div>

    </div>
    </div>
</body>
</html>