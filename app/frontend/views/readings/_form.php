<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Readings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="readings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'temperature' => 'Temperature', 'humidity' => 'Humidity', 'dust' => 'Dust', 'co2' => 'Co2', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'make')->textInput() ?>

    <?= $form->field($model, 'send')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
