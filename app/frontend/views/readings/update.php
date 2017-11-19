<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Readings */

$this->title = Yii::t('app', 'Update Readings: {nameAttribute}', [
    'nameAttribute' => $model->type,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Readings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'type' => $model->type, 'make' => $model->make]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="readings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
