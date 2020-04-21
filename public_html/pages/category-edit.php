<?php
/**
 * Created by PhpStorm.
 * Project: tourcompany.loc.
 * File: category-edit.php.
 * Date: 26.05.2018
 * Time: 0:47
 */
session_start() ?>
<?php $title = "Обновление категории" ?>
<?php
require_once('../forms/CategoryForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$idcategory = $_GET['idcategory'];
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
            $db->query("UPDATE category SET namecategory = '{$namecategory}', description = '{$description}' WHERE idcategory={$idcategory} LIMIT 1");
            header('location: category.php?msg=Категория успешно обновлена!');
        } else {
            $msg = 'У Вас нет прав на обновление категории!';
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
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
            <div class="col-sm" style="padding-bottom: 100px; >
            <div class=" text-justify border border-bottom-0 border-right-0
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">

                <b style="color: red;"><?= $msg; ?></b>
                <?php
                $category = $db->query("SELECT * FROM category WHERE idcategory={$idcategory} LIMIT 1");
                foreach ($category as $categoryitem) {
                    ?>

                    <form method="post">
                        <div class="form-group">
                            <label for="name">Название категории</label>
                            <input type="text" class="form-control" id="name" placeholder="Добавьте название категории"
                                   name="namecategory"
                                   value="<?= $categoryitem['namecategory']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="secondname">Описание категории</label>
                            <textarea class="form-control" id="description"
                                      name="description"><?= $categoryitem['description']; ?>
                        </textarea>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Сохранить</button>
                            <a href="category.php" class="btn btn-info">Отмена</a>
                        </div>
                    </form>
                <?php } ?>

            </div>
        </div>
    </div>

    </div>


<?php include 'footer.php' ?>