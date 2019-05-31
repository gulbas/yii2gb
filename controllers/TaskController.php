<?php

	namespace app\controllers;

	use app\models\{tables\Tasks, Test};
	use Yii;
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
			$model = new Test();
			if (Yii::$app->request->post()) {
				$model->load(Yii::$app->request->post());
			}
			return $this->render('test', ['model' => $model]);
		}
	}
