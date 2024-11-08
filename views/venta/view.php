<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['listar']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="venta-view">

    <h1>Venta # <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Eliminar', ['eliminar', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Segur@ que deseas eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      // the owner name of the model
                'label' => 'Producto',
                'value' => $model->producto->nombre,
            ],
            [                      // the owner name of the model
                'label' => 'Vendedor',
                'value' => $model->usuario ? $model->usuario->nombre : "- Vendedor no asignado -",
            ],
            'cantidad',
            'precio',
            'fecha_venta',
        ],
    ]) ?>

</div>
