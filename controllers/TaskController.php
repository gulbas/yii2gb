<?php

	namespace app\controllers;

	use app\models\{forms\RegisterUserForm,
		tables\Tasks,
		tables\TaskStatuses,
		tables\Users};
	use Yii;
	use yii\data\ActiveDataProvider;
	use yii\web\Controller;

	class TaskController extends Controller
	{
		public function actionIndex(): string
		{
			$month = Yii::$app->request->post('month');
			if ($month) {
				$query = Tasks::find()->where("MONTH(created_at) = {$month}");
				$dataProvider = new ActiveDataProvider(
					[
						'query'      => $query,
						'pagination' => [
							'pageSize' => 3,
						],
					]);

				Yii::$app->db->cache(function () use ($dataProvider) {
					$dataProvider->prepare();
				});

			} else {
				$query = Tasks::find();
				$dataProvider = new ActiveDataProvider(
					[
						'query'      => $query,
						'pagination' => [
							'pageSize' => 3,
						],
					]);
			}

			return $this->render('index', ['dataProvider' => $dataProvider]);
		}

		public function actionTask($id): string
		{
			return $this->render('task', ['model'       => Tasks::findOne($id),
			                              'status'      => TaskStatuses::getStatusesList(),
			                              'responsible' => Users::getUsersList()]);
		}

		public function actionSave($id): void
		{
			if ($model = Tasks::findOne($id)) {
				$model->load(Yii::$app->request->post());
				$model->save();
				Yii::$app->session->setFlash('success', 'The changes was save.');
			} else {
				Yii::$app->session->setFlash('error', 'Somewhere an error, check please...');
			}
			$this->redirect(Yii::$app->request->referrer);
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


