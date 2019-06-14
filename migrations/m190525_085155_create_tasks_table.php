<?php

	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%tasks}}`.
	 */
	class m190525_085155_create_tasks_table extends Migration
	{
		protected $tableName = 'tasks';

		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable($this->tableName, [
				'id'             => $this->primaryKey(),
				'title'           => $this->string(50)->notNull()->comment('Task title'),
				'description'    => $this->string(255)->comment('Task description'),
				'creator_id'     => $this->integer()->comment('Task creator id'),
				'responsible_id' => $this->integer()->comment('Task responsible id'),
				'deadline'       => $this->timestamp()->comment('Task deadline'),
				'status_id'      => $this->integer()->comment('Task status id'),
			]);

			$this->createIndex('tasks_creator_idx', $this->tableName, ['creator_id']);
			$this->createIndex('tasks_responsible_idx', $this->tableName, ['responsible_id']);
			$this->createIndex('tasks_status_idx', $this->tableName, ['status_id']);
			$this->createIndex('tasks_deadline_idx', $this->tableName, ['deadline']);

			//justForTheTest
			$this->batchInsert($this->tableName,
				['title', 'description', 'creator_id', 'responsible_id', 'deadline', 'status_id',],
				[['Task 1', 'Install Framework', 1, 2, '2019-05-25', 1],
				 ['Task 2', 'Create Migration', 2, 1, '2019-06-02', 2],
				 ['Task 3', 'Test AR', 2, 1, '2019-06-02', 2],
				 ['Task 4', 'Apply migration', 2, 1, '2019-06-02', 2],]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('tasks');
		}
	}
