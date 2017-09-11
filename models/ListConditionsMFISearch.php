<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ListConditionsMFI;

/**
 * ListConditionsMFISearch represents the model behind the search form about `app\models\ListConditionsMFI`.
 */
class ListConditionsMFISearch extends ListConditionsMFI
{
    public $search_word;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['search_word'], 'string'],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'search_word' => 'Параметр для поиска',
        ];
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
        $query = ListConditionsMFI::find();

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
            'id' => $this->search_word,
        ]);

        $query->orFilterWhere(['like', 'conditions_MFI', $this->search_word])
            ->orFilterWhere(['like', 'conditions_MFI_en', $this->search_word]);

        return $dataProvider;
    }
}
