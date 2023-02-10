<?php
require "db_connect.php";
session_start();
if (isset($_POST["Title"]) && isset($_POST["Article-Content"]) && isset($_POST["pass"]) && isset($_POST["repass"])) {


    $sql = "INSERT INTO users (Title,Article-Content,password) VALUES(:Title,:Article-Content,:password)";




    //タイトルの記入確認

        if (isset($_POST["Title"])) {
            $_POST["Title"] = htmlspecialchars($_POST["Title"], ENT_QUOTES, "UTF-8");
            $Title = $_POST["Title"];
        } else {
            $_SESSION["errTitle"]= 1;
            header("location:Post.php");
            exit();
            }
        }
   
            
    //記事の内容確認
        if (isset($_POST["Article-Content"])) {
            $_POST["Article-Content"] = htmlspecialchars($_POST["Article-Content"], ENT_QUOTES, "UTF-8");
            $Article_Content = $_POST["Article-Content"];
        } else {
                $_SESSION["errArticle-Content"] = 1;
                header("location:Post.php");
                exit();
            }





    if (isset($Title) && isset($Article_Content) && isset($pass)) {
        $stm = $pdo->prepare($sql); //プリペアードステートメントを作成
        $stm->bindValue(":Title", $Title, PDO::PARAM_STR);
        $stm->bindValue(":Article-Content", $Article_Content, PDO::PARAM_STR);
        $stm->bindValue(":password", $pass, PDO::PARAM_STR);
        $stm->execute();        //sqlの実行
        header("location:Post.php");
        exit();
    }

?>

<head>

    <title>記事投稿ページ</title>

</head>

<body>

    <form action="Post.php" method="post">
        <h2>記事の投稿</h2>
        <p>タイトル
            <?php if (isset($_SESSION["errTitle"])) {
                echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　タイトルを入力してください？</a>';
            } ?>
        </p>
        <input type="text" Title="Title"><br>
        <p>記事の内容<?php if (isset($_SESSION["errArticle-Content"])) {
                        echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　記事を入力してください？</a>';
                    } ?></p><br>
      <textarea Title="Article-Content" rows="10" cols="40"></textarea><br>
            <p>公開</p>
            <input type="radio" Title="exchange" value="0" require>
            <p>非公開</p>
            <input type="radio" Title="exchange" value="1">
            <p>おすすめの場所</p>
        <input type="text" Title="Location"><br>
        <p>おすすめの場所の内容</p><br>
      <textarea Title="Location-Content" rows="10" cols="40"></textarea><br>
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