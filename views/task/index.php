<?php
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Tasks';
	$this->params['breadcrumbs'][] = $this->title;


	use app\widgets\{Task};
	use yii\widgets\{ActiveForm, ListView};
	use yii\helpers\Html;

	$items = [
		'1'  => 'January',
		'2'  => 'February',
		'3'  => 'March',
		'4'  => 'April',
		'5'  => 'May',
		'6'  => 'June',
		'7'  => 'July',
		'8'  => 'August',
		'9'  => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December',
	];
	$params = [
		'prompt' => 'Select month',
		'class'  => 'form-control',
		'id'     => 'select-month',
	];
?>
<h1><?= $this->title ?></h1>

<div class="container">
    <div class="row m-3">
        <div class="col-md-3">
			<?php $form = ActiveForm::begin(); ?>
            <div class="form-inline">
                <div class="form-group">
					<?= Html::dropDownList('month', 'null', $items, $params); ?>
                </div>
				<?= Html::submitButton('Ok', ['class' => 'btn btn-primary', 'name' => 'month-filter-button']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'summary'      => false,
		'itemView'     => function ($model) {
			return Task::widget(['model' => $model]);
		},
		'itemOptions'  => ['class' => 'col-sm-6 col-md-4'],
		'options'      => [
			'class' => 'row',
		],
	]) ?>
</div>