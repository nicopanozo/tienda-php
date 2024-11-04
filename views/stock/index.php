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
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                    if($model->cantidad < 10) {
                        return '<div class="out-stock">' . $model->cantidad . '<br><span class="alerta"><B>ALERTA:</B> Stock bajo</span></div>';
                    } else {
                        return $model->cantidad;
                    }
                },
                'format' => 'raw'

            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stock $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
