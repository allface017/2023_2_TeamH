
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>記事閲覧機能
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



</body>

</html>
<?php
require_once('db_connect.php');

// Get the ID from GET parameter
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$id = intval($id);

// Find the previous article ID
$prev_id = $id - 1;
while ($prev_id > 0) {
    $stmt = $pdo->prepare("SELECT id FROM article WHERE id = ? AND delete_flag = 0 AND exchange = 0");
    $stmt->bindValue(1, $prev_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetchColumn()) {
        break;
    }
    $prev_id--;
}

// Find the next article ID
$max_id = $pdo->query("SELECT MAX(id) FROM article WHERE delete_flag = 0 AND exchange = 0")->fetchColumn();
$next_id = $id + 1;
while ($next_id <= $max_id) {
    $stmt = $pdo->prepare("SELECT id FROM article WHERE id = ? AND delete_flag = 0 AND exchange = 0");
    $stmt->bindValue(1, $next_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetchColumn()) {
        break;
    }
    $next_id++;
}

// Prepare the SELECT statement
$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? AND delete_flag = 0 AND exchange = 0");
$stmt->bindValue(1, $id, PDO::PARAM_INT);

// Execute the SELECT statement
$stmt->execute();

// Fetch the results
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the result is not empty
if (!empty($result)) {
    // Display the result
    echo "Title: " . $result['Title'] . "<br>";
    echo "Article_Content: " . $result['Article_Content'] . "<br>";

} else {
    // Display an error message
    echo "記事が見つかりません";
}

// Previous article button
if ($prev_id >= 1) {
    echo '<a href="view.php?id=' . $prev_id . '"><button>前へ</button></a>';
}

// Next article button
if ($next_id <= $max_id) {
    echo '<a href="view.php?id=' . $next_id . '"><button>次へ</button></a>';
}
?>