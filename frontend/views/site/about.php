<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'О проекте:';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Простое веб-приложение на базе Yii2 для управления задачами.</p>
    <hr>
    <p>Создана модель Task с полями title, description, due_date, status, и priority (MySQL).</p>
    <p>Реализованы CRUD операции для задач:</p>
    <p> - ФРОНТ: Вывод списка задач с сортировкой по имени: использвано кэширование, встроенное в Yii2 (сделан общий файловый кеш, кеширование по тегу).</p>
    <div>
        <p> - БЭК: Добавление, редактирование и удаление задач (через
            <a class="submenu__link" href="<?php echo Url::to(['/admin/site/index']); ?>" target="_blank">
                <?php echo Yii::t('app', 'админ.панель'); ?>
            </a> : "admin/admin"). Обеспечена валидация данных. При изменении данных происходит инвалидация кеша.
        </p>
    </div>

</div>
