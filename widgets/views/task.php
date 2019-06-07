<?php
	//Используем класс.
	use yii\helpers\Url;

	/** @var $model \app\models\tables\Tasks */
	$this->title = 'Tasks';
?>
<div class="caption">
    <a class="list-group-item" href="<?= Url::to(['task/task', 'id' => $model->id]) ?>">
        <div class="card-body">
            <h4 class="card-title"><?= $model->name ?></h4>
            <div>Status: <?= $model->status->name ?></div>
            <div>Deadline: <?= $model->deadline ?></div>
            <div>Creator: <?= $model->creator->first_name . ' ' . $model->creator->last_name ?></div>
            <div>Responsible: <?= $model->responsible->first_name . ' ' . $model->responsible->last_name ?></div>
        </div>
    </a>
</div>