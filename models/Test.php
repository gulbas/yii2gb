<?php

	namespace app\models;

	use Imagine\Image\Box;
	use Yii;
	use yii\{base\Model, imagine\Image, web\UploadedFile};

	class Test extends Model
	{
		public $content;
		public $title;
		public $count;
		/**
		 * @var UploadedFile
		 */
		public $upload;

		public function rules(): array
		{
			return [
				[['title', 'content'], 'required'],
				[['count'], 'safe'],
				['upload', 'file', 'extensions' => 'jpg, png'],
			];
		}

		public function myValidate($attr, $params): void
		{
			if (!in_array($this->$attr, [3, 4, 5], true)) {
				$this->addError($attr, 'Неверный диапазон');
			}
		}

		public function save(): void
		{
			if ($this->upload && $this->validate('upload')) {
				Yii::setAlias('@img', '@webroot/img');
				$filePart = Yii::getAlias("@img/{$this->upload->name}");
				$this->upload->saveAs($filePart);

				/*Image::thumbnail($filePart, 100, 100)
					->save(Yii::getAlias(
						"@img/small/{$this->upload->baseName}_thumbnail.{$this->upload->extension}",
						['quality' => 100]
					));*/

				Image::getImagine()->open($filePart)
					->thumbnail(new Box(100, 100))
					->save(Yii::getAlias(
						"@img/small/{$this->upload->baseName}_thumbnail.{$this->upload->extension}"
					), ['quality' => 100]);
				Yii::$app->session->setFlash('success', 'The changes was save.');
			} else {
				Yii::$app->session->setFlash('error', 'Somewhere an error, check please...');
			}
		}

		public function attributeLabels()
		{
			return [
				'content' => Yii::t('app', 'test_content')
			];
		}


	}