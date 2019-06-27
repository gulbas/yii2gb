<?php

	namespace app\assets;

	use yii\bootstrap\BootstrapAsset;
	use yii\web\{AssetBundle, YiiAsset};

	class TaskAsset extends AssetBundle
	{
		public $basePath = '@webroot';
		public $baseUrl = '@web';

		public $css = [
			'css/tasks.css',
		];

		public $depends = [
			YiiAsset::class,
			BootstrapAsset::class,
			AppAsset::class,
		];
	}