<?php

	namespace app\models;

	use app\models\forms\RegisterUserForm;
	use yii\base\Behavior;

	class SubscribeBehavior extends Behavior
	{
		public $message = 'Я дружелюбное поведение!';

		public function events(): array
		{
			return [
				RegisterUserForm::EVENT_REGISTRATION_COMPLETE => 'foo',
			];
		}

		public function foo($event): void
		{
			(new Subscribe())->attache($event->userId);
		}
	}