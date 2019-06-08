<?php

	namespace app\controllers;

	use Yii;
	use yii\web\Controller;

	class CacheController extends Controller
	{
		public function actionIndex(): void
		{
			$cache = Yii::$app->cache;
			$key = 'number';

			if ($cache->exists($key)) {
				$number = $cache->get($key);
			} else {
				$number = mt_rand();
				$cache->set($key, $number, 10);
			}
			var_dump($number);
			exit;
		}

	}