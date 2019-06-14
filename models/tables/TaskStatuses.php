<?php

	namespace app\models\tables;

	use Yii;
	use yii\db\{ActiveQuery, ActiveRecord};
	use yii\helpers\ArrayHelper;

	/**
	 * This is the model class for table "task_statuses".
	 *
	 * @property int $id
	 * @property string $name
	 *
	 * @property Tasks[] $tasks
	 */
	class TaskStatuses extends ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'task_statuses';
		}

		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['name'], 'string', 'max' => 50],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels(): array
		{
			return [
				'id'   => 'ID',
				'name' => 'Name',
			];
		}

		/**
		 * @return ActiveQuery
		 */
		public function getTasks(): ActiveQuery
		{
			return $this->hasMany(Tasks::className(), ['status_id' => 'id']);
		}

		public static function getStatusesList(): array
		{
			$statuses = static::find()
				->select(['name'])
				->asArray()
				->indexBy('id')
				->column();
			return $statuses;
		}
	}
