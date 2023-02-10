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
    <a class="el_lv2Heading" href="Admin">管理者メニューへ</a>
    <!-- ここから3カラム記事エリア -->
    <ul class="card_items">
      <li>
        <a class="card_item" href="#">
          <article>
            <figure class="card_item_imgWrapper">
              <img src="assets/img/photo.jpg" alt="">
            </figure>
            <div class="card_item_body">
              <time datetime="2021-04-30" class="card_item_time">
                2021-04-30
              </time>
              <h3 class="card_item_ttl">
                Webサイトの制作実績です
              </h3>
              <p class="card_item_txt">
                本文の抜粋文です。本文の抜粋文です。本文の抜粋文です。本文の抜粋文です。
              </p>
            </div>
          </article>
        </a>
      </li>
      <li>
        <a class="card_item" href="#">
          <article>
            <figure class="card_item_imgWrapper">
              <img src="assets/img/photo.jpg" alt="">
            </figure>
            <div class="card_item_body">
              <time datetime="2021-04-30" class="card_item_time">
                2021-04-30
              </time>
              <h3 class="card_item_ttl">
                Webサイトの制作実績です
              </h3>
              <p class="card_item_txt">
                本文の抜粋文です。本文の抜粋文です。本文の抜粋文です。本文の抜粋文です。
              </p>
            </div>
          </article>
        </a>
      </li>
      <!-- 以下省略 -->
    </ul>
    <!-- 3カラム記事エリアここまで -->
  </div>
</body>



</html>