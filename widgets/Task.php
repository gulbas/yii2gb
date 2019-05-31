<?php

	namespace app\widgets;

	use app\models\tables\Tasks;
	use yii\base\Widget;

	class Task extends Widget
	{
		public $model;

		public function run()
		{
			if (is_a($this->model, Tasks::class)) {
				return $this->render('task', ['model' => $this->model]);
			}
			throw new \Exception('Невозможно отобразить модель задачи.');
		}
	}