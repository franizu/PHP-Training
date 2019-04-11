<?php
use yii\widgets\ActiveForm;


$this->title = 'Importer';
$this->params['breadcrumbs'][] = ['label' => 'Adressen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>