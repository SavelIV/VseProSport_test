<?php

namespace backend\controllers;

use common\models\Task;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    /* @var Task */
    public $task;

    /**
     * @inheritdoc
     * @throws NotFoundHttpException|yii\web\BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->id != 1) {
            throw new ForbiddenHttpException();
        }

        if ($taskId = (int)Yii::$app->request->get('id')) {
            $this->task = Task::findOne($taskId);
            if (!$this->task) {
                throw new NotFoundHttpException();
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function render($view, $params = []): string
    {
        return parent::render($view, array_merge($params, [
            'task' => $this->task
        ]));
    }
}
