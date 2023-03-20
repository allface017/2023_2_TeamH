<?php
require "Admin-session.php";
require "db_connect.php";
  // Get the ID from the session
  
 // Get the ID from the query parameters
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // If ID is not provided, redirect to the index page
    header('Location: Admin-List.php');
    exit;
}

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
          header('Location: Admin-List.php');
          exit;
      } else {
          // Redirect to the index page without deleting the record
          header('Location: Admin-List.php');
          exit;
      }
  }
  
  ?>
  <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>削除ページ</title>
    <style>
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

    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: linear-gradient(90deg, rgb(22, 135, 237), rgb(20, 55, 90))" >
    <h1>削除確認画面</h1>
    <div style="justify-content:center; display:flex;">
      <button>
          <a href="Admin.php" style="text-decoration:none; color:black;">管理者メニューへ</a>
        </button>
    </div>
    <!-- Delete form -->
    <nav style="justify-content:center; display:flex;">
        <form action="delete.php?id=<?php echo $id; ?>" method="post">
            <div style="margin-top: 300%;">
                <input type="submit" name="submit" value="削除する">
                <input type="hidden" name="confirm_delete" value="yes">
            </div>
            <div style="margin-top:50px">
                <input type="submit" name="submit" value="削除しない">
            </div>
        </form>
    </nav>
</body>