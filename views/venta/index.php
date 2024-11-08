<?php

use app\models\Producto;
use app\models\Venta;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\VentaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Venta', ['crear'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'value' => 'producto.nombre',
                'attribute' => 'producto_id',
                'filter' => ArrayHelper::map(Producto::find()->asArray()->all(), 'id', 'nombre'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'300px'
                    ],
                ],
            ],
            'cantidad',
            'precio',
            'fecha_venta',
            [
                'class' => ActionColumn::className(),
                'template' => '{ver} {actualizar} {eliminar}', // Aquí solo incluimos ver y actualizar
                'buttons' => [
                    'ver' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-eye"></span>', $url);
                    },
                    'actualizar' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-edit"></span>', $url);
                    },
                    'eliminar' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-trash-alt"></span>', $url);
                    },
                    // Puedes agregar más botones personalizados aquí
                ],
            ],
        ],
    ]); ?>


</div>
