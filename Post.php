<?php
require_once 'Admin-session.php';
require "db_connect.php";
 //タイトルの記入確認
 if (!empty($_POST["Title"])) {
    $_POST["Title"] = htmlspecialchars($_POST["Title"], ENT_QUOTES, "UTF-8");
    $_SESSION["Title"] = $_POST["Title"];
    $Title = $_POST["Title"];
} 
//記事の内容確認
if (!empty($_POST["Article_Content"])) {
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
if (!empty($_POST["Title"]) && !empty($_POST["Article_Content"]) && isset($_POST["exchange"]) ) { 
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
                        $stm->bindValue(":exchange", $exchange, PDO::PARAM_BOOL);
                        $stm->bindValue(":delete_flag", $delete, PDO::PARAM_BOOL);
                        $stm->execute();        //sqlの実行
                        header("location:Admin-List.php");
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
    <title>記事投稿ページ</title>
    
    <style>
a{
      font-size: 50px;
    color: white;
    text-decoration: none;

  }
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 500px;
  padding: 3% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: rgb(141,194,111);
  background: linear-gradient(90deg, rgb(22, 135, 237), rgb(20, 55, 90));
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;     
  height: 10rem;
  text-align: center; 
}
</style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="Admin.php">管理者メニューへ</a>

<div class="login-page">
    <div class="form">
    <form action="Post.php" method="post">
        <h2>記事の投稿</h2>
        <p>タイトル
            <?php if (!empty($_SESSION["errTitle"])) {
                echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　タイトルを入力してください？</a>';
            } ?>
        </p>
        <input type="text" name="Title" placeholder="タイトル" value="<?php if(isset($Title)){  
            echo  $Title ;
        } ?>">
        <p>記事の内容<?php if(!empty($_SESSION["errArticle_Content"])) {
            echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　記事を入力してください？</a>';
        } ?></p>
      <textarea name="Article_Content" rows="10" cols="50" placeholder="記事本文"><?php if(isset($Article_Content)){  
      echo $Article_Content;
      }?></textarea><br>
            <p>公開<?php if(!empty($_SESSION["errexchange"])) {
                echo '<a style="color:#ff0000";font-size: 12px;>　　　　　　公開・非公開を選択してください？</a>';
                    } ?>
            <input type="radio" name="exchange" value="0" checked>
        <p>非公開
            <input type="radio" name="exchange" value="1">
            <br>

            <div class="loginbutton">
                        <button type="submit" class="roguinn">投稿</button>
                    </div>
    </form>
            </div>
    </div>
</body>

</html>
<script>
    window.onload = function submit() {

    }
</script>