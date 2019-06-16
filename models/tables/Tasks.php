<?php

	namespace app\models\tables;

	use Yii;
	use yii\behaviors\TimestampBehavior;
	use yii\db\{ActiveQuery, ActiveRecord, Expression};

	/**
	 * This is the model class for table "tasks".
	 *
	 * @property int $id
	 * @property string $description Task description
	 * @property int $creator_id Task creator id
	 * @property int $responsible_id Task responsible id
	 * @property string $deadline Task deadline
	 * @property int $status_id Task status id
	 *
	 * @property $status
	 * @property $creator
	 * @property $responsible
	 * @property int $created_at [timestamp]
	 * @property int $updated_at [timestamp]
	 * @property ActiveQuery $taskComments
	 * @property ActiveQuery $taskAttachments
	 * @property string $title [varchar(50)]  Task title
	 */
	class Tasks extends ActiveRecord
	{

		public $upload;

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
				[['title'], 'required'],
				[['creator_id', 'responsible_id', 'status_id'], 'integer'],
				[['deadline'], 'safe'],
				[['title'], 'string', 'max' => 50],
				[['description'], 'string', 'max' => 255]
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels(): array
		{
			return [
				'id'             => 'ID',
				'title'          => Yii::t('task', 'title'),
				'description'    => Yii::t('task', 'description'),
				'creator_id'     => Yii::t('task', 'creator'),
				'responsible_id' => Yii::t('task', 'responsible'),
				'deadline'       => Yii::t('task', 'deadline'),
				'status_id'      => Yii::t('task', 'status'),
				'upload'         => Yii::t('app', 'upload'),
			];
		}

		public function getStatus(): ActiveQuery
		{
			return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
		}

		public function getCreator(): ActiveQuery
		{
			return $this->hasOne(Users::class, ['id' => 'creator_id']);
		}

		public function getResponsible(): ActiveQuery
		{
			return $this->hasOne(Users::class, ['id' => 'responsible_id']);
		}

		public function behaviors(): array
		{
			return [
				[
					'class' => TimestampBehavior::className(),
					'value' => new Expression('CURRENT_TIMESTAMP()'),
				],
			];
		}

		public function getTaskAttachments(): ActiveQuery
		{
			return $this->hasMany(TaskAttachments::class, ['task_id' => 'id']);
		}

		public function getTaskComments(): ActiveQuery
		{
			return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
		}
	}
