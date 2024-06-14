<?php

use common\models\Task;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this         yii\web\View */
/* @var $searchModel  common\models\searchers\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $statuses     string[] */
/* @var $priorities   string[] */

$this->title = Yii::t('app', 'Задачи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel">
    <div class="panel-heading">
        <div class="panel-control">
            <?php echo Html::a('Сбросить фильтр', ['index'], ['class' => 'btn btn-danger btn-labeled fa fa-close']); ?>
        </div>
        <h3 class="panel-title"><?php echo Html::encode($this->title); ?></h3>
    </div>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'emptyTextOptions' => ['style' => 'text-align: center;'],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => [
                    'class' => 'text-center',
                    'style' => 'width: 40px;'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'title',
                'value' => function (Task $model) {
                    return $model->title;
                },
            ],
            [
                'attribute' => 'description',
                'value' => function (Task $model) {
                    return $model->description;
                },
            ],
            [
                'attribute' => 'due_date',
                'value' => function (Task $model) {
                    return $model->due_date ?: 'Не указана';
                },
                'headerOptions' => ['style' => 'width: 160px;']
            ],
            [
                'attribute' => 'status',
                'value' => function (Task $model) {
                    return $model->getStatusLabel(true);
                },
                'format' => 'raw',
                'filter' => $statuses,
                'filterInputOptions' => ['prompt' => Yii::t('app', 'Все статусы'), 'style' => 'width: 100%;'],
                'headerOptions' => ['style' => 'width: 160px;'],
                'contentOptions' => ['class' => 'text-center']
            ],
            [
                'attribute' => 'priority',
                'value' => function (Task $model) {
                    return $model->getPriorityLabel(true);
                },
                'format' => 'raw',
                'filter' => $priorities,
                'filterInputOptions' => ['prompt' => Yii::t('app', 'Все приоритеты'), 'style' => 'width: 100%;'],
                'headerOptions' => ['style' => 'width: 160px;'],
                'contentOptions' => ['class' => 'text-center']
            ],
        ]
    ]); ?>
</div>