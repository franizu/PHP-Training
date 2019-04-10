<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adressen */

$this->title = 'Create Adressen';
$this->params['breadcrumbs'][] = ['label' => 'Adressens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adressen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
