<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */

$this->title = 'Actualizar Venta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['listar']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['ver', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,

    ]) ?>

</div>
