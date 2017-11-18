<?php

/* @var $this yii\web\View */

$this->title = 'EсoBot';
use dosamigos\chartjs\ChartJs;
use common\models\Readings;

$data = Readings::find()
    ->limit(196)
    ->orderBy(['make' => SORT_DESC])
    ->where(['type' => [Readings::TYPE_HUMIDITY, Readings::TYPE_TEMPERATURE]])
    ->all();

$labels = [];
$temp = [];
$hum = [];
$labelstemp = [];
$labelshum = [];

foreach ($data as $item) {

    if ($item->type === Readings::TYPE_TEMPERATURE) {
        $temp[] = $item->value / 10;
        $labelstemp[] = $item->make;
    }
    if ($item->type === Readings::TYPE_HUMIDITY) {
        $hum[] = $item->value / 10;
        $labelshum[] = $item->make;
    }
}

$dust = Readings::find()
    ->limit(97)
    ->orderBy(['make' => SORT_DESC])
    ->where(['type' => Readings::TYPE_DUST])
    ->all();

$dustLabels = [];
$d10 = [];
$d25 = [];
foreach ($dust as $item) {
    $dust = json_decode($item->value);
    $d10[] = $dust[0];
    $d25[] = $dust[1];
    $dustLabels[] = $item->make;
}


?>
<div class="site-index">

    <div class="jumbotron">

        <h1><?= date('d.m.Y'); ?></h1>
        <p class="lead">забрудненність повітря мікрочастинами, ppm</p>


        <?= ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 200,
                'width' => 400
            ],
            'data' => [
                'labels' => $dustLabels,
                'datasets' => [
                    [
                        'label' => "2,5 мкм",
                        'backgroundColor' => "rgba(255,99,132,0.2)",
                        'borderColor' => "rgba(255,99,132,1)",
                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                        'data' => $d25
                    ],
                    [
                        'label' => "10 мкм",
                        'backgroundColor' => "rgba(179,181,198,0.2)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => $d10
                    ]
                ]
            ]
        ]);
        ?>


        <p class="lead">Температура повітря</p>

        <?= ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 200,
                'width' => 400
            ],
            'data' => [
                'labels' => $labelstemp,
                'datasets' => [
                    [
                        'label' => "Температура повітря",
                        'backgroundColor' => "rgba(159,200,240,0.2)",
                        'borderColor' => "rgba(159,200,240,1)",
                        'pointBackgroundColor' => "rgba(159,200,240,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(159,200,240,1)",
                        'data' => $temp
                    ],
                ]
            ]
        ]);
        ?>

        <p class="lead">Вологість повітря</p>

        <?= ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 200,
                'width' => 400
            ],
            'data' => [
                'labels' => $labelshum,
                'datasets' => [
                    [
                        'label' => "Вологість повітря",
                        'backgroundColor' => "rgba(55,199,132,0.2)",
                        'borderColor' => "rgba(55,199,132,1)",
                        'pointBackgroundColor' => "rgba(55,199,132,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                        'data' => $hum
                    ]
                ]
            ]
        ]);
        ?>
        <br>
        <p><a class="btn btn-lg btn-success" href="/">Оновити</a></p>
    </div>

</div>
