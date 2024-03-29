<?php
require_once 'db_connect.php';
if (!isset($_SESSION)) {
    session_start();
}
$search = '';
if (!empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
}
$sql = "SELECT * FROM article WHERE exchange = 0 AND delete_flag = 0";
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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>記事の一覧(公開)</title>
    <style>
        a {
            font-size: 50px;
            color: white;
            text-decoration: none;
        }
        h2, p {
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
        th, td {
            border: solid 3px yellowgreen;
            color: greenyellow;
            padding: 10px;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php">TOPメニューへ</a>
    <div class="list">
        <form method="GET" action="search_result.php">
            <input type="text" name="search" value="<?php echo $search; ?>">
            <input type="submit" value="検索">
        </form>
        <table>
            <?php
            foreach ($result as $data) {
                echo '<tr>';
                echo '<td>'.'<a href="view.php?id='.$data["id"].'">';
                print_r($data["Title"]);
                echo '</a>'.'</td>'.'</tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>