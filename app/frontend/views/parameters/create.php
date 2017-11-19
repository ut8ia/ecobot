<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Parameters */

$this->title = Yii::t('app', 'Create Parameters');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parameters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parameters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
