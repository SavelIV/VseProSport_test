<?php

namespace backend\controllers;

use common\models\Task;
use common\models\searchers\TaskSearch;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Response;

class TaskController extends DefaultController
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $statuses = Task::getStatusLabels();
        $priorities = Task::getPriorityLabels();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statuses' => $statuses,
            'priorities' => $priorities
        ]);
    }

    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionCreate(): Response|string
    {
        $this->task = new Task();

        if ($this->task->load(Yii::$app->request->post())) {
            if ($this->task->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Задача добавлена!'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'Произошла ошибка при добавлении задачи!'));
            }
        }

        return $this->render('create');
    }

    /**
     * @param $id int
     * @return string|Response
     * @throws Exception
     */
    public function actionUpdate(int $id): Response|string
    {
        if ($this->task->load(Yii::$app->request->post())) {
            if ($this->task->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Задача обновлена!'));
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'Произошла ошибка при обновлении задачи!'));
            }
        }

        return $this->render('update');
    }

    /**
     * @param $id int
     * @return Response
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        if ($this->task->delete()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Задача удалена!'));
            return $this->redirect(['index']);
        } else {
            Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'Произошла ошибка при удалении задачи!'));
        }

        return $this->redirect(['update', 'id' => $this->task->task_id]);
    }
}