<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Marks;

/**
 * MarkSearch represents the model behind the search form about `app\models\Marks`.
 */
class MarkSearch extends Marks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mark', 'light_fastness', 'pigment_migration', 'norma_MFI', 'conditions_MFI', 'bulk_density', 'base_polymer', 'description', 'update_date', 'create_date'], 'safe'],
            [['id_color', 'id_additive', 'heat_resistance', 'contact_with_food'], 'integer'],
            [['polymer_content', 'humidity'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Marks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_color' => $this->id_color,
            'id_additive' => $this->id_additive,
            'heat_resistance' => $this->heat_resistance,
            'contact_with_food' => $this->contact_with_food,
            'polymer_content' => $this->polymer_content,
            'humidity' => $this->humidity,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'id_mark', $this->id_mark])
            ->andFilterWhere(['like', 'light_fastness', $this->light_fastness])
            ->andFilterWhere(['like', 'pigment_migration', $this->pigment_migration])
            ->andFilterWhere(['like', 'norma_MFI', $this->norma_MFI])
            ->andFilterWhere(['like', 'conditions_MFI', $this->conditions_MFI])
            ->andFilterWhere(['like', 'bulk_density', $this->bulk_density])
            ->andFilterWhere(['like', 'base_polymer', $this->base_polymer])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
