<?php
require_once 'db_connect.php';
echo $_POST['user_name'];
echo $_POST['password'];

//エラーの処理
//ユーザー名とパスワードが入力されているかチェック
if(!empty($_POST['user_name']) && !empty($_POST['password'])){
    echo '成功';

//ユーザー名を使ってデータベースにユーザーが存在するかチェックする
    $sql="select * from admin where name = :name";

    $stm=$pdo->prepare($sql);

    $stm->bindValue(':name', $_POST['user_name'], PDO::PARAM_STR);

    $stm->execute();

    $result=$stm->fetch(PDO::FETCH_ASSOC);
    echo"<pre>";
    var_dump($result);
    echo"<pre>";

//データベースにあるパスワードと入力されたパスワードが一致するかチェックする
    if(!empty($result)){
        echo 'いるよ';
        //$resultの中にあるパスワードと入力されたパスワードが一致するかどうか
        if($result['password'] === $_POST['password']){
            echo 'パスワード一致';
            header("Location:Admin.php");
        //ログインが成功したらadmin.phpにリダイレクトする
        }

    }
}else{
    echo '未入力の項目があります。';
}


?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
        <style type="text/css">
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <form action="Login.php" method="post">
                <?php if (isset($err['login'])) : ?>
                    <p class="error"><?php echo h($err['login']); ?></p>
                <?php endif; ?>
                <p>
                    <label for="user_name">ユーザー名</label>
                    <input id="user_id" name="user_name" type="text" />
                    <?php if (isset($err['user_name'])) : ?>
                        <p class="error"><?php echo h($err['user_name']); ?></p>
                    <?php endif; ?>
                </p>
                <p>
                    <label for="">パスワード</label>
                    <input id="password" name="password" type="password" />
                    <?php if (isset($err['password'])) : ?>
                        <p class="error"><?php echo h($err['password']); ?></p>
                    <?php endif; ?>
                </p>
                <p>
                    <button type="submit">ログイン</button>
                </p>
            </form>
        </div>
    </body>
</html>