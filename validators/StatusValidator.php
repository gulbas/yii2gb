<?php

	namespace app\validators;

	use yii\validators\Validator;

	class StatusValidator extends Validator
	{
		public function validateAttribute($model, $attribute)
		{
			$statusArray = ['in progress', 'completed', 'new'];
			if (!in_array($model->$attribute, $statusArray, true)) {
				$model->addError($attribute, 'Invalid status.');
			}
		}
	}