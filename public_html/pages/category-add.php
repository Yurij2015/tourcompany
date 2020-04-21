<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: category-add.php.
 * Date: 24.04.2018
 * Time: 17:01
 */
session_start() ?>
<?php $title = "Добавление категории" ?>
<?php
require_once('../forms/CategoryForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$form = new CategoryForm($_POST);
if ($_POST) {
    if ($form->validate()) {
        $namecategory = $db->escape($form->getNamecategory());
        $description = $db->escape($form->getDescription());

        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];
        if ($a == 1 || $a == 2) {
            $db->query("INSERT INTO category (namecategory, description) VALUES ('{$namecategory}','{$description}') ");
            header('location: category.php?msg=Категория успешно добавлена!');
        } else {
            $msg = 'У Вас нет прав на добавление категории!';
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
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

                <b style="color: red;"><?= $msg; ?></b>
                <form method="post">
                    <div class="form-group">
                        <label for="name">Название категории</label>
                        <input type="text" class="form-control" id="name" placeholder="Добавьте название категории"
                               name="namecategory"
                               value="<?= $form->getNamecategory(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="secondname">Описание категории</label>
                        <input type="text" class="form-control" id="secondname"
                               placeholder="Добавьте описание категории"
                               name="description" value="<?= $form->getDescription() ?>">
                    </div>

                    <button type="submit" class="btn btn-info">Сохранить</button>
                    <a href="category.php" class="btn btn-info">Отмена</a>

                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
