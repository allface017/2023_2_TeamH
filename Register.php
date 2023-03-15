<?php
require "db_connect.php";
session_start();
if (isset($_POST["name"]) && isset($_POST["pass"]) ) {


    $sql = "INSERT INTO admin (name,password) VALUES(:name,:password)";


    //被った名前を探す
    $sql2 = "select name from admin";
    $stm2 = $pdo->prepare($sql2);
    $stm2->execute();
    $result1 = $stm2->fetchAll(PDO::FETCH_ASSOC);

    //名前被りの確認
    if (empty($result1)) {
        if (isset($_POST["name"])) {
            if ($data["name"] === $_POST["name"]) {
                $_SESSION["errname"] = 1;
                header("location:Register.php");
                exit();
            } else {
                $_POST["name"] = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
                $name = $_POST["name"];
            }
        }
    } else {
        foreach ($result1 as $data) {
            if (isset($_POST["name"])) {
                if ($data["name"] === $_POST["name"]) {
                    $_SESSION["errname"] = 1;
                    header("location:Register.php");
                    exit();
                } else {
                    $_POST["name"] = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
                    $name = $_POST["name"];
                }
            }
        }
    }

    //パスワードの確認
    if (isset($_POST["pass"])) {
        $_POST["pass"] = htmlspecialchars($_POST["pass"], ENT_QUOTES, "UTF-8");
        if (preg_match('/\A[a-z\d]{8,100}+\z/i', $_POST["pass"]) == 1 ) {
            // $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            $pass = $_POST["pass"];
        } else {
            $_SESSION["errpass"] = 1;
            header("location:Register.php");
            exit();
        }
    }

    if (isset($name) && isset($pass)) {
        $stm = $pdo->prepare($sql); //プリペアードステートメントを作成
        $stm->bindValue(":name", $name, PDO::PARAM_STR);
        $stm->bindValue(":password", $pass, PDO::PARAM_STR);
        $stm->execute();        //sqlの実行
        header("location:Login.php");
        exit();
    }
}

?>

<head>

    <title>新規登録</title>
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
<a href="index.php">TOPメニューへ</a>


<div class="login-page">
    <div class="form">
        <form action="Register.php" method="post">
            <h2>新規登録</h2>
            <p>ユーザーネーム
                <?php if (isset($_SESSION["errname"])) {
                    echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　異なる名前を入力してください</a>';
                } ?>
            </p>
            <input type="text" name="name" placeholder="ユーザーネーム"/>
        <p>パスワード<?php if (isset($_SESSION["errpass"])) {
                    echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　アルファベットと数字だけで8文字以上書いてね？</a>';
                } ?></p>
            <input type="password" name="pass" placeholder="パスワード"/>
            <div class="loginbutton">
                        <button type="submit" class="roguinn">登録</button>
                    </div>
    </form>

        <!-- <input type="text" name="name"><br>

        <input type="password" name="pass"><br>

    </form> -->
</body>

</html>
<!-- <script>
    window.onload = function submit() {
    }
</script> -->
<!-- <style>
     a{
      font-size: 50px;
    color: white;
    text-decoration: none;

  }
    h2,p {
        color: white;
    }
    body {
        background: linear-gradient(90deg, rgb(22, 135, 237), rgb(20, 55, 90));
        height: 10rem;
        text-align: center;
    }
    form {
    background: white;
    width: 50%;
    padding: 10px 10px;
    margin: auto;
    top: 50%;
    left: 50%;
    border: solid 3px white;
    text-align: center;
    }
    .btn02{
        color: grey;
        width: 100px;
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
    
</style> -->