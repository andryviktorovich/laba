<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

/**
 * MaterialConsumptionSearch represents the model behind the search form about `app\models\MaterialConsumption`.
 */
class MaterialInStock extends MaterialComing
{
    public $material;
    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_material', 'id_provider'], 'integer'],
            [['amount', 'cost'], 'number'],
            [['date_coming', 'remark', 'update_date', 'create_date'], 'safe'],
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


//    public function search($params)
//    {
//        $query = MaterialComing::find();
//
//        // add conditions that should always apply here
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'sort'=>
//                [
//                    'defaultOrder'=>
//                        [
//                            'date_coming'=>SORT_DESC
//                        ]
//                ]
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_material' => $this->id_material,
//            'id_provider' => $this->id_provider,
//            'amount' => $this->amount,
//            'cost' => $this->cost,
//            'date_coming' => $this->date_coming,
//            'update_date' => $this->update_date,
//            'create_date' => $this->create_date,
//        ]);
//
//        $query->andFilterWhere(['like', 'remark', $this->remark]);
//
//        return $dataProvider;
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return SqlDataProvider
     */
    public static function getInStock(){
        $sql = "SELECT com.id,
                       com.id_material,
                       m.title AS material_title,
                       p.name AS provider_name,
                       (com.amount - IFNULL(cun.amount,0)) as amount,
                       cost,
                       date_coming,
                       CONCAT(m.title, '(цена -', cost, ')') as title
                FROM (materials_coming com, materials m, providers p)
                LEFT JOIN ( SELECT id_material_coming, SUM(amount) AS amount
                            FROM materials_consumption
                            GROUP by id_material_coming) cun ON com.id = cun.id_material_coming
                WHERE (com.amount - IFNULL(cun.amount,0)) != 0 AND m.id = com.id_material AND p.id = com.id_provider
                ORDER BY com.id_material
        ";

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::map($data, 'id', 'title');
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
        $this->load($params);
        $where = "";

        if (!$this->validate()) {
            $where = "";
        } else {
            $whereParams = [
                'com.id_material' => $this->id_material,
                'com.id_provider' => $this->id_provider,
                '(com.amount - IFNULL(cun.amount,0))' => $this->amount,
                'com.date_coming' => $this->date_coming,
//                        'cun.update_date' => $this->update_date,
//                        'cun.create_date' => $this->create_date,
            ];
            foreach ($whereParams as $key => $item){
                if(!empty($item)){
                    $item = gettype($item) == "string" ? "'" . $item . "'" : $item;
                    $where .= " AND $key = $item";
                }
            }
        }

        $sql = "SELECT com.id,
                       com.id_material,
                       m.title AS material_title,
                       com.id_provider,
                       p.name AS provider_name,
                       (com.amount - IFNULL(cun.amount,0)) as amount,
                       cost,
                       date_coming,
                       CONCAT(m.title, '(цена -', cost, ')') as title
                FROM (materials_coming com, materials m, providers p)
                LEFT JOIN ( SELECT id_material_coming, SUM(amount) AS amount
                            FROM materials_consumption
                            GROUP by id_material_coming) cun ON com.id = cun.id_material_coming
                WHERE (com.amount - IFNULL(cun.amount,0)) != 0 AND m.id = com.id_material AND p.id = com.id_provider " . $where . "
                ORDER BY com.id_material";

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
//            'pagination' => [
//                'pageSize' => 50,
//            ],
        ]);
        return $dataProvider;
    }
}