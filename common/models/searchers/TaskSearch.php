<?php


namespace common\models\searchers;

use common\models\Task;
use yii\data\ActiveDataProvider;

class TaskSearch extends Task
{
    public function rules(): array
    {
        return [
            [['title', 'description', 'status', 'priority'], 'string'],
            [['due_date'], 'date', 'timestampAttributeFormat' => 'php:Y-m-d', 'format' => 'php:Y-m-d']
        ];
    }

    public function search($params = []): ActiveDataProvider
    {
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['and',
            ['like', 'task.title', $this->title],
            ['like', 'task.description', $this->description],
            ['DATE(task.due_date)' => $this->due_date],
            ['task.status' => $this->status],
            ['task.priority' => $this->priority],
        ]);

        return $dataProvider;
    }
}