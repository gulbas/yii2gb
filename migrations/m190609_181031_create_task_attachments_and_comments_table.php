<?php

	use yii\db\Migration;

	/**
	 * Class m190609_181031_create_tasks_attachments_and_comments_table
	 */
	class m190609_181031_create_task_attachments_and_comments_table extends Migration
	{
		protected $attachmentsTable = 'task_attachments';
		protected $commentsTable = 'task_comments';

		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable($this->attachmentsTable, [
				'id'      => $this->primaryKey(),
				'name'    => $this->string(255)->notNull()->comment('Attachments name'),
				'task_id' => $this->integer()->comment('Task id'),
			]);
			$this->addForeignKey('fk_attachments_tasks', $this->attachmentsTable,
				'task_id', 'tasks', 'id');

			$this->createTable($this->commentsTable, [
				'id'      => $this->primaryKey(),
				'content' => $this->string()->notNull()->comment('Comment content'),
				'task_id' => $this->integer(),
				'user_id' => $this->integer(),
				'date_crate'   => $this->timestamp()->notNull()
					->defaultExpression('CURRENT_TIMESTAMP')
					->comment('Date and time of added comment'),
			]);
			$this->addForeignKey('fk_comments_tasks', $this->commentsTable, 'task_id', 'tasks', 'id');
			$this->addForeignKey('fk_comments_users', $this->commentsTable, 'user_id', 'users', 'id');
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropForeignKey(
				'fk_attachments_tasks',
				$this->attachmentsTable
			);
			$this->dropTable($this->attachmentsTable);
			$this->dropForeignKey(
				'fk_comments_users',
				$this->commentsTable
			);
			$this->dropForeignKey(
				'fk_comments_tasks',
				$this->commentsTable
			);
			$this->dropTable($this->commentsTable);
		}

	}
