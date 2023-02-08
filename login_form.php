<?php

require_once 'UserLogic.php';

$result = UserLogic::checkLogin();
if($result){
    header('Location:mypage.php');
    return;
}


$err = $_SESSION;
//セッション消す
$_SESSION = array();
session_destroy();

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="button.css">
</head>
<body>
    <h2>ログインフォーム</h2>
    <?php if (isset($err['msg'])):?>
                <p><?php echo $err['msg'];?></p>
            <?php endif;?>
    <form action="login.php" method="post">
        <p>
            <label for="email">メールアドレス</label>
            <input type="text" name="email">
            <?php if (isset($err['email'])):?>
                <p><?php echo $err['email'];?></p>
            <?php endif;?>
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password">
            <?php if (isset($err['password'])):?>
                <p><?php echo $err['password'];?></p>
            <?php endif;?>
        </p>

        <p>
            <button>ログイン</button>
        </p>
    </form>
    <a href="signup_form.php">新規登録はこちら</a>
</body>
</html>