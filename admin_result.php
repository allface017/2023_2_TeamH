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
    <title>検索結果</title>
</head>
<body>
    <h1>検索結果</h1>
    <?php if (count($result) > 0): ?>
        <ul>
            <?php foreach ($result as $row): ?>
                <li><a href="view.php?id=<?php echo $row['id']; ?>"><?php echo $row['Title']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>該当する記事がありませんでした。</p>
    <?php endif; ?>
</body>
</html>