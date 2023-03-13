<?php
require_once 'db_connect.php';

// Get the ID from the URL
$id = $_GET['id'];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $Title = $_POST['Title'];
    $Article_Content = $_POST['Article_Content'];
    $exchange = $_POST['exchange'];

    // Update the article in the database
    $stmt = $pdo->prepare("UPDATE article SET Title = ?, Article_Content = ?, exchange = ? WHERE id = ?");
    $stmt->bindValue(1, $Title, PDO::PARAM_STR);
    $stmt->bindValue(2, $Article_Content, PDO::PARAM_STR);
    $stmt->bindValue(3, $exchange, PDO::PARAM_INT);
    $stmt->bindValue(4, $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to the index page
    header('Location: Admin-List.php');
    exit();
}

// Prepare the SELECT statement
$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
$stmt->bindValue(1, $id, PDO::PARAM_INT);

// Execute the SELECT statement
$stmt->execute();

// Fetch the results
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the result is not empty
if (!empty($result)) {
    // Display the form with the article data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>記事編集ページ</title>

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
  a{
      font-size: 50px;
    color: white;
    text-decoration: none;

  }
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
    <form  method="post">
        <label for="Title">タイトル:</label><br>
        <input type="text" id="Title" name="Title" value="<?php echo $result['Title']; ?>"><br>
        <label for="Article_Content">内容:</label><br>
        <textarea id="Article_Content" name="Article_Content" rows="10" cols="50" ><?php echo $result['Article_Content']; ?></textarea><br>
        <div>
            <p>公開設定</p>
            <label for="exchange1">公開</label>
            <input type="radio" name="exchange" id="exchange1" value="0" <?php if($result['exchange'] == 0) echo "checked"; ?>>
            <label for="exchange2">非公開</label>
            <input type="radio" name="exchange" id="exchange2" value="1" <?php if($result['exchange'] == 1) echo "checked"; ?>>
        </div>
        <input id="id" class="btn02 pushright" type="submit" value="変更">
    </form>
    </div>
  </div>

<?php
} else {
    // Display an error message
    echo "記事が見つかりません";
}
?>