<?php
	//Используем класс.
	use yii\helpers\Url;

	/** @var $model \app\models\tables\Tasks */
	$this->title = Yii::t('task', 'label');
?>
<div class="caption">
    <a class="list-group-item" href="<?= Url::to(['task/task', 'id' => $model->id]) ?>">
        <div class="card-body">
            <h4 class="card-title"><?= $model->title ?></h4>
            <div><?= Yii::t('task', 'status') . ': ' . $model->status->name ?></div>
            <div><?= Yii::t('task', 'deadline') . ': ' . $model->deadline ?></div>
            <div><?= Yii::t('task', 'creator') . ': '
				. $model->creator->first_name . ' ' . $model->creator->last_name ?></div>
            <div><?= Yii::t('task', 'responsible') . ': '
				. $model->responsible->first_name . ' ' . $model->responsible->last_name ?></div>
        </div>
    </a>
</div>