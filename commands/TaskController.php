<?php

	namespace app\commands;

	use app\models\tables\Tasks;
	use Yii;
	use yii\{console\Controller, helpers\Console};


	class TaskController extends Controller
	{

		public $date = 'CURRENT_DATE()';

		/**
		 * If you want something different from the current date, then set the command -d='Y-m-d'.
		 * @param int $delay
		 * @return int
		 */
		public function actionTasksWithExpiringDeadlines($delay = 0): int
		{
			//TODO что-то не понятное с некоторыми компьютерами не видет кавычки
/*			if ($this->date !== 'CURRENT_DATE()') {
				$this->date = "\"{$this->date}\"";
			}*/
			$tasks = Tasks::find()->where(
				"deadline = {$this->date} OR deadline = DATE_ADD({$this->date}, INTERVAL 1 DAY)")
				->all();
			if ($tasks) {
				$emailMessages = [];
				$counter = 0;
				Console::startProgress($counter, count($tasks));
				foreach ($tasks as $task) {
					$counter++;
					sleep($delay);
					Console::updateProgress($counter, count($tasks));
					$emailMessages[] = Yii::$app->mailer->compose()
						->setTo($task->responsible->email)
						->setFrom('info@nbsp.ru')
						->setSubject('Task reminder')
						->setHtmlBody("You have a task <a href=\"/task/task?id={$task->id}\">{$task->title}</a> is 
					running out at {$task->deadline}. Die but do!");
				}
				Console::endProgress();
				$message = Yii::$app->i18n->messageFormatter->format(
				    'Sent {n, plural, =1{# reminder of the approach of the deadline for the task by e-mail} 
				    few{# reminder of the approach of the deadline for the tasks} 
				    many{# reminder of the approach of the deadline for the tasks} 
				    other{# reminder of the approach of the deadline for the tasks}} by e-mail!',
				    ['n' => $counter], Yii::$app->language
				);
				$this->stdout($message, Console::BG_GREEN);
				Yii::$app->mailer->sendMultiple($emailMessages);
				return static::EXIT_CODE_NORMAL;
			}

			$this->stdout('Nothing found', Console::FG_RED);
			return static::EXIT_CODE_ERROR;

		}

		public function options($actionId): array
		{
			return ['date'];
		}

		public function optionAliases(): array
		{
			return [
				'd' => 'date',
			];
		}
	}