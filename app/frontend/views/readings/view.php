<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Readings */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Readings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="readings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'type' => $model->type, 'make' => $model->make], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'type' => $model->type, 'make' => $model->make], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type',
            'value',
            'make',
            'send',
        ],
    ]) ?>

</div>
