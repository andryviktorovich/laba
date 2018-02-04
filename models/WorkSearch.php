<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Work;

/**
 * WorkSearch represents the model behind the search form about `app\models\Work`.
 */
class WorkSearch extends Work
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_machine', 'operator', 'shift'], 'integer'],
            [['date_work', 'update_date', 'create_date'], 'safe'],
            [['plan_product', 'fact_product'], 'number'],
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
        $query = Work::find()->where(['active' => 1]);

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
            'date_work' => $this->date_work,
            'id_machine' => $this->id_machine,
            'operator' => $this->operator,
            'shift' => $this->shift,
            'plan_product' => $this->plan_product,
            'fact_product' => $this->fact_product,
            'update_date' => $this->update_date,
            'create_date' => $this->create_date,
        ]);

        return $dataProvider;
    }
}
