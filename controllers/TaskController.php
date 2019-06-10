<?php

	namespace app\controllers;

	use app\models\{filters\TasksFilter,
		forms\TaskAddAttachmentsForm,
		tables\TaskComments,
		tables\Tasks,
		tables\TaskStatuses,
		tables\Users};
	use Yii;
	use yii\caching\TagDependency;
	use yii\web\{Controller};
	use vintage\tinify\UploadedFile;

	class TaskController extends Controller
	{
		public function actionIndex(): string
		{
			return $this->render('index', [
				'dataProvider' => (new TasksFilter)->searchByMonth(),
			]);
		}

		public function actionTask($id): string
		{

			return $this->render('task', [
				'model'              => Tasks::findOne($id),
				'status'             => TaskStatuses::getStatusesList(),
				'responsible'        => Users::getUsersList(),
				'taskAttachmentForm' => new TaskAddAttachmentsForm(),
				'taskCommentForm'    => new TaskComments(),
				'userId'             => Yii::$app->user->id,
			]);
		}

		public function actionSave($id): void
		{
			if ($model = Tasks::findOne($id)) {
				$model->load(Yii::$app->request->post());
				$model->save();
				TagDependency::invalidate(Yii::$app->cache, 'cache_tasks_month');
				Yii::$app->session->setFlash('success', 'The changes was save.');
			} else {
				Yii::$app->session->setFlash('error', 'Somewhere an error,  check please...');
			}
			$this->redirect(Yii::$app->request->referrer);
		}

		public function actionAddComment(): void
		{
			$model = new TaskComments();
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('task', 'comment_message_success'));
			} else {
				Yii::$app->session->setFlash('error', Yii::t('task', 'comment_message_error'));
			}
			$this->redirect(Yii::$app->request->referrer);
		}

		public function actionAddAttachment(): void
		{
			$model = new TaskAddAttachmentsForm();
			$model->load(Yii::$app->request->post());
			$model->file = UploadedFile::getInstance($model, 'file');
			if ($model->save()) {
				Yii::$app->session->setFlash('success', Yii::t('task', 'attachment_message_success'));
			} else {
				Yii::$app->session->setFlash('error', Yii::t('task', 'attachment_message_error'));
			}
			$this->redirect(Yii::$app->request->referrer);
		}
	}


