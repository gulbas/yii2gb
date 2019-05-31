<?php

namespace app\models\tables;

use Yii;
use yii\debug\models\search\User;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name Task name
 * @property string $description Task description
 * @property int $creator_id Task creator id
 * @property int $responsible_id Task responsible id
 * @property string $deadline Task deadline
 * @property int $status_id Task status id
 * @property $status
 *
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['deadline'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'responsible_id' => 'Responsible ID',
            'deadline' => 'Deadline',
            'status_id' => 'Status ID',
        ];
    }

	public function getStatus()
	{
		return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

	public function getCreator()
	{
		return $this->hasOne(Users::class, ['id' => 'creator_id']);
	}

	public function getResponsible()
	{
		return $this->hasOne(Users::class, ['id' => 'responsible_id']);
	}
}
