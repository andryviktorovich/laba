<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaterialConsumption;

/**
 * MaterialConsumptionSearch represents the model behind the search form about `app\models\MaterialConsumption`.
 */
class MaterialConsumptionSearch extends MaterialConsumption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_material_coming'], 'integer'],
            [['batch', 'date_consuption', 'update_date', 'create_date'], 'safe'],
            [['amount'], 'number'],
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
        $query = MaterialConsumption::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort'=>
                [
                    'defaultOrder'=>
                        [
                            'date_consuption'=>SORT_DESC
                        ]
                ]
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
            'id_material_coming' => $this->id_material_coming,
            'amount' => $this->amount,
            'date_consuption' => $this->date_consuption,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'batch', $this->batch]);

        return $dataProvider;
    }
}
