<?php

	namespace app\models\forms;


	use app\models\tables\TaskAttachments;
	use Imagine\Image\Box;
	use yii\base\Model;
	use yii\imagine\Image;
	use yii\web\UploadedFile;
	use Yii;

	class TaskAddAttachmentsForm extends Model
	{
		public $taskId;
		/** @var UploadedFile */
		public $file;

		protected $originalDir = '@img/tasks/';
		protected $copiesDir = '@img/tasks/thumbnail/';
		protected $filename;
		protected $filepath;
		protected $model;

		public function rules(): array
		{
			return [
				[['taskId'], 'required'],
				[['taskId'], 'integer'],
				['file', 'file', 'extensions' => 'jpg, png'],
			];
		}

		public function save()
		{
			if ($this->validate()) {
				$this->saveUploadedFile();
				$this->createThumbnail();
				return $this->saveData();
			}
			return false;
		}

		private function saveUploadedFile(): void
		{
			$this->filename = Yii::$app->getSecurity()->generateRandomString(20)
				. '.' . $this->file->getExtension();
			$this->filepath = Yii::getAlias("{$this->originalDir}{$this->filename}");
			$this->file->saveAs($this->filepath);
		}

		private function createThumbnail(): void
		{
			Image::getImagine()->open($this->filepath)
				->thumbnail(new Box(100, 100))
				->save(Yii::getAlias("{$this->copiesDir}{$this->filename}"), ['quality' => 100]);
		}

		private function saveData()
		{
			$this->model = new TaskAttachments([
				'task_id' => $this->taskId,
				'name'    => $this->filename,
			]);
			return $this->model->save();
		}

	}