<?php use yii\helpers\Html;
//echo Yii::$app->name;die;
$form = \yii\widgets\ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
<?= $form->field($model, 'picture')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php \yii\widgets\ActiveForm::end(); ?>

