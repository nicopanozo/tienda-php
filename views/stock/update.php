<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stock $model */

$this->title = 'Actualizar Stock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['listar']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['ver', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
