<?php

	namespace app\controllers;

	use app\models\{events\EventUserRegistrationComplete,
		forms\RegisterUserForm,
		Subscribe,
		SubscribeBehavior,
		tables\Tasks};
	use yii\base\Event;
	use yii\data\ActiveDataProvider;
	use yii\web\Controller;

	class TaskController extends Controller
	{
		public function actionIndex(): string
		{
			$dataProvider = new ActiveDataProvider(
				[
					'query'      => Tasks::find(),
					'pagination' => [
						'pageSize' => 3,
					],
				]);
			return $this->render('index', ['dataProvider' => $dataProvider]);
		}

		public function actionTask($id): string
		{
			$task = Tasks::findOne($id);
			return $this->render('task', ['task' => $task]);
		}

		public function actionTest(): string
		{
			$model = new RegisterUserForm([
				'username'   => 'pupkin3',
				'password'   => 'sdfsdfsd',
				'email'      => 'asd@asd.asd',
				'first_name' => 'pupkin',
				'last_name'  => 'vasya',
			]);

			/*			$model->attachBehavior('my', [
							'class' => SubscribeBehavior::class,
							'message' => 'sdfsdf'
						]);

						$model->detachBehavior('my');*/

			/*$handler = function (EventUserRegistrationComplete $event) {
				(new Subscribe())->attache($event->userId);
			};

			$model->on(RegisterUserForm::EVENT_REGISTRATION_COMPLETE,
				$handler
			);

			Event::on(
				RegisterUserForm::class,
				RegisterUserForm::EVENT_REGISTRATION_VALIDATE_SUCCESS,
				$handler);

			$model->on(RegisterUserForm::EVENT_REGISTRATION_VALIDATE_SUCCESS,
				'foo');

			$model->on(RegisterUserForm::EVENT_REGISTRATION_VALIDATE_SUCCESS,
				[$this, 'handler']);

			$model->off(RegisterUserForm::EVENT_REGISTRATION_VALIDATE_SUCCESS,
				[TaskController::class, 'handler']);*/

			$model->register();
		}

		public static function handler()
		{

		}
	}


