<?php

	use app\models\tables\Tasks;
	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%users}}`.
	 */
	class m190526_091639_create_users_table extends Migration
	{
		protected $tableName = 'users';

		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable($this->tableName, [
				'id'           => $this->primaryKey(),
				'username'     => $this->string(10)->notNull()->unique()->comment('User login'),
				'password'     => $this->string(60)->notNull()->comment('User password'),
				'email'        => $this->string(25)->notNull()->comment('User email'),
				'first_name'   => $this->string(25)->notNull()->comment('User first name'),
				'last_name'    => $this->string(25)->comment('User last name'),
				'date_crate'   => $this->timestamp()->notNull()
					->defaultExpression('CURRENT_TIMESTAMP')
					->comment('Date and time of user registration'),
				'auth_key'     => $this->string(32)->defaultValue(null),
				'access_token' => $this->string(32)->defaultValue(null),
			]);

			//justForTheTest
			$this->batchInsert($this->tableName,
				['username', 'password', 'email', 'first_name', 'last_name', 'auth_key', 'access_token'],
				[['admin', '$2y$10$/LM/dGk84ZXU/H0gXr3Ng.52T.Z8fTrfl/wPx19gXzhdpkG4drzJC',
				  'admin@admin.ru', 'Admin', 'Zelepupkin', 'test100key', '101-token'],
				 ['test', '$2y$10$IdcdDpRm25Ug55jFLY5Yu.38QpMEjRe0.gtx8ip1p1LWAmxj3N.RO',
				  'test@test.ru', 'Nbsp', 'Probelov', 'test100key', '101-token']]);

			$this->createIndex('user_idx', $this->tableName, ['id']);
			$this->createIndex('user_date_crate_idx', $this->tableName, ['date_crate']);
			$this->createIndex('user_first_name_idx', $this->tableName, ['first_name']);
			$this->createIndex('user_username_idx', $this->tableName, ['username']);

			$taskTable = Tasks::tableName();

			$this->addForeignKey('fk_users_creator_id', $taskTable,
				'creator_id', $this->tableName, 'id');
			$this->addForeignKey('fk_users_responsible_id', $taskTable,
				'responsible_id', $this->tableName, 'id');
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('users');
		}
	}
