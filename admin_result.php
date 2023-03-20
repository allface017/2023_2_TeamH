<?php
require_once 'db_connect.php';
require_once 'Admin-session.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
    $sql = "SELECT * FROM article WHERE delete_flag = 0 AND Title LIKE :search";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':search', '%'.$search.'%', PDO::PARAM_STR);    
} else {
    header('Location: Admin_list.php');
    exit;
}

$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>検索結果(管理者)</title>
    <style>
        a {
            font-size: 50px;
            color: white;
            text-decoration: none;
        }
        li{
            list-style:none;
        }

        ul{
            padding-left:0
        }
        h2, p {
            font-size: 30px;
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
    <h1>検索結果</h1>
    <?php $count =  count($result);
    echo $count."件見つかりました。";?>
    <?php if (count($result) > 0): ?>
        <ul>
            <?php foreach ($result as $row): ?>
                <li><a href="admin_view.php?id=<?php echo $row['id']; ?>"><?php echo $row['Title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>該当する記事がありませんでした。</p>
    <?php endif; ?>
</body>
</html>