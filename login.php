<?php



require_once 'UserLogic.php';


//受取失敗時のエラーメッセージ
$err = [];

//バリエーション
if(!$email = filter_input(INPUT_POST,'email')){
    $err['email'] = 'メールアドレスを記入してください';
}
if(!$password = filter_input(INPUT_POST,'password')){
    $err['password'] = 'パスワード記入してください';
}


if(count($err) > 0){
    //エラーがあった場合は戻す
    $_SESSION = $err;
    header('Location: login_form.php');
    return;
}
//ログイン成功時の処理
$result = UserLogic::login($email,$password);
//ログイン失敗時の処理
if(!$result){
    header('Location: login_form.php');
    return;
} 



?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="button.css">
    <title>ログイン完了</title>
</head>
<body>
    <h2>ログイン完了</h2>
    <P>ログインしました</P>
    <a href="mypage.php"><button>マイページへ</button></a>
</body>
</html>


