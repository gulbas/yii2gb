<?php

	namespace app\models\forms;

	use app\models\events\EventUserRegistrationComplete;
	use app\models\MyBehavior;
	use app\models\SubscribeBehavior;
	use app\models\tables\Users;
	use yii\base\Model;

	class RegisterUserForm extends Model
	{
		public $username;
		public $password;
		public $email;
		public $first_name;
		public $last_name;

		public const EVENT_REGISTRATION_BEGIN = 'registration_begin';
		public const EVENT_REGISTRATION_VALIDATE_SUCCESS = 'registration_validate_success';
		public const EVENT_REGISTRATION_COMPLETE = 'registration_complete';

		public function rules(): array
		{
			return [
				[['username', 'password', 'email', 'first_name'], 'required'],
				[['username'], 'string', 'max' => 10],
				[['password'], 'string', 'min' => 8],
				[['email', 'first_name', 'last_name'], 'string', 'max' => 25],
			];
		}

		public function behaviors(): array
		{
			return [
				'my' => [
					'class'   => SubscribeBehavior::class,
					'message' => 'Не очень то и дружелюбное',
				],
			];

		}

		public function register(): bool
		{
			$this->trigger(self::EVENT_REGISTRATION_BEGIN);
			if ($this->validate()) {
				$this->trigger(self::EVENT_REGISTRATION_VALIDATE_SUCCESS);
				$user = new Users($this->toArray());
				if ($user->save()) {
					$event = new EventUserRegistrationComplete(['userId' => $user->id]);
					$this->trigger(self::EVENT_REGISTRATION_COMPLETE, $event);
					return true;
				}
			}
			return false;
		}
	}