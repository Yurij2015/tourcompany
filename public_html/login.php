<?php session_start() ?>
<?php $title = "Вход на сайт" ?>
<?php
require_once('forms/LoginForm.php');
require_once('DB.php');
require_once('Password.php');
require_once('Session.php');
require_once('Dbsettings.php');


$msg = '';

$db = new DB($host, $user, $password, $db_name);
$form = new LoginForm($_POST);

if ($_POST) {
    if ($form->validate()) {
        $email = $db->escape($form->getEmail());
        $password = new Password($db->escape($form->getPassword()));

        $res = $db->query("SELECT * FROM user WHERE email = '{$email}' AND password = '{$password}' LIMIT 1");
        if (!$res) {
            $msg = 'No such user found';
        } else {
            $email = $res[0]['email'];
            Session::set('email', $email);
            header('location: index-tour.php?msg=Вы авторизированы на сайте');
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}

?>

<?php include 'header.php' ?>
<h4>Авторизация на сайте</h4>
<b style="color: red;"><?= $msg; ?></b>
<form method="post">
    <div class="form-group">
        <label for="InputEmail">Адрес электронной почты</label>
        <input type="email" class="form-control" id="InputEmail" placeholder="Ваш email" name="email"
               value="<?= $form->getEmail(); ?>">
    </div>
    <div class="form-group">
        <label for="InputPassword">Пароль</label>
        <input type="password" class="form-control" id="InputPassword" placeholder="Пароль" name="password">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
    <a href="index-tour.php" class="btn btn-primary">Отмена</a>

</form>
<?php include 'footer.php' ?>
