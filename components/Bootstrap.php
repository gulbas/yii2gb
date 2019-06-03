<?php

	namespace app\components;

	use app\models\tables\Tasks;

	use yii\base\{BootstrapInterface, Component, Event};

	class Bootstrap extends Component implements BootstrapInterface
	{
		public function bootstrap($app): void
		{
			$this->attachEventHandler();
		}

		public function attachEventHandler()
		{
			$sendEmail = function ($event) {
				$task = $event->sender;
				$user = $task->responsible;
				\Yii::$app->mailer->compose()
					->setTo($user->email)
					->setFrom('info@nbsp.ru')
					->setSubject('New task')
					->setTextBody("You have a task {$task->name}. Die but do!")
					->send();
			};

			Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, $sendEmail);
		}
	}