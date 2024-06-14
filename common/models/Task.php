<?php

namespace common\models;

use common\models\queries\TaskQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * Database fields:
 *
 * @property integer $task_id
 * @property string $title
 * @property string $description
 * @property string $due_date
 * @property string $status
 * @property string $priority
 */
class Task extends ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_COMPLETED = 'completed';

    const PRIORITY_HIGH = 'high';
    const PRIORITY_MID = 'mid';
    const PRIORITY_LOW = 'low';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'trim'],
            [['description'], 'string'],
            ['due_date', 'date', 'timestampAttribute' => 'due_date', 'timestampAttributeFormat' => 'php:Y-m-d', 'format' => 'php:d.m.Y'],
            [['status'], 'string', 'max' => 9],
            [['status'], 'in', 'range' => array_keys(self::getStatusLabels())],
            [['status'], 'default', 'value' => self::STATUS_NEW],
            [['priority'], 'string', 'max' => 4],
            [['priority'], 'in', 'range' => array_keys(self::getPriorityLabels())],
            [['priority'], 'default', 'value' => self::PRIORITY_HIGH]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'task_id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'due_date' => Yii::t('app', 'Срок'),
            'status' => Yii::t('app', 'Статус'),
            'priority' => Yii::t('app', 'Приоритет'),
        ];
    }

    /**
     * @inheritdoc
     * @return TaskQuery
     */
    public static function find(): TaskQuery
    {
        return new TaskQuery(get_called_class());
    }

    /**
     * @return string[]
     */
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'Новая'),
            self::STATUS_COMPLETED => Yii::t('app', 'Выполненная')
        ];
    }

    /**
     * @param bool $html
     * @return string
     */
    public function getStatusLabel(bool $html = false): string
    {
        $label = self::getStatusLabels()[$this->status] ?? Yii::t('*', 'Неизвестный статус');

        if ($html) {
            $class = match ($this->status) {
                self::STATUS_NEW => 'text-danger',
                self::STATUS_COMPLETED => 'text-success',
                default => '',
            };

            return Html::tag('span', $label, ['class' => $class]);
        }

        return $label;
    }

    /**
     * @return string[]
     */
    public static function getPriorityLabels(): array
    {
        return [
            self::PRIORITY_HIGH => Yii::t('app', 'Высокий'),
            self::PRIORITY_MID => Yii::t('app', 'Средний'),
            self::PRIORITY_LOW => Yii::t('app', 'Низкий')
        ];
    }

    /**
     * @param bool $html
     * @return string
     */
    public function getPriorityLabel(bool $html = false): string
    {
        $label = self::getPriorityLabels()[$this->priority] ?? Yii::t('*', 'Неизвестный приоритет');

        if ($html) {
            $class = match ($this->priority) {
                self::PRIORITY_HIGH => 'text-danger',
                self::PRIORITY_MID => 'text-info',
                self::PRIORITY_LOW => 'text-success',
                default => '',
            };

            return Html::tag('span', $label, ['class' => $class]);
        }

        return $label;
    }
}