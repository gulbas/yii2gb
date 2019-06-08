<?php

	namespace app\models\tables;

	use yii\helpers\ArrayHelper;

	/**
	 * This is the model class for table "users".
	 *
	 * @property int $id
	 * @property string $username User login
	 * @property string $password User password
	 * @property string $email User email
	 * @property string $first_name User first name
	 * @property string $last_name User last name
	 * @property string $date_crate Date and time of user registration
	 * @property string $auth_key
	 * @property string $access_token
	 *
	 * @property Tasks[] $tasksCreatorId
	 * @property Tasks[] $tasksResponsibleId
	 */
	class Users extends \yii\db\ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'users';
		}

		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['username', 'password', 'email', 'first_name'], 'required'],
				[['date_crate'], 'safe'],
				[['username'], 'string', 'max' => 10],
				[['password'], 'string', 'max' => 60],
				[['email', 'first_name', 'last_name'], 'string', 'max' => 25],
				[['auth_key', 'access_token'], 'string', 'max' => 32],
				[['username'], 'unique'],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id'           => 'ID',
				'username'     => 'Username',
				'password'     => 'Password',
				'email'        => 'Email',
				'first_name'   => 'First Name',
				'last_name'    => 'Last Name',
				'date_crate'   => 'Date Crate',
				'auth_key'     => 'Auth Key',
				'access_token' => 'Access Token',
			];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getTasksCreatorId()
		{
			return $this->hasMany(Tasks::className(), ['creator_id' => 'id']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getTasksResponsibleId()
		{
			return $this->hasMany(Tasks::className(), ['responsible_id' => 'id']);
		}

		public static function getUsersList(): array
		{
			$users = static::find()
				->select(['id', 'username'])
				->asArray()
				->all();
			return ArrayHelper::map($users, 'id', 'username');
		}
	}
