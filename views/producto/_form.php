<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Producto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textArea() ?>

    <?= $form->field($model, 'precio')->textInput() ?>
    <?= $form->field($model, 'talla')->widget(Select2::classname(), [
            'data' => ["XS" => "XS", "S" => "S", "M" => "M", "L" => "L", "XL" => "XL"],
            'options' => ['placeholder' => 'Seleccione la talla ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

<?= $form->field($model, 'color')->widget(Select2::classname(), [
            'data' => ["NEGRO" => "NEGRO", "BLANCO" => "BLANCO", "ROJO" => "ROJO", "AZUL" => "AZUL", "VERDE" => "VERDE"],
            'options' => ['placeholder' => 'Seleccione el color ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

<?= $form->field($model, 'categoria')->widget(Select2::classname(), [
            'data' => ["POLERA" => "POLERA", "PANTALON" => "PANTALON", "SHORT" => "SHORT", "BLUSA" => "BLUSA", "VESTIDO" => "VESTIDO", "GORRA" => "GORRA", "ZAPATO" => "ZAPATO"],
            'options' => ['placeholder' => 'Seleccione la categoria ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
