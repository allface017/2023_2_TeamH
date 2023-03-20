<?php
require_once 'Admin-session.php';
require "db_connect.php";

if(isset($_GET['arid'])){
  $arid = isset($_GET['arid']) ? $_GET['arid'] : 1;
  $arid = intval($arid);
  $_SESSION['arid'] = $arid;
}
if(isset($_SESSION['arid'])) {
  $arid = $_SESSION['arid'];
}

if(isset($_GET['userid'])){
  $userid = isset($_GET['userid']) ? $_GET['userid'] : 1;
  $userid= intval($userid);
  $_SESSION['userid'] = $userid;
}
if(isset($_SESSION['arid'])) {
  $userid = $_SESSION['userid'];
} 


//タイトルの記入確認
if (isset($_POST["Comment"])) {
    $_POST["Comment"] = htmlspecialchars($_POST["Comment"], ENT_QUOTES, "UTF-8");
    $_SESSION["Comment"] = $_POST["Comment"];
    $Comment = $_POST["Comment"];

} 







if (isset($_POST["Comment"])) { 
    // コメントSQL           
    $sql = "INSERT INTO Comment (Comment,userid,arid) VALUES (:Comment,:userid,:arid)";
                //タイトルの記入確認
                    if (isset($_POST["Comment"])) {
                        $_POST["Comment"] = htmlspecialchars($_POST["Comment"], ENT_QUOTES, "UTF-8");
                        $Comment = $_POST["Comment"];
                    } else {
                        $_SESSION["errComment"]= 1;
                        // echo "コメント失敗";
                    }

                    





                        if (isset($Comment) && isset($arid) && isset($userid)) {
                            $delete= 0;
                            // echo "実行可能";
                        $stm = $pdo->prepare($sql);
                        $stm->bindValue(":Comment", $Comment, PDO::PARAM_STR);
                        $stm->bindValue(":userid",$userid,PDO::PARAM_INT);
                        $stm->bindValue(":arid",$arid,PDO::PARAM_INT);
                        $stm->execute();        //sqlの実行
                        header("location:admin_view.php?arid=".$arid);
                        exit();
                      }else{
                            // echo "sql失敗";
                            header("location:ComPost.php?userid=".$userid."&arid=".$arid);
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
    <title>コメント投稿ページ</title>
    
    
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
    <form action="ComPost.php" method="post">
        <h2>コメントの投稿</h2>
        <p>コメント:
            <?php if (isset($_SESSION["errComment"])) {
                echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　コメントが正しくないです？</a>';
            } ?>
        </p>
        <input type="text" name="Comment" placeholder="コメント" value="<?php if(isset($Comment)){  
            echo  $Comment ;
        } ?>">

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


