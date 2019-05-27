<?php

	namespace app\controllers;

	use app\models\tables\Tasks;
	use app\models\tables\Users;
	use yii\web\Controller;

	class DbController extends Controller
	{

		public function actionIndex()
		{
			$db = \Yii::$app->db;
			/*	$db->createCommand("
				INSERT INTO test (title, content) VALUES ('title1', 'sdfsdfsdfsdf')
				")->execute();
				$result = $db->createCommand("SELECT COUNT(*) FROM test")->queryScalar();
				$result = $db->createCommand('SELECT * FROM test')->queryAll();
				$result = $db->createCommand("SELECT id FROM test")->queryColumn();
				$result = $db->createCommand('SELECT * FROM test')->queryAll();
				$id = 1;
				$result = $db->createCommand('SELECT * FROM `test` WHERE `id` = :id', [':id' => ''])
							->bindValue(':id', $id)
							->queryOne();*/
			$id = 1;
			$result = $db->createCommand('UPDATE test SET content = :update WHERE id = :id', [
				':update' => '',
				':id'     => '',
			])
				->bindValues([':update' => 'update',
				              ':id'     => $id])
				->execute();

			var_dump($result);
			exit;
		}

		public function actionAr()
		{
			/*			$model = new Tasks();
						$model->name = 'Task 1';
						$model->description = 'Install Framework';
						$model->creator_id = 2;
						$model->deadline = date('Y-m-d');
						$model->responsible_id = 2;
						$model->status_id = 1;

						$model->save();*/

//			$result = Tasks::findOne(['name' => 'Task 2']);
//			$result = Tasks::findAll([1,3,4]);
//			$result = Tasks::find()->all();

			/*			$model = Tasks::findOne(1);
						$model->status_id = 2;
						$model->save();

						$model = Tasks::findOne(4);
						$model->delete();

						$model = Tasks::deleteAll(['>', 'id', 4]);


						$model = Tasks::find()->select(['name', 'description'])
							->where(['>', 'id', 2])
							->limit(1)
							->one();
			*/

//			$model = Tasks::findOne(1);

//			$model = Users::findOne(2);
//			var_dump($model->tasksCreatorId);
//			var_dump($model->tasksResponsibleId);

			$model = Users::findOne(2);
			$model->username ='nbsp';
			$model->save();
			var_dump($model);
			exit;
		}
	}