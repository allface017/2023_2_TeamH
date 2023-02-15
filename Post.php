<?php
require "db_connect.php";
session_start();

 //タイトルの記入確認
 if (isset($_POST["Title"])) {
    $_POST["Title"] = htmlspecialchars($_POST["Title"], ENT_QUOTES, "UTF-8");
    $_SESSION["Title"] = $_POST["Title"];
    $Title = $_POST["Title"];

} 

//記事の内容確認
if (isset($_POST["Article_Content"])) {
    $_POST["Article_Content"] = htmlspecialchars($_POST["Article_Content"], ENT_QUOTES, "UTF-8");
    $_SESSION["Article_Content"] = $_POST["Article_Content"];
    $Article_Content = $_POST["Article_Content"];

} 

            //公開・非公開の確認
            if(isset($_POST["exchange"])){
                $_POST["exchange"] = htmlspecialchars($_POST["exchange"],ENT_QUOTES,"UTF-8");
              $_SESSION["exchange"] = $_POST["exchange"];
              $exchange = $_POST["exchange"];

            }







if (isset($_POST["Title"]) && isset($_POST["Article_Content"]) && isset($_POST["exchange"]) ) { 
    // echo "来ました";           
    $sql = "INSERT INTO article (Title,Article_Content,exchange,delete_flag) VALUES (:Title,:Article_Content,:exchange,:delete_flag)";
                //タイトルの記入確認
                    if (isset($_POST["Title"])) {
                        $_POST["Title"] = htmlspecialchars($_POST["Title"], ENT_QUOTES, "UTF-8");
                        $Title = $_POST["Title"];
                    } else {
                        $_SESSION["errTitle"]= 1;
                        // echo "タイトル失敗";
                    }
                    
                    //記事の内容確認
                    if (isset($_POST["Article_Content"])) {
                        $_POST["Article_Content"] = htmlspecialchars($_POST["Article_Content"], ENT_QUOTES, "UTF-8");
                        $Article_Content = $_POST["Article_Content"];
                    } else {
                        $_SESSION["errArticle_Content"] = 1;
                        // echo "記事失敗";
                                }
        
                                //公開・非公開の確認
                                if(isset($_POST["exchange"])){
                                    $_POST["exchange"] = htmlspecialchars($_POST["exchange"],ENT_QUOTES,"UTF-8");
                                    $exchange = $_POST["exchange"];
                                }else {
                                    $_SESSION["errexchange"] = 1;
                                    // echo "公開失敗";
                                    
                                }



                        if (isset($Title) && isset($Article_Content) && isset($exchange)) {
                            $delete= 0;
                            // echo "実行可能";
                        $stm = $pdo->prepare($sql);
                        $stm->bindValue(":Title", $Title, PDO::PARAM_STR);
                        $stm->bindValue(":Article_Content", $Article_Content, PDO::PARAM_STR);
                        $stm->bindValue(":exchange", $exchange, PDO::PARAM_STR);
                        $stm->bindValue(":delete_flag", $delete, PDO::PARAM_STR);
                        $stm->execute();        //sqlの実行
                        header("location:Public-List.php");
                        exit();
                        }else{
                            // echo "sql失敗";
                        header("location:Post.php");
                        exit();
                        }
            }   else {
                // echo "実行失敗";
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
        <input type="text" name="Title"  value="<?php echo  $Title ?>">
        <p>記事の内容<?php if (isset($_SESSION["errArticle_Content"])) {
            echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　記事を入力してください？</a>';
        } ?></p>
      <textarea name="Article_Content" rows="10" cols="100" value="<?php echo  $Article_Content ?>"></textarea><br>
            <p>公開<?php if (isset($_SESSION["errexchange"])) {
                echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　公開・非公開を選択してください？</a>';
                    } ?>
            <input type="radio" name="exchange" value="0" checked>
        <p>非公開
            <input type="radio" name="exchange" value="1">
      <input id="id" type="submit" value="投稿">
    </form>
</body>

</html>
<script>
    window.onload = function submit() {

    }
</script>


