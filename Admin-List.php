<?php
require "db_connect.php";
session_start();
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

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

  if(isset($_GET['exchange'])){
      $change = $_GET['exchange'];
  }

    if(isset($_GET['id']) && isset($_GET['exchange'])){

      if($change === "0"){

        $stmt = $pdo->prepare("UPDATE article SET exchange = 1 WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

  $stmt->execute();
  header('Location: Admin-List.php');
  exit;


        } elseif ($change === "1") {

            $stmt = $pdo->prepare("UPDATE article SET exchange = 0 WHERE id = :id");
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            header('Location: Admin-List.php');
            exit;
            }

           }









?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>管理者一覧</title>
    <style>
         a{
          font-size: 30px;
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
                    echo '<td>'.'<a href="view.php?id='.$id.'">';
                    print_r($data["Title"]);
                    echo '</a>'.'</td>';
                    echo '<td>'.'<a href="delete.php?id='.$id.'">'."削除";
                    echo '</a>'.'</td>';
                    echo '<td>'.'<a href="edit.php?id='.$id.'">'."編集";
                    echo '</a>'.'</td>';
                    echo '<td>';
                    $change = $data["exchange"];
                    if($data['exchange'] ===0){
                      echo '<a href="Admin-list.php?id='.$id.'&exchange='.$change.'"> '."公開". '</a>';
                  }else {
                      echo '<a href="Admin-list.php?id='.$id.'&exchange='.$change.'"> '."非公開". '</a>';
                  }
                    echo "</td>".'</tr>';
            }

            ?>
    <div>

</table>

</html>
  <script language="javascript" type="text/javascript">
        function ButtonClick() {
         <?php
           foreach ($result as $data) {
            if($data['exchange'] ===0){
              $stmt = $pdo->prepare("UPDATE article SET exchange = 1 WHERE id = ?");
              $stmt->bindValue(1, $id, PDO::PARAM_INT);
      
              // Execute the update statement
              $stmt->execute();


           } elseif ($data['exchange']) {
            $stmt = $pdo->prepare("UPDATE article SET exchange = 0 WHERE id = ?");
              $stmt->bindValue(1, $id, PDO::PARAM_INT);
      
              // Execute the update statement
              $stmt->execute();

           }
          }
        ?>


    }
</script>