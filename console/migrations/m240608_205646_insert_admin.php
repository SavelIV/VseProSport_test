<?php

use yii\db\Migration;

/**
 * Class m240608_205646_insert_admin
 */
class m240608_205646_insert_admin extends Migration
{
    /**
     * @throws \yii\base\Exception
     */
    public function safeUp(): void
    {
        $this->insert('user', [
            'username'      => 'admin',
            'email'         => 'admin@admin.local',
            'status'        => 10,
            'password_hash' => Yii::$app->security->generatePasswordHash('admin', 10),
            'auth_key'      => Yii::$app->security->generateRandomString(),
            'created_at'    => time(),
            'updated_at'    => time()
        ]);
    }

    public function safeDown(): bool
    {
        return true;
    }
}
