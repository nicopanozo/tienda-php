<?php

use app\models\Producto;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */
/** @var app\models\Producto[] $productos */
/** @var yii\widgets\ActiveForm $form */

$data = [];
// $dbquery = Producto::find()->select('id,nombre')->asArray()->all();

// foreach ($dbquery as $row){
//     $data[$row["id"]] = $row["nombre"];
// }

foreach($productos as $producto){
    $data[$producto->id] = $producto->nombre . ' - ' . $producto->stock->cantidad . ' unidades - (Precio sugerido) ' . $producto->precio. ' Bs.';
}



?>

<div class="venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'producto_id')->widget(Select2::classname(), [
            'data' => $data,
            'options' => ['placeholder' => 'Seleccione el producto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'fecha_venta')->widget(DateTimePicker::classname(), [
        // 'options' => ['placeholder' => 'Enter event time ...'],
        // 'type' => DateTimePicker::TYPE_INLINE,
        'value' => date('Y-m-d H:i:s'),
        'pluginOptions' => [
            // 'format' => 'dd-M-yyyy hh:ii',
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose' => true
    ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
