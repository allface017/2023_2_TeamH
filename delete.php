<?php
  // ユーザー名
  $user = "root";
  // パスワード
  $pass = "passward";
  // データベース名
  $database = "databasename";
  // サーバー
  $server = "localhost";

  // DSM文字列の生成
  $dsn = "mysql:host={$server};dbname={$database};charset=utf8";

  // mysqlへの接続
  try{
      // PDOのインスタンスを作成し、DBに接続する
    $pdo = new PDO($dsn, $user, $pass);
    // プリペアドステートメントのエミュレーションを無効か
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 例外がスローされるように変更する
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "成功";
  }catch(Exception $e){
      echo "接続エラー:";
      echo $e -> getMessage();
      exit();
  }
  
  // Get the ID from the session
  session_start();
  $id = $_SESSION['id'];
  
  // Check if the form has been submitted
  if (isset($_POST['submit'])) {
      // Check if the user has confirmed the delete operation
      if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
          // Prepare the update statement
          $stmt = $pdo->prepare("UPDATE article SET delete_flag = 1 WHERE id = ?");
          $stmt->bindValue(1, $id, PDO::PARAM_INT);
  
          // Execute the update statement
          $stmt->execute();
  
          // Redirect to the index page
          header('Location: index.php');
          exit;
      } else {
          // Redirect to the index page without deleting the record
          header('Location: index.php');
          exit;
      }
  }
  
  ?>
  
  <!-- Delete form -->
  <form action="delete.php" method="post">
      <input type="submit" name="submit" value="削除する">
      <input type="hidden" name="confirm_delete" value="yes">
      <input type="submit" name="submit" value="削除しない">
  </form>
  