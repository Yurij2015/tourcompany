<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: tour.php.
 * Date: 24.04.2018
 * Time: 16:43
 */
session_start();
require_once '../Session.php';
?>
<?php $title = "Перечень туров компании BestTour" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
require_once('../forms/UserForm.php');

$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
    <hr>
    <h5 align="center">Список туров</h5>
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
                        <?php if ($role == 1) echo '<a href="tour-add.php" class="btn btn-info">Добавить тур</a>'; ?>
                        <?php if ($role == 1) echo '<a href="tour-edit-remove.php" class="btn btn-info">Редактировать / Удалить</a>'; ?>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Название тура</th>
                            <th scope="col" class="text-center">Описание</th>
                            <th scope="col" class="text-center">Категория</th>
                            <th scope="col" class="text-center">Стоимость</th>
                            <?php if (!empty($email)) echo '<th scope="col" class="text-center">Корзина</th>'; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $tour = $db->query("SELECT * FROM tour, category WHERE tour.category_idcategory = category.idcategory");
                        foreach ($tour

                        as $touritem) {
                        ?>
                        <tr>
                            <td><?php echo $touritem["name"]; ?></td>
                            <td><?php echo $touritem["description"]; ?></td>
                            <td><?php echo $touritem["namecategory"]; ?></td>
                            <td><?php echo $touritem["cost"]; ?></td>
                            <?php if (!empty($email)) echo "<td>"; ?>
                            <a href="addincart.php?tour=<?= $touritem["idtour"]
                            ?>&user=<?= $id; ?>"><?php if (!empty($email)) echo "Добавить
                                    в корзину"; ?></a>
                            <?php if (!empty($email)) echo "</td>"; ?>
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