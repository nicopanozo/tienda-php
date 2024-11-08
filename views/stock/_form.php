<?php

use app\models\Producto;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Stock $model */
/** @var yii\widgets\ActiveForm $form */


$data = [];
$dbquery = Producto::find()->select('id,nombre')->where(['eliminado'=>null])->asArray()->all();

foreach ($dbquery as $row){
    $data[$row["id"]] = $row["nombre"];
}

?>

<div class="stock-form">

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

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
