<?php
	/* @var $task */
	$this->title = $task->id;

	$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	use yii\widgets\DetailView; ?>
<?= DetailView::widget([
	'model'      => $task,
	'attributes' => [
		'id',
		'name',
		'description',
		[
			'label'  => 'Creator',
			'value'  => "<a href='/admin-user/view?id={$task->creator_id}'> {$task->creator->first_name} {$task->creator->last_name}</a>",
			'format' => 'html',
		],
		[
			'label'  => 'Responsible',
			'value'  => "<a href='/admin-user/view?id={$task->responsible_id}'> {$task->responsible->first_name} {$task->responsible->last_name}</a>",
			'format' => 'html',
		],
		'deadline',
		[
			'label' => 'Status',
			'value' => $task->status->name,
		],
	],
]) ?>