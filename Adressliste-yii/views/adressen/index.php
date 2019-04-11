<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdressenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adressen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adressen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Neue Adresse', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Karte anzeigen', ['adressen/show-map'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?= Html::a('Importer', ['adressen/upload'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php

       /* echo "<div>";
        echo "<form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\"> ";
        echo "Select image to upload:";
        echo "<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">";
        echo "<input type=\"submit\" value=\"Upload File\" name=\"submit\">";
        echo "</form>";
        echo "</div>";*/


    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'vorname',
            'nachname',
            'strasse',
            'plz',
            'ort',
            //'longitude',
            //'latitude',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
