<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */
/** @var app\models\Producto[] $productos */

$this->title = 'Crear Venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['listar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productos' => $productos,
    ]) ?>

</div>
