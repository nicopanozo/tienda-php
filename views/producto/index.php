<?php

use app\models\Producto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Producto', ['crear'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion',
            'precio',
            'talla',
            'color',
            'categoria',
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
