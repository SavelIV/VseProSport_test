<?php

namespace common\models\queries;

use common\models\Task;
use yii\db\ActiveQuery;

/**
 * Defined methods:
 * @method Task|null one($db = null)
 * @method Task[]    all($db = null)
 */
class TaskQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function sort(): static
    {
        return $this->orderBy([
            'task.title' => SORT_ASC
        ]);
    }
}