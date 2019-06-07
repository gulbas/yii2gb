<?php
	/* @var $task */
	$this->title = $model->name;

	$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	use kartik\datetime\DateTimePicker;
	use yii\helpers\{Html, Url};
	use yii\widgets\ActiveForm;

	/* @var $status */
	/* @var $responsible */
?>
<div class="task-edit">
    <div class="task-main">
		<?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>
		<?= $form->field($model, 'name')->textInput(); ?>
        <div class="row">
            <div class="col-lg-4">
				<?= $form->field($model, 'status_id')->dropDownList($status) ?>
            </div>
            <div class="col-lg-4">
				<?= $form->field($model, 'responsible_id')->dropDownList($responsible) ?>
            </div>
            <div class="col-lg-4">
				<?= $form->field($model, 'deadline')
//					->textInput(['type' => 'date'])
					->widget(DateTimePicker::class, [
						'name'          => 'deadline',
						'options'       => ['placeholder' => 'Ввод даты/времени...'],
						'type'          => DateTimePicker::TYPE_COMPONENT_PREPEND,
						'layout' => '{picker}{input}{remove}',
						'language'      => 'ru',
						'pluginOptions' => [
							'format'    => 'yyyy-mm-dd hh:i:s',
							'autoclose' => true,
							'weekStart' => 1,
							'todayBtn'  => true,
						],
					])
				?>
            </div>
        </div>

        <div>
			<?= $form->field($model, 'description')
				->textarea() ?>
        </div>
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']); ?>
		<?php ActiveForm::end() ?>
    </div>
</div>