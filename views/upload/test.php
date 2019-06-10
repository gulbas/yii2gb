<?php

	/* @var $this View */

	use kartik\widgets\FileInput;
	use yii\helpers\Html;
	use yii\web\View;
	use yii\widgets\ActiveForm;

	/* @var $model \app\models\Test */

	$form = ActiveForm::begin();
	echo $form->field($model, 'title')->textInput();
	echo $form->field($model, 'content')->textInput();
	echo $form->field($model, 'count')->textInput();
	echo $form->field($model, 'upload')->widget(FileInput::className(), [
		'options' => ['accept' => 'image/*'],
	]);
	echo Html::submitButton('Push', ['class' => 'btn btn-success']);
	ActiveForm::end();