<?php


namespace common\models\searchers;

use common\models\Task;
use Yii;
use yii\caching\TagDependency;
use yii\data\ArrayDataProvider;

class FrontendTaskSearch extends Task
{
    public function rules(): array
    {
        return [
            [['title'], 'string'],
        ];
    }

    public function search($params = []): ArrayDataProvider
    {
        $cache = Yii::$app->cache;
        $cacheKey = 'all-tasks-cache';

        $tasks = $cache->getOrSet($cacheKey, function () {
            return Task::find()->all();
        }, 3600, new TagDependency([
            'tags' => $cacheKey
        ]));

        $dataProvider =  new ArrayDataProvider([
            'allModels' => $tasks
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['title'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
        ];

        return $dataProvider;
    }
}