<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Application;

/**
 * ApplicationSearch represents the model behind the search form of `app\models\Application`.
 */
class ApplicationSearch extends Application
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['id', 'phone_number', 'from_sdu', 'first_auhtor', 'number_of_author', 'is_agree', 'created_at', 'updated_at'], 'integer'],
            [['name', 'surname', 'patronymic', 'rank', 'email', 'link_for_application', 'type_of_application', 'application_edition', 'ISSN', 'ISBN', 'DOI_link'], 'safe'],
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
        $query = Application::find();

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
            'phone_number' => $this->phone_number,
            'from_sdu' => $this->from_sdu,
            'first_auhtor' => $this->first_auhtor,
            'number_of_author' => $this->number_of_author,
            'is_agree' => $this->is_agree,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'rank', $this->rank])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'link_for_application', $this->link_for_application])
            ->andFilterWhere(['like', 'type_of_application', $this->type_of_application])
            ->andFilterWhere(['like', 'application_edition', $this->application_edition])
            ->andFilterWhere(['like', 'ISSN', $this->ISSN])
            ->andFilterWhere(['like', 'ISBN', $this->ISBN])
            ->andFilterWhere(['like', 'DOI_link', $this->DOI_link]);

        return $dataProvider;
    }
}
