<?php

	use app\models\tables\Tasks;
	use yii\db\Migration;

	/**
	 * Class m190602_170323_create_column_updated_and_create_at_tasks
	 */
	class m190602_170323_create_column_updated_and_create_at_tasks extends Migration
	{
		protected $taskTable = 'tasks';

		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->addColumn($this->taskTable, 'created_at', $this->timestamp());
			$this->addColumn($this->taskTable, 'updated_at', $this->timestamp());
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropColumn($this->taskTable, 'created_at');
			$this->dropColumn($this->taskTable, 'updated_at');
		}

		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{

		}

		public function down()
		{
			echo "m190602_170323_create_column_updated_and_create_at_tasks cannot be reverted.\n";

			return false;
		}
		*/
	}
