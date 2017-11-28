<?php

/* @var $this yii\web\View */

$this->title = 'EсoBot';
use dosamigos\chartjs\ChartJs;

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
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => "2,5 мкм",
                        'backgroundColor' => "rgba(255,99,132,0.2)",
                        'borderColor' => "rgba(255,99,132,1)",
                        'pointBackgroundColor' => "rgba(255,99,132,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                        'data' => $dust25
                    ],
                    [
                        'label' => "10 мкм",
                        'backgroundColor' => "rgba(179,181,198,0.2)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => $dust10
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
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => "Температура повітря",
                        'backgroundColor' => "rgba(159,200,240,0.2)",
                        'borderColor' => "rgba(159,200,240,1)",
                        'pointBackgroundColor' => "rgba(159,200,240,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(159,200,240,1)",
                        'data' => $temperature
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
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => "Вологість повітря",
                        'backgroundColor' => "rgba(55,199,132,0.2)",
                        'borderColor' => "rgba(55,199,132,1)",
                        'pointBackgroundColor' => "rgba(55,199,132,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(255,99,132,1)",
                        'data' => $humidity
                    ]
                ]
            ]
        ]);
        ?>
        <br>
        <p><a class="btn btn-lg btn-success" href="/">Оновити</a></p>
    </div>

</div>
