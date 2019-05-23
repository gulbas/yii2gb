<?php

	namespace app\models;

	use app\validators\StatusValidator;
	use yii\base\Model;

	class Task extends Model
	{
		public $title;
		public $id;
		public $description;
		public $owner;
		public $assigned;
		public $dedline;
		public $status;

		public function rules()
		{
			return [
				[['id',
				  'title',
				  'description',
				  'owner',
				  'assigned',
				  'dedline',
				  'status'], 'required', 'message' => 'This field is required.'],
				[['description'], 'string', 'min' => 32, 'max' => 512,
				 'tooShort'                       => 'Minimum number of characters - 32.',
				 'tooLong'                        => 'Maximum number of characters - 512.'],
				[['status'], StatusValidator::class],
				[['dedline'], 'relevantDateValidator']];
		}

		public function relevantDateValidator($attribute, $params)
		{
			if (date('d/m/Y h:m', strtotime($this->$attribute)) < date('d/m/Y h:m')) {
				$this->addError($attribute, 'End date can not be less than the start date of the task.');
			}
		}

		public function display()
		{

		}

		public function add()
		{

		}

		public function edit()
		{

		}

		public function remove()
		{

		}

		public function update()
		{

		}
	}