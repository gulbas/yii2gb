<?php

	use app\components\Bootstrap;
	use app\models\UserIdentity;
	use yii\i18n\PhpMessageSource;

	$params = require __DIR__ . '/params.php';
	$db = require __DIR__ . '/db.php';

	$config = [
		'id'         => 'basic',
		'language'   => 'en',
		'basePath'   => dirname(__DIR__),
		'bootstrap'  => ['log', 'bootstrap'],
		'aliases'    => [
			'@bower' => '@vendor/bower-asset',
			'@npm'   => '@vendor/npm-asset',
			'@img'   => '@app/web/img',
		],
		'components' => [
			'i18n'         => [
				'translations' => [
					'app*'      => [
						'class'    => PhpMessageSource::class,
						'basePath' => '@app/messages',
					],
					'calendar*' => [
						'class'    => PhpMessageSource::class,
						'basePath' => '@app/messages',
					],
					'task*'     => [
						'class'    => PhpMessageSource::class,
						'basePath' => '@app/messages',
					],
				],
			],
			'bootstrap'    => [
				'class' => Bootstrap::class,
			],
			'request'      => [
				// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
				'cookieValidationKey' => 'i8ZqZnVHgCi2CNt0SBUFVQr8U6jwad-U',
			],
			'redis'        => [
				'class'    => 'yii\redis\Connection',
				'hostname' => 'localhost',
				'port'     => 6379,
				'database' => 0,
			],
			'cache'        => [
				'class' => 'yii\redis\Cache',
			],
			'user'         => [
				'identityClass'   => UserIdentity::class,
				'enableAutoLogin' => true,
			],
			'errorHandler' => [
				'errorAction' => 'site/error',
			],
			'mailer'       => [
				'class'            => 'yii\swiftmailer\Mailer',
				// send all mails to a file by default. You have to set
				// 'useFileTransport' to false and configure a transport
				// for the mailer to send real emails.
				'useFileTransport' => true,
			],
			'log'          => [
				'traceLevel' => YII_DEBUG ? 3 : 0,
				'targets'    => [
					[
						'class'  => 'yii\log\FileTarget',
						'levels' => ['error', 'warning'],
					],
				],
			],
			'db'           => $db,

			'urlManager' => [
				'enablePrettyUrl' => true,
				'showScriptName'  => false,
				'rules'           => [
				],
			],

		],
		'params'     => $params,
	];

	if (YII_ENV_DEV) {
		// configuration adjustments for 'dev' environment
		$config['bootstrap'][] = 'debug';
		$config['modules']['debug'] = [
			'class' => 'yii\debug\Module',
			// uncomment the following to add your IP if you are not connecting from localhost.
			//'allowedIPs' => ['127.0.0.1', '::1'],
		];

		$config['bootstrap'][] = 'gii';
		$config['modules']['gii'] = [
			'class' => 'yii\gii\Module',
			// uncomment the following to add your IP if you are not connecting from localhost.
			//'allowedIPs' => ['127.0.0.1', '::1'],
		];
	}

	return $config;
