<?php

	use yii\helpers\Html;
	use yii\widgets\DetailView;

	/* @var $this yii\web\View */
	/* @var $model app\models\tables\Tasks */

	$this->title = $model->name;
    /** @var TYPE_NAME $hide */
	if (!$hide) {
		$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
		$this->params['breadcrumbs'][] = $this->title;
	}

	\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method'  => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model'      => $model,
		'attributes' => [
//			'id',
			[
				'label'  => 'ID',
				'value'  => "<a href='view?id={$model->id}'>{$model->id}</a>",
				'format' => 'html',
			],
			'name',
			'description',
			'creator_id',
			[
				'label'  => 'Creator',
				'value'  => "<a href='#'>{$model->creator->first_name} {$model->creator->last_name}</a>",
				'format' => 'html',
			],
			'responsible_id',
			[
				'label'  => 'Responsible',
				'value'  => "<a href='#'> {$model->responsible->first_name} {$model->responsible->last_name}</a>",
				'format' => 'html',
			],
			'deadline',
			'status_id',
			[
				'label' => 'Status',
				'value' => $model->status->name,
			],
		],
	]) ?>

</div>
