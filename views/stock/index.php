<?php

use app\models\Stock;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StockSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stocks';
$this->params['breadcrumbs'][] = $this->title;

define("MIN_CANT_ITEMS_STOCK", 10);

?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [                     
                'label' => 'Producto',
                'value' => function($model) { 
                    return $model->producto->nombre;
                }
            ],
            [                     
                'label' => 'Cantidad',
                'value' => function($model) { 
                    if($model->cantidad < MIN_CANT_ITEMS_STOCK) {
                        return '<div class="out-stock">' . $model->cantidad . '<br><span class="alerta"><B>ALERTA:</B> Stock bajo</span></div>';
                    } else {
                        return $model->cantidad;
                    }
                },
                'format' => 'raw'

            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{ver} {actualizar}', // Aquí solo incluimos ver y actualizar
                'buttons' => [
                    'ver' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-eye"></span>', $url);
                    },
                    'actualizar' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-edit"></span>', $url);
                    },
                    // Puedes agregar más botones personalizados aquí
                ],
            ],
        ],
    ]); ?>


</div>
