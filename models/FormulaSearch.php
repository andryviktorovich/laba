<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * FormulaSearch represents the model behind the search form about `app\models\Formula`.
 */
class FormulaSearch extends Formula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_formula'], 'integer'],
            [['id_mark', 'title', 'update_date', 'create_date'], 'safe'],
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
        $query = Formula::find();

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
            'id_formula' => $this->id_formula,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'id_mark', $this->id_mark])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

    public function searchByBatch($batchId){
        if (($batch = Batch::findOne($batchId)) !== null) {
            $query = Formula::find()->where(['id_mark' => $batch->id_mark]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'=>
                    [
                        'defaultOrder' =>
                            [
                                'update_date' => SORT_DESC
                            ]
                    ],
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            return $dataProvider;
        }
        return null;
    }
}
