<?php
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = Yii::t('task', 'label');
	$this->params['breadcrumbs'][] = $this->title;


	use app\widgets\{Task};
	use yii\widgets\{ActiveForm, ListView};
	use yii\helpers\Html;

	$items = [
		'1'  => Yii::t('calendar', 'January'),
		'2'  => Yii::t('calendar', 'February'),
		'3'  => Yii::t('calendar', 'March'),
		'4'  => Yii::t('calendar', 'April'),
		'5'  => Yii::t('calendar', 'May'),
		'6'  => Yii::t('calendar', 'June'),
		'7'  => Yii::t('calendar', 'July'),
		'8'  => Yii::t('calendar', 'August'),
		'9'  => Yii::t('calendar', 'September'),
		'10' => Yii::t('calendar', 'October'),
		'11' => Yii::t('calendar', 'November'),
		'12' => Yii::t('calendar', 'December'),
	];
	$params = [
		'prompt' => Yii::t('calendar', 'prompt'),
		'class'  => 'form-control',
		'id'     => 'select-month',
	];
?>
<h1><?= $this->title ?></h1>

<div class="container">
    <div class="row">
        <div class="col-md-3 searchByMonth">
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
</div>
<?= ListView::widget([
	'dataProvider' => $dataProvider,
	'summary'      => false,
	'itemView'     => function ($model) {
		return Task::widget(['model' => $model]);
	},
	'itemOptions'  => ['class' => 'col-md-4'],
	'options'      => [
		'class' => 'row',
	],
	'layout'       => "<div class='container'>{summary}\n{items}\n</div><div class='navigation'>{pager}</div>",
]) ?>
