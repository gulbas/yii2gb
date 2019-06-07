<?php

	namespace app\models;

	class Subscribe
	{
		public function attache(int $userId): bool
		{
			echo "Пользователь с id {$userId} подписан на рассылку!";
			return true;
		}
	}