<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $task common\models\Task */

$this->title = Yii::t('app', 'Создание задачи');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Задачи'), 'url' => ['/task/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Html::encode($this->title); ?></h3>
    </div>
    <?php echo $this->render('_form', [
        'task' => $task
    ]); ?>
</div>
