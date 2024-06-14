<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */

$this->title = Yii::t('app', 'Задачи');
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?php echo Html::encode($this->title); ?></h1>

        <p class="lead"><?php echo Yii::t('app', 'Для просмотра и редактирования задач нажмите на кнопку ниже:'); ?></p>

        <p><?php echo Html::a(Yii::t('app', 'К задачам'), ['/task/index'], ['class' => 'btn btn-lg btn-success']); ?></p>
    </div>
</div>