<?php
session_start();
require_once 'Session.php';
?>
<?php $title = "Главная страница" ?>
<?php
require_once('Dbsettings.php');
include_once('DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'pages/header.php' ?>
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
            <h5 class="text-center border border-top-0 border-right-0" style="line-height: 40px;">Список туров
                компании BestTour</h5>
        </div>
    </div>
    <div class="row">
        <?php include_once('navigation.php'); ?>
        <div class="col-sm">
            <div class="text-justify border border-bottom-0 border-right-0"
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                <div style="margin: 4px 0 7px 0;">
                    <!--                        --><?php
                    //                        require_once "pages/selectuser.php";
                    //                        ?>
                    <!--                        --><?php //if ($role == 1) echo '<a href="tour-add.php" class="btn btn-info">Добавить тур</a>'; ?>
                    <!--                        --><?php //if ($role == 1) echo '<a href="tour-edit-remove.php" class="btn btn-info">Редактировать / Удалить</a>'; ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Название тура</th>
                        <th scope="col" class="text-center">Описание</th>
                        <th scope="col" class="text-center">Категория</th>
                        <th scope="col" class="text-center">Стоимость</th>
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
</div>
<?php include 'pages/footer.php' ?>
