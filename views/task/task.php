<?php
	/* @var $task */
	$this->title = $model->title;

	$this->params['breadcrumbs'][] = ['label' => Yii::t('task', 'label'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;

	use app\models\tables\Tasks;
	use kartik\{datetime\DateTimePicker, widgets\FileInput};
	use yii\helpers\{Html, Url};
	use yii\widgets\ActiveForm;

	/* @var $status */
	/* @var $responsible */
	/* @var $taskAttachmentForm */
	/* @var $taskCommentForm */
	/* @var $userId */
	/* @var $model Tasks */
?>
<h1><?= Yii::t('task', 'card_title') ?> #<?= $model->id ?></h1>

<div class="task-edit">
    <div class="task-edit-main">
		<?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]); ?>

        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
        </div>

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
						'layout'        => '{picker}{input}{remove}',
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

		<?= Html::submitButton(Yii::t('app', 'buttonSave'), ['class' => 'btn btn-success']); ?>
		<?php ActiveForm::end() ?>

        <div class="task-attachments">
            <h3><?= Yii::t('task', 'attachments_bloc_title') ?></h3>

			<?php $form = ActiveForm::begin(['action' => Url::to(['task/add-attachment'])]); ?>
			<?= $form->field($taskAttachmentForm, 'taskId')
				->hiddenInput(['value' => $model->id,])->label(false) ?>
			<?= $form->field($taskAttachmentForm, 'file')
				->widget(FileInput::class, [
					'options' => ['accept' => 'image/*'],
				])->label(false) ?>
			<?php ActiveForm::end() ?>
            <br>

            <div class="attachments-history">
				<?php foreach ($model->taskAttachments as $file): ?>
                    <a href="/img/tasks/<?= $file->name ?>">
                        <img src="/img/tasks/thumbnail/<?= $file->name ?>" alt="img_thumbnail">
                    </a>
				<?php endforeach; ?>
            </div>
            <hr>


            <div class="task-comments">
                <h3><?= Yii::t('task', 'comments_bloc_title') ?></h3>

				<?php $form = ActiveForm::begin([
					'action' => Url::to(['task/add-comment']),
				]); ?>
				<?= $form->field($taskCommentForm, 'user_id')
					->hiddenInput(['value' => $userId])->label(false); ?>
				<?= $form->field($taskCommentForm, 'task_id')
					->hiddenInput(['value' => $model->id])->label(false); ?>
                <div class="row">
                    <div class="col-md-11">
						<?= $form->field($taskCommentForm, 'content')->textInput()->label(false); ?>
                    </div>
                    <div class="col-md-1">
						<?= Html::submitButton(
							Yii::t('task', 'comments_button'), ['class' => 'btn btn-success']
						); ?>
                    </div>
                </div>
				<?php ActiveForm::end() ?>

                <div class="task-comments-history">
					<?php foreach ($model->taskComments as $comment): ?>
                        <p><?= $comment->date_crate ?> <strong><?= $comment->user->username ?></strong>:
							<?= $comment->content ?></p>
					<?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>