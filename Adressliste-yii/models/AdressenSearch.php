<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Adressen;

/**
 * AdressenSearch represents the model behind the search form of `app\models\Adressen`.
 */
class AdressenSearch extends Adressen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['vorname', 'nachname', 'strasse', 'plz', 'ort'], 'safe'],
            [['longitude', 'latitude'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Adressen::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ]);

        $query->andFilterWhere(['like', 'vorname', $this->vorname])
            ->andFilterWhere(['like', 'nachname', $this->nachname])
            ->andFilterWhere(['like', 'strasse', $this->strasse])
            ->andFilterWhere(['like', 'plz', $this->plz])
            ->andFilterWhere(['like', 'ort', $this->ort]);

        return $dataProvider;
    }
}
