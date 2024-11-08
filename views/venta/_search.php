<?php

use app\models\Producto;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VentaSearch $model */
/** @var yii\widgets\ActiveForm $form */

$data = [];
$dbquery = Producto::find()->select('id,nombre')->asArray()->all();

foreach ($dbquery as $row){
    $data[$row["id"]] = $row["nombre"];
}
?>

<div class="venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['listar'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => $data,
            'options' => ['placeholder' => 'Seleccione el producto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'precio') ?>

    <?= $form->field($model, 'fecha_venta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
