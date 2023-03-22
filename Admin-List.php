<?php 
require_once 'Admin-session.php';
require_once 'db_connect.php';
if (!isset($_SESSION)) {
    session_start();
}
$search = '';
if (!empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
}
$sql = "SELECT * FROM article WHERE delete_flag = 0";
if (!empty($search)) {
    $sql .= " AND (Title LIKE :search OR Article_Content LIKE :search)";
}
$sql .= " ORDER BY id ASC";
$stm = $pdo->prepare($sql);
if (!empty($search)) {
    $stm->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);
}
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

//記事idの取得
if (isset($_GET['arid'])) {
  $id = $_GET['arid'];
}
//公開・非公開の取得
  if(isset($_GET['exchange'])){
      $change = $_GET['exchange'];
  }

    if(isset($_GET['arid']) && isset($_GET['exchange'])){

      if($change === "0"){
//記事を非公開にする処理
        $stmt = $pdo->prepare("UPDATE article SET exchange = 1 WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

  $stmt->execute();
  header('Location: Admin-List.php');
  exit;

//非公開に設定されているなら
        } elseif ($change === "1") {
//記事を公開にする処理
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
        .btn01{
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
        .btn01:hover{
             border-color:transparent; 
        }
        /*ボタンの中のテキスト*/
        .btn01 span {
            position: relative;
             z-index: 2;/*z-indexの数値をあげて文字を背景よりも手前に表示*/
            /*テキストの形状*/
            display: block;
            padding: 2px 5px;
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
            width: 50%;
            height: 50%;
            border-radius: 25px;
            background-color: #333;
        }
        /*hoverの際にX・Y軸に4pxずらす*/
        .pushright:hover span {
            background-color: #333;
            color: #fff;
            transform: translate(4px, 4px);
        }
        .btn02{
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
            background-color: ;
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
    </style>
    <link rel="stylesheet" href="style.css">
</head>


<body>

    <a href="Admin.php">管理者メニューへ</a>

    <div class="list">
    <form method="GET" action="admin_result.php">
            <input type="text" name="search" value="<?php echo $search; ?>">
            <input type="submit" value="検索">
    </form>
  <table>
            <?php
            foreach ($result as $data) {
              $id = $data["id"];
                    echo '<tr>';
                    echo '<td>'.'<a  href="admin_view.php?arid='.$id.'">'.'<span>';
                    print_r($data["Title"]);
                    echo '</span>'.'</a>'.'</td>';
                    echo '<td>'.'<div class="button_wrapper1">'.'<a class="btn01 pushright" href="delete.php?id='.$id.'">'.'<span>'."削除";
                    echo '</span>'.'</a>'.'</div>'.'</td>';
                    echo '<td>'.'<div class="button_wrapper1">'.'<a class="btn01 pushright" href="edit.php?id='.$id.'">'.'<span>'."編集";
                    echo '</span>'.'</a>'.'</div>'.'</td>';
                    echo '<td>';
                    $change = $data['exchange'];
                    if($data['exchange'] ===0){
                      echo '<a class="btn01 pushright" href="Admin-list.php?arid='.$id.'&exchange='.$change.'"> '.'<span>'."公開".'</span>'. '</a>';
                  }else {
                      echo '<a class="btn01 pushright" href="Admin-list.php?arid='.$id.'&exchange='.$change.'"> '.'<span>'."非公開".'</span>'.'</a>';
                  }
                    echo "</td>".'</tr>';
            }

            ?>
    <div>

</table>

</html>

  <!-- <script language="javascript" type="text/javascript">
        function btn01 pushrightClick() {


          
           foreach ($result as $data) {
            if($data['exchange'] ===0){
              //記事を非公開SQL
              $stmt = $pdo->prepare("UPDATE article SET exchange = 1 WHERE id = ?");
              $stmt->bindValue(1, $id, PDO::PARAM_INT);
      
              //実行
              $stmt->execute();


           } elseif ($data['exchange'] === 1) {
            //記事の公開SQL
            $stmt = $pdo->prepare("UPDATE article SET exchange = 0 WHERE id = ?");
              $stmt->bindValue(1, $id, PDO::PARAM_INT);
      
            //実行
              $stmt->execute();

           }
          }

    }
</script> -->