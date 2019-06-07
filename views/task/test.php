<?php

	/* @var $this View */

	use yii\web\View;
	use yii\widgets\ActiveForm;

	/* @var $model \app\models\Test */

	$form = ActiveForm::begin();
	echo $form->field($model, 'title')->textInput();
	echo $form->field($model, 'content')->textInput();
	echo $form->field($model, 'count')->textInput();
	echo yii\helpers\Html::submitButton('Push', ['class' => 'btn btn-success']);
	ActiveForm::end();