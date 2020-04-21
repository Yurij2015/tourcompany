<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: category.php.
 * Date: 24.04.2018
 * Time: 16:43
 */
session_start();
require_once '../Session.php';
?>
<?php $title = "Категории" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
    <hr>
    <h5 align="center">Категории туров</h5>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?php echo $title ?></h5>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm">
                <div class="text-justify border border-bottom-0 border-right-0"
                     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                    <div style="margin: 4px 0 7px 0;">
                        <?php
                        require_once "selectuser.php";
                        ?>
                        <?php if ($role == 1) echo '<a href="category-add.php" class="btn btn-info">Добавить категорию</a>' ?>
                        <?php if ($role == 1) echo '<a href="category-edit-remove.php" class="btn btn-info">Редактировать / Удалить</a>' ?>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Название категории</th>
                            <th scope="col" class="text-center">Описание</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $category = $db->query("SELECT * FROM category");
                        foreach ($category as $categoryitem) {
                            ?>
                            <tr>
                                <td><?php echo $categoryitem["namecategory"]; ?></td>
                                <td><?php echo $categoryitem["description"]; ?></td>
                            </tr>
                        <?php }
                        ?>
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