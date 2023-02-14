<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!empty($_POST["name"])) {
    $_SESSION["name"] = $_POST["name"];
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事の一覧(公開)</title>
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


    <a href="index.php">TOPメニューへ</a>

<div class="toprankers">
            <?php
            // foreach ($result1 as $data) {

                    // echo '<div class="topslave"' . ' id="topS' . $i . '">';
                    // echo '<h2>' . $i . '.';
                    // print_r($re2[0]["name"]);
                    // echo '：';
                    // print_r($data["score"]);
                    // echo "点" . "</h2>";
                    // echo '<h2>';
                    // print_r($data["comment"]);
                    // echo "</h2>";
                    // echo "<br>";
                    // echo "</div>";
                
            //}

            ?>
        </div>

        <table>
          <tr>
            <td>タイトル</td>
            <td>編集</td>
            <td>削除</td>
          </tr>
      <tr>
        <td>タイトル</td>
        <td>編集</td>
        <td>削除</td>
      </tr>

      <tr>
        <td>タイトル</td>
        <td>編集</td>
        <td>削除</td>
      </tr>

</table>



</html>
<!-- <tr>
    <td>タイトル</td>
    <td>編集</td>
    <td>削除</td>
    <!-- <?php while ($row = $stm->fetchAll(PDO::FETCH_ASSOC)) { ?>
    -->
    <!--     <td><?php echo $row['title']; ?></td>
    <td><a href="edit_post.php?id=<?php echo $row['id']; ?>">編集</a></td>
    <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
  -->
  
  <!--
    <?php } ?> 
  </tr> -->