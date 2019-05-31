<?php

	namespace app\widgets;

	use yii\base\Widget;

	class MyWidget extends Widget
	{
		public $label = 'Нажми меня';

		public function run()
		{
			return $this->render('my', ['label' => $this->label]);
		}
	}