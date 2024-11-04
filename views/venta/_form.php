<?php

use app\models\Producto;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Venta $model */
/** @var yii\widgets\ActiveForm $form */

$data = [];
$dbquery = Producto::find()->select('id,nombre')->asArray()->all();

foreach ($dbquery as $row){
    $data[$row["id"]] = $row["nombre"];
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
        'options' => ['placeholder' => 'Enter event time ...'],
        'pluginOptions' => [
            'todayBtn' => true,
            'autoclose' => true
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
