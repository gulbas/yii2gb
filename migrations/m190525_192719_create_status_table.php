<?php

	use app\models\tables\Tasks;
	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%status}}`.
	 */
	class m190525_192719_create_status_table extends Migration
	{
		protected $tableName = 'task_statuses';

		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable($this->tableName, [
				'id'   => $this->primaryKey(),
				'name' => $this->string(50),
			]);

			$this->batchInsert($this->tableName, ['name'], [
				['New'],
				['In work'],
				['Testing'],
				['Rework'],
				['Done'],
			]);

			$taskTable = Tasks::tableName();

			$this->addForeignKey('fk_task_statuses', $taskTable, 'status_id',
				$this->tableName, 'id');
			$this->update($taskTable, ['status_id' => 1]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable($this->tableName);
		}
	}
