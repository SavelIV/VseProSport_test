<?php

use common\models\Task;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $task common\models\Task */

?>

<?php $form = ActiveForm::begin([
    'id' => 'task-form',
    'enableClientValidation' => false,
    'validateOnBlur' => false
]); ?>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-12">
            <?php echo $form->field($task, 'title')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $form->field($task, 'description')->textInput(['maxlength' => true]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $form->field($task, 'due_date')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '9999-99-99',
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $form->field($task, 'status')->dropDownList(Task::getStatusLabels(), [
                'style' => 'width: 100%;'
            ])->label(Yii::t('app', 'Статус')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $form->field($task, 'priority')->dropDownList(Task::getPriorityLabels(), [
                'style' => 'width: 100%;'
            ])->label(Yii::t('app', 'Приоритет')); ?>
        </div>
    </div>
</div>
<hr>
<div class="panel-footer text-right clearfix">
    <?php if (!$task->isNewRecord) {
        echo Html::a(Yii::t('app', 'Удалить'), ['/task/delete', 'id' => $task->task_id], [
            'class' => 'btn btn-danger btn-labeled ti-trash pull-left',
            'data-confirm' => 'Вы уверены, что хотите удалить задачу?',
            'data-method' => 'post'
        ]);
    } ?>
    <?php echo Html::a(Yii::t('app', 'Отменить'), Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
    <?php echo Html::submitButton($task->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $task->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
