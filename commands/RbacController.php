<?php

	namespace app\commands;

	use Yii;
	use yii\console\Controller;

	class RbacController extends Controller
	{
		public function actionIndex(): void
		{
			$authManager = Yii::$app->authManager;

			$admin = $authManager->createRole('admin');
			$moder = $authManager->createRole('moder');

			$authManager->add($admin);
			$authManager->add($moder);

			$permissionTaskCreate = $authManager->createPermission('TaskCreate');
			$permissionTaskUpdate = $authManager->createPermission('TaskUpdate');
			$permissionTaskRemove = $authManager->createPermission('TaskRemove');

			$authManager->add($permissionTaskCreate);
			$authManager->add($permissionTaskUpdate);
			$authManager->add($permissionTaskRemove);

			$authManager->addChild($admin, $permissionTaskCreate);
			$authManager->addChild($admin, $permissionTaskUpdate);
			$authManager->addChild($admin, $permissionTaskRemove);

			$authManager->addChild($moder, $permissionTaskCreate);
			$authManager->addChild($moder, $permissionTaskUpdate);

			$authManager->assign($admin, 1);
			$authManager->assign($moder, 2);
		}
	}