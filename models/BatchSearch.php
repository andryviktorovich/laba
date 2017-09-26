<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Batch;

/**
 * BatchSearch represents the model behind the search form about `app\models\Batch`.
 */
class BatchSearch extends Batch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'id_mark', 'release_date', 'update_date', 'create_date'], 'safe'],
            [['cost', 'amount'], 'number'],
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
        $query = Batch::find()->where(['active' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>
                [
                    'defaultOrder'=>
                        [
                            'release_date'=>SORT_DESC
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
            'cost' => $this->cost,
            'amount' => $this->amount,
            'release_date' => $this->release_date,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'batch', $this->batch])
            ->andFilterWhere(['like', 'id_mark', $this->id_mark]);

        return $dataProvider;
    }
}
