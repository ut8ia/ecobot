<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SettinsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'values') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'access') ?>

    <?php // echo $form->field($model, 'min') ?>

    <?php // echo $form->field($model, 'max') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
