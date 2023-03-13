<?php
   require_once('db_connect.php');

  // Get the ID from GET parameter
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$id = intval($id);

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
    echo "Location: " . $result['Location'] . "<br>";
    echo "Location_Content: " . $result['Location_Content'] . "<br>";
    echo "Location_Images_path: " . $result['Location_Images_path'] . "<br>";
    echo "exchange: " . $result['exchange'] . "<br>";
    echo "Author_id: " . $result['Author_id'] . "<br>";
} else {
    // Display an error message
    echo "記事が見つかりません";
}

// Previous article button
if ($id > 1) {
    $prev_id = $id - 1;
    echo '<a href="view.php?id=' . $prev_id . '"><button>前へ</button></a>';
}

// Next article button
$max_id = $pdo->query("SELECT MAX(id) FROM article WHERE delete_flag = 0 AND exchange = 0")->fetchColumn();
if ($id < $max_id) {
    $next_id = $id + 1;
    echo '<a href="view.php?id=' . $next_id . '"><button>次へ</button></a>';
}
?>