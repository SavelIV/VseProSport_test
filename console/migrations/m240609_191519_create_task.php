<?php

use common\models\Task;
use Faker\Factory;
use yii\db\Migration;

/**
 * Class m240609_191519_create_task
 */
class m240609_191519_create_task extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('task', [
            'task_id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string()->notNull(),
            'due_date' => $this->date(),
            'status' => $this->string(9),
            'priority' => $this->string(4),
        ]);

        $faker = Factory::create();

        $insert = [];
        for ($i = 1; $i < 1000; $i++) {
            $insert[] = [
                'title' => $faker->realText(20),
                'description' => $faker->realText(50),
                'due_date' => date('Y-m-d', strtotime('+' . random_int(1, 10) . ' day')),
                'status' => $faker->randomElement([Task::STATUS_NEW, Task::STATUS_COMPLETED]),
                'priority' => $faker->randomElement([Task::PRIORITY_HIGH, Task::PRIORITY_LOW, Task::PRIORITY_MID]),
            ];
        }
        $this->batchInsert('task', ['title', 'description', 'due_date', 'status', 'priority'], $insert);
    }

    public function safeDown(): void
    {
        $this->dropTable('task');
    }
}
