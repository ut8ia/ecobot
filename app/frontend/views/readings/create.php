<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Readings */

$this->title = Yii::t('app', 'Create Readings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Readings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="readings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
