<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stock $model */

$this->title = 'Crear Stock';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['listar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
