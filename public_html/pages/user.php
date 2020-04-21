<?php
session_start();
require_once '../Session.php';
?>
<?php $title = "Пользователи системы" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
    <hr>
    <h5 align="center">Менеджер задач</h5>
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
                        <!--                        <a href="employee-edit-remove.php" class="btn btn-info">Редактировать / Удалить</a>-->
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Имя</th>
                            <th scope="col" class="text-center">Фамилия</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Роль</th>
                            <!--                            <th scope="col" class="text-center">Статус</th>-->

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $db = new DB($host, $user, $password, $db_name);
                        $user = $db->query("SELECT * FROM `user`, role WHERE role.idrole = user.role_idrole");
                        foreach ($user as $useritem) {
                            ?>
                            <tr>
                                <td><?php echo $useritem["username"]; ?></td>
                                <td><?php echo $useritem["usersecondname"]; ?></td>
                                <td><?php echo $useritem["email"]; ?></td>
                                <td><?php echo $useritem["role"]; ?></td>
                                <!--                                <td>-->
                                <?php //echo $useritem["status"]; ?><!--</td>-->

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