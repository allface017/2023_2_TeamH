<?php
require "db_connect.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!empty($_POST["name"])) {
    $_SESSION["name"] = $_POST["name"];
}

$sql = "select * from article WHERE delete_flag = 0 order by id asc";
$stm = $pdo->prepare($sql); //プリペアードステートメントを作成
$stm->execute();
$result= $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>管理者一覧</title>
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
        form {
        width: 50%;
        padding: 10px 10px;
        margin: auto;
        top: 50%;
        left: 50%;
        border: solid 3px white;
        text-align: center;
        }
        table {
          width: 50%;
        padding: 10px 10px;
        margin: auto;
        top: 50%;
        left: 50%;

        text-align: center;
        border-collapse:  collapse;  
        }
        th,td {
        border: solid 3px yellowgreen;     
        color: greenyellow;
        padding: 10px;    
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>


<body>

    <a href="Admin.php">管理者メニューへ</a>

    <div class="list">
  <table>
            <?php
            foreach ($result as $data) {
              $id = $data["id"];
                    echo '<tr>';
                    echo '<td>'.'<a href="Article.php?id='.$id.'">';
                    print_r($data["Title"]);
                    echo '</a>'.'</td>';
                    echo '<td>'.'<a href="delete.php?id="'.$id.'">'."削除";
                    echo '</a>'.'</td>';
                    echo '<td>'.'<a href="editing.php?id="'.$id.'">'."編集";
                    echo '</a>'.'</td>'.'</tr>';
            }

            ?>
    <div>

</table>

</html>