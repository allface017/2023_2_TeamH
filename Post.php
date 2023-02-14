<?php
require "db_connect.php";
session_start();
if (isset($_POST["Title"]) && isset($_POST["Article-Content"]) && isset($_SESSION["errexchange"]) ) {            
    $sql = "INSERT INTO Article (Title,Article-Content,exchange) VALUES(:Title,:Article-Content,:exchange)";
                //タイトルの記入確認
                    if (isset($_POST["Title"])) {
                        $_POST["Title"] = htmlspecialchars($_POST["Title"], ENT_QUOTES, "UTF-8");
                        $Title = $_POST["Title"];
                    } else {
                        $_SESSION["errTitle"]= 1;
                        }
                    
               
                        
                //記事の内容確認
                    if (isset($_POST["Article-Content"])) {
                        $_POST["Article-Content"] = htmlspecialchars($_POST["Article-Content"], ENT_QUOTES, "UTF-8");
                        $Article_Content = $_POST["Article-Content"];
                    } else {
                            $_SESSION["errArticle-Content"] = 1;
                        }
                        //公開・非公開の確認
                        if(isset($_POST["exchange"])){
                            $_POST["exchange"] = htmlspecialchars($_POST["exchange"],ENT_QUOTES,"UTF-8");
                            $exchange = $_POST["exchange"];
                        }else {
                            $_SESSION["errexchange"] = 1;
            
                        }
            
            
            
                if (isset($Title) && isset($Article_Content) && isset($exchange)) {
                    $stm = $pdo->prepare($sql); //プリペアードステートメントを作成
                    $stm->bindValue(":Title", $Title, PDO::PARAM_STR);
                    $stm->bindValue(":Article-Content", $Article_Content, PDO::PARAM_STR);
                    $stm->bindValue(":exchange", $exchange, PDO::PARAM_STR);
                    $stm->execute();        //sqlの実行
                    header("location:Post-List.php");
                    exit();
                }else{
                    header("location:Post.php");
                    exit();
                }
            }   
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="CSS/Register.css">
    <style>
        h2,p {
            color: white;
        }

        body {
            background: linear-gradient(90deg, rgb(22, 135, 237), rgb(20, 55, 90));
        }
        form {
        width: 50%;
        padding: 10px 10px;
        margin: auto;
        top: 50%;
        left: 50%;
        border: solid 3px white;
        text-align: center;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form action="Post.php" method="post">
        <h2>記事の投稿</h2>
        <p>タイトル
            <?php if (isset($_SESSION["errTitle"])) {
                echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　タイトルを入力してください？</a>';
            } ?>
        </p>
        <input type="text" name="Title">
        <p>記事の内容<?php if (isset($_SESSION["errArticle-Content"])) {
            echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　記事を入力してください？</a>';
        } ?></p>
      <textarea name="Article-Content" rows="10" cols="100"></textarea><br>
            <p>公開<?php if (isset($_SESSION["errexchange"])) {
                echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　公開・非公開を選択してください？</a>';
                    } ?>
            <input type="radio" name="exchange" value="0" checked>
        <p>非公開
            <input type="radio" name="exchange" value="1">
            <p>おすすめの場所</p>
        <input type="text" name="Location">
        <p>おすすめの場所の内容</p>
      <textarea name="Location-Content" rows="10" cols="100"></textarea><br>
        


      <input id="id" type="submit" value="投稿">
    </form>
</body>

</html>
<script>
    window.onload = function submit() {
        <?php
        session_destroy();
        ?>
    }
</script>