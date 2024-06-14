<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */

$this->title = Yii::t('app', 'Каталог задач');
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo Html::encode($this->title); ?></h1>

        <p class="lead"><?php echo Yii::t('app', 'Для просмотра каталога нажмите на кнопку ниже:'); ?></p>

        <p><?php echo Html::a(Yii::t('app', 'К каталогу'), ['/task/index'], ['class' => 'btn btn-lg btn-success']); ?></p>
    </div>
</div>