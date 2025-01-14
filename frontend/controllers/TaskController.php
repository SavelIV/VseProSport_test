<?php


namespace frontend\controllers;

use common\models\searchers\FrontendTaskSearch;
use common\models\Task;
use Yii;
use yii\web\Controller;

class TaskController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new FrontendTaskSearch();
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
}