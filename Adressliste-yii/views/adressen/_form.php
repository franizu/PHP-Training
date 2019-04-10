<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Adressen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adressen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vorname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nachname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'strasse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
