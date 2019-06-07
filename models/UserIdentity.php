<?php

	namespace app\models;

	use app\models\tables\Users;
	use Yii;
	use yii\web\IdentityInterface;

	/**
	 *
	 * @property mixed $authKey
	 */
	class UserIdentity extends Users implements IdentityInterface
	{

		/**
		 * {@inheritdoc}
		 */
		public static function findIdentity($id)
		{
			return static::findOne($id);
		}

		/**
		 * {@inheritdoc}
		 */
		public static function findIdentityByAccessToken($token, $type = null)
		{
			foreach (self::$users as $user) {
				if ($user['accessToken'] === $token) {
					return new static($user);
				}
			}

			return null;
		}

		/**
		 * Finds user by username
		 *
		 * @param string $username
		 * @return static|null
		 */
		public static function findByUsername($username)
		{
			return static::findOne(['username' => $username]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function getId()
		{
			return $this->id;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getAuthKey()
		{
			return $this->authKey;
		}

		/**
		 * {@inheritdoc}
		 */
		public function validateAuthKey($authKey)
		{
			return $this->authKey === $authKey;
		}

		/**
		 * Validates password
		 *
		 * @param string $password password to validate
		 * @return bool if password provided is valid for current user
		 */
		public function validatePassword($password)
		{
			return Yii::$app->getSecurity()->validatePassword($password, $this->password);
		}
	}
