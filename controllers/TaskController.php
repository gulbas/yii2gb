<?php

	namespace app\controllers;

	use app\models\Task;
	use Yii;
	use yii\web\Controller;

	class TaskController extends Controller
	{
		public function actionIndex(): string
		{
			$task = new Task();

			$task->load([
				'Task' =>
					[
						'id'          => 1,
						'title'       => 'Something',
						'description' => 'Do something very high quality. For example, imitate the rapid activity.',
						'owner'       => 'Vasya',
						'assigned'    => 'Petya',
						'dedline'     => '25.03.2019 11:00',
						'status'      => 'in progress',
					],
			]);

			if (!$task->validate()) {
				echo 'The problem with the field - <b>' . key($task->getErrors()) . '</b> <br />';
				echo $task->getErrors()[key($task->getErrors())][0];
				exit;
			}

			return $this->render('index', [
				'task' => $task,
			]);
		}

		public function actionCard(): string
		{
			$request = Yii::$app->request;
			$id = $request->get('id');

			return $this->render('task', [
				'id' => $id,
			]);
		}
	}