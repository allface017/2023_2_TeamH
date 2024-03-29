<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事閲覧機能(管理者)
    </title>

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
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
a{
    font-size: 50px;
  color: white;
  text-decoration: none;

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
p{
    color:white;
    
}
h2,h3{
  color:white;
}


</style>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<a href="admin.php">管理者メニューへ</a>

</body>

</html>
<?php
require_once 'db_connect.php';
require_once 'Admin-session.php';

// Get the ID from GET parameter
$id = isset($_GET['arid']) ? $_GET['arid'] : 1;
$id = intval($id);






// Find the previous article ID
//今見ている記事のidよりちいさいid & 削除されていないものを一件だけ取得する


  $stmt = $pdo->prepare("SELECT id FROM article WHERE id < ? AND delete_flag = 0  order by id desc limit 1 ");
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $min_id = $stmt->fetch(PDO::FETCH_ASSOC);

  //var_dump($min_id);
// Find the next article ID

//今見ている記事のidより大きいid & 削除されていないものを一件だけ取得する
    $stmt = $pdo->prepare("SELECT id FROM article WHERE id > ? AND delete_flag = 0  order by id asc limit 1");
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $max= $stmt->fetch(PDO::FETCH_ASSOC);

  
  // Prepare the SELECT statement
  $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? AND delete_flag = 0");
  $stmt->bindValue(1, $id, PDO::PARAM_INT);

  // Execute the SELECT statement
  $stmt->execute();
  
  // Fetch the results
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Check if the result is not empty
  if (!empty($result)) {
    // Display the result
    echo "<h3>Title:</h3> <p>" . $result['Title'] . "</p>";
    echo "<h3>Article_Content:</h3> <p>" . $result['Article_Content'] . "</p>";
    
  } else {
    // Display an error message
    echo "記事が見つかりません";
  }
  
//Previous article button
if ($min_id >= $id) {
  echo '<a href="admin_view.php?arid=' . $min_id['id'] . '"><button>前へ</button></a>';
}

// Next article button
if ($id <= $max['id']) {
  echo '<a href="admin_view.php?arid=' . $max['id']. '"><button>次へ</button></a>';
}
  echo '<br>';
  
  //記事に書かれたコメントを取得
  $sql = "select * from Comment WHERE arid = ?";
  $stm = $pdo->prepare($sql); //プリペアードステートメントを作成
  $stm->bindValue(1, $id, PDO::PARAM_INT);
  $stm->execute();
  $result1= $stm->fetchAll(PDO::FETCH_ASSOC);
  
  //コメントを表示
  if(!empty($_SESSION["id"])){

    //ユーザidを取得
    $userid = $_SESSION["id"];
    
    //コメント取得
    
  $i =0;
  if(!empty($result)){
    
    foreach ($result1 as $data) {
    $i += 1;
    echo "<p>コメント".$i."：".$data['Comment']."</p>";
    
  }
  
}

echo 
'<div class="button_wrapper2"> 
<a href="ComPost.php?userid='.$userid.'&arid='.$id.'" class="btn01 pushright">
<span>コメント投稿はこちら</span></a>
</div>
';

}

?>