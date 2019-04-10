<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adressen".
 *
 * @property int $id
 * @property string $vorname
 * @property string $nachname
 * @property string $strasse
 * @property string $plz
 * @property string $ort
 * @property double $longitude
 * @property double $latitude
 */
class Adressen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adressen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vorname', 'nachname', 'strasse', 'plz', 'ort', 'longitude', 'latitude'], 'required'],
            [['longitude', 'latitude'], 'number'],
            [['vorname', 'nachname', 'strasse', 'plz', 'ort'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vorname' => 'Vorname',
            'nachname' => 'Nachname',
            'strasse' => 'Straße',
            'plz' => 'Postleitzahl',
            'ort' => 'Ort',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }
}
