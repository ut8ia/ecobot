<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Parameters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parameters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([ 'temperature' => 'Temperature', 'humidity' => 'Humidity', 'dust10' => 'Dust10', 'dust25' => 'Dust25', 'gas' => 'Gas', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'report_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
