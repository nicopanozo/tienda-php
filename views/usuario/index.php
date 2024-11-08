<?php

use app\models\Usuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UsuarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Usuario', ['crear'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'usuario',
            'nombre',
            'password',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {eliminar}', // Aquí solo incluimos ver y actualizar
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-eye"></span>', $url);
                    },
                    'update' => function ($url, $model, $key) {
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
