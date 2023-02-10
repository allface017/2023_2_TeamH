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
    <title>管理者一覧</title>

</head>


<body>
<div class="ly_section_inner">
    <a class="el_lv2Heading" href="Admin.php">管理者メニューへ</a>
    <!-- ここから3カラム記事エリア -->
    <ul class="card_items">
      <li>
        <a class="card_item" href="#">
          <article>
            <figure class="card_item_imgWrapper">
              <img src="assets/img/photo.jpg" alt="">
            </figure>
            <div class="card_item_body">
              <h3 class="card_item_ttl">
            タイトル
              </h3>
            </div>
          </article>
        </a>
      </li>
      <li>
        <a class="card_item" href="#">
          <article>
              <h3 class="card_item_ttl">
                タイトル
              </h3>
          </article>
        </a>
      </li>

    </ul>

  </div>
</body>



</html>