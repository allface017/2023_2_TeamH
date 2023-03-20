<?php
session_start();
require_once 'db_connect.php';
//echo $_POST['user_name'];
//echo $_POST['password'];


//エラーの処理
//ユーザー名とパスワードが入力されているかチェック
if(isset($_POST['user_name']) || isset($_POST['password'])){


//ユーザー名を保管
$_SESSION["user_name"] = $_POST['user_name'];



    if(!empty($_POST['user_name']) && !empty($_POST['password'])){
        
        //ユーザー名を使ってデータベースにユーザーが存在するかチェックする
        $sql="select * from admin where name = :name";
        
        $stm=$pdo->prepare($sql);
        
        $stm->bindValue(':name', $_POST['user_name'], PDO::PARAM_STR);
        
        $stm->execute();
        
        $result=$stm->fetch(PDO::FETCH_ASSOC);
        //echo"<pre>";
        //var_dump($result);
        //echo"<pre>";

    //データベースにあるパスワードと入力されたパスワードが一致するかチェックする
    if(!empty($result)){
        
        //$resultの中にあるパスワードと入力されたパスワードが一致するかどうか
        if($result['password'] === $_POST['password']){
          //ユーザー変更に使うユーザーネームを保存
       

          //
          $_SESSION["id"] = $result['id'];

            // echo 'パスワード一致';

          //保管していたユーザー名を空にする
            $_SESSION["user_name"] = "";

            header("Location:Admin.php");
            //ログインが成功したらadmin.phpにリダイレクトする
        }else{
             echo '<a style="color:#ff0000;font-size: 20px;">ユーザー名またはパスワードが違います。</a><br>';
            // echo '<p">ユーザー名またはパスワードが違います。</p>';
        }
    }
}else{
    echo '<a style="color:#ff0000;font-size: 20px;">　　　　　　未入力の項目があります。</a><br>';
    // echo '<a style="color:#ff0000;font-size: 12px;">未入力の項目があります。</a>';
}
}
//セッションがあったら$user_nameにセッションの値を入れる
if(isset($_SESSION["user_name"] )){
  $user_name = $_SESSION["user_name"];
}
//セッションがなかったら$user_nameにはなにも入れない
else{
  $user_name = "";
}

?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
        <style>
        
           a{
      font-size: 50px;
    color: white;
    text-decoration: none;

  }
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
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
.form a{
    color:red;
    font-size: 15px;
    padding: 5px;
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
    </head>
    <body class="back">
        <a href="index.php" class="topics">スポーツtopics</a>
        <div class="login-page">
            <div class="form">
                <form action="Login.php" method="post">
                        <label for="user_name">ユーザー名</label><br>
                        
                        <input id="user_id" name="user_name" type="text" value="<?php echo $user_name;?>"/><br>
                        <?php if (isset($err['user_name'])) : ?>
                            <?php endif; ?>

                        <label for="">パスワード</label><br>
                
                        <input id="password" name="password" type="password" />
                        <?php if (isset($err['password'])) : ?>
                        <?php endif; ?>
            
                    <div class="loginbutton">
                        <button type="submit" class="roguinn">ログイン</button>
                    </div>
                    <a href="Register.php">新規登録はこちら</a>
                </form>
                        </div>
                        </div>
    </body>
</html>