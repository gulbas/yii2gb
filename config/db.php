<?php

	use yii\db\Connection;

	return [
		'class' => Connection::class,
		'dsn' => 'mysql:host=localhost;dbname=task_tracker',
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',

		// Schema cache options (for production environment)
		//'enableSchemaCache' => true,
		//'schemaCacheDuration' => 60,
		//'schemaCache' => 'cache',
];
