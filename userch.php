<?php
require "Admin-session.php";
require "db_connect.php";

$id = $_SESSION["id"];

$sql0 = "SELECT * FROM admin WHERE id = :id";
//プリペアードステートメントを作成
$stm0 = $pdo->prepare($sql0); 
$stm0->bindValue(":id",$id, PDO::PARAM_STR);
$stm0->execute();        //sqlの実行
$result = $stm0->fetch(PDO::FETCH_ASSOC);


$username = $result['name'];
$password = $result['password'];

if (isset($_POST["name"]) && isset($_POST["pass"]) ) {



    //被った名前を探す
    $sql2 = "select name from admin";
    $stm2 = $pdo->prepare($sql2);
    //sqlの実行
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
                    header("location:userch.php");
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
            header("location:userch.php");
            exit();
        }
    }

    if (isset($name) && isset($pass)) {
      $stmt = $pdo->prepare("UPDATE admin SET name = ?, password = ?  WHERE id = ?");
      $stmt->bindValue(1, $name, PDO::PARAM_STR);
      $stmt->bindValue(2, $pass, PDO::PARAM_STR);
      $stmt->bindValue(3, $id, PDO::PARAM_INT);
      $stmt->execute();
        header("location:Admin.php");
        exit();
    }
}

?>

<head>

    <title>ユーザ情報変更</title>
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
<a href="admin.php">管理者メニューへ</a>


<div class="login-page">
    <div class="form">
        <form action="userch.php" method="post">
            <h2></h2>
            <p>ユーザーネーム
                <?php if (isset($_SESSION["errname"])) {
                    echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　異なる名前を入力してください</a>';
                } ?>
            </p>
            <input type="text" name="name" value="<?php echo $result['name']; ?>">
        <p>パスワード<?php if (isset($_SESSION["errpass"])) {
                    echo '<a style="color:#ff0000;font-size: 12px;">　　　　　　アルファベットと数字だけで8文字以上書いてね？</a>';
                } ?></p>
            <input type="password" name="pass"  value="<?php echo $result['password']; ?>">
            <div class="loginbutton">
                        <button type="submit" class="roguinn">変更</button>
                    </div>
    </form>

        <!-- <input type="text" name="name"><br>

        <input type="password" name="pass"><br>

    </form> -->
</body>

</html>