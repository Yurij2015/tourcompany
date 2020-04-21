<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: cart.php.
 * Date: 24.04.2018
 * Time: 16:44
 */
session_start();
require_once '../Session.php';
?>
<?php $title = "Корзина пользователя" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
require_once('../forms/UserForm.php');

$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
    <hr>
<?php require_once "selectuser.php"; ?>
    <h5 align="center">Корзина пользователя</h5>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?= $title ?> <?= $username . " " . $usersecondname ?></h5>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm">
                <div class="text-justify border border-bottom-0 border-right-0"
                     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                    <div style="margin: 4px 0 7px 0;">

                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Пользователь</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Тур</th>
                            <th scope="col" class="text-center">Описание</th>
                            <th scope="col" class="text-center">Стоимость</th>
                            <th scope="col" class="text-center">Удалить | Купить</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $cart = $db->query("SELECT * FROM cart, tour, user WHERE email = '{$email}' AND cart.user_iduser = user.iduser AND cart.tour_idtour = tour.idtour AND cart.status = 'active' ");
                        foreach ($cart

                        as $cartitem)
                        { ?>
                        <tr>
                            <td><?= $cartitem["username"]; ?> <?= $cartitem["usersecondname"]; ?></td>
                            <td><?= $cartitem["email"]; ?></td>
                            <td><?= $cartitem["name"]; ?></td>
                            <td><?= $cartitem["description"]; ?></td>
                            <td><?= $cartitem["cost"]; ?></td>
                            <td><a href="hiddenfromcart.php?cart=<?= $cartitem["idcart"];
                                ?>">Удалить</a> | <a href="addorder.php?cart=<?= $cartitem["idcart"];
                                ?>">Купить тур</a></td>

                            <?php }
                            ?>
                        </tr>
                        </tbody>
                    </table>
                    <?php
                    } catch
                    (Exception $e) {
                        echo $e->getMessage() . ':(';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>