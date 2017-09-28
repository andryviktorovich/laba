<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BatchDetail;

/**
 * BatchDetailSearch represents the model behind the search form about `app\models\BatchDetail`.
 */
class BatchDetailSearch extends BatchDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number_feeder', 'size_bag'], 'integer'],
            [['batch', 'update_date', 'create_date'], 'safe'],
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
        $query = BatchDetail::find();

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
            'number_feeder' => $this->number_feeder,
            'size_bag' => $this->size_bag,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'batch', $this->batch]);

        return $dataProvider;
    }
}
