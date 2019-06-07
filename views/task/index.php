<?php
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Tasks';
	$this->params['breadcrumbs'][] = $this->title;

	use yii\widgets\ListView; ?>
<h1><?= $this->title ?></h1>
<div class="container">
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'summary'      => false,
		'itemView'     => function ($model) {
			return app\widgets\Task::widget(['model' => $model]);
		},
		'itemOptions'  => ['class' => 'col-sm-6 col-md-4'],
		'options'      => [
			'class' => 'row',
		],
	]) ?>
</div>