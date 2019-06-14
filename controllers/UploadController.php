<?php

	namespace app\controllers;

	use app\models\Test;
	use Yii;
	use yii\web\{Controller, UploadedFile};

	class UploadController extends Controller
	{
		public function actionIndex(): string
		{
			$model = new Test();
			if ($model->load(Yii::$app->request->post())) {
				$model->upload = UploadedFile::getInstance($model, 'upload');
				$model->save();
			}

			return $this->render('test', ['model' => $model]);
		}

		public function actionLang(): void
		{
			echo Yii::t('app', 'hello');
			exit;
		}
	}