<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'values')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'string' => 'String', 'integer' => 'Integer', 'float' => 'Float', 'array' => 'Array', 'bool' => 'Bool', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'access')->dropDownList([ 'public' => 'Public', 'protected' => 'Protected', 'private' => 'Private', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'min')->textInput() ?>

    <?= $form->field($model, 'max')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
