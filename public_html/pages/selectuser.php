<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: selectuser.php.
 * Date: 24.04.2018
 * Time: 21:22
 */
// выбор пользователя из базы данных
$email = $_SESSION['email'];
$res = $db->query("SELECT * FROM `user` WHERE email = '{$email}'");
$id = $res[0]['iduser'];
$email = $res[0]['email'];
$username = $res[0]['username'];
$usersecondname = $res[0]['usersecondname'];
$role = $res[0]['role_idrole'];