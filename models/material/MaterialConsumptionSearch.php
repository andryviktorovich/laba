<?php

namespace app\models\material;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

/**
 * MaterialConsumptionSearch represents the model behind the search form about `app\models\MaterialConsumption`.
 */
class MaterialConsumptionSearch extends MaterialConsumption
{
    public $material;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_material_coming'], 'integer'],
            [['batch', 'material', 'date_consumption', 'update_date', 'create_date'], 'safe'],
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
        $this->load($params);
        $where = "1";

        if (!$this->validate()) {
            $where = "1";
        } else {
            $whereParams = [  'cun.id' => $this->id,
                        'com.id_material' => $this->material,
                        'cun.amount' => $this->amount,
                        'cun.date_consumption' => $this->date_consumption,
//                        'cun.update_date' => $this->update_date,
//                        'cun.create_date' => $this->create_date,
                    ];
            foreach ($whereParams as $key => $item){
                if(!empty($item)){
                    $item = gettype($item) == "string" ? "'" . $item . "'" : $item;
                    $where .= " AND $key = $item";
                }
            }
            if(!empty($this->batch))
                $where .= " AND cun.batch LIKE '" . $this->batch . "'";
        }

        $sql = "SELECT cun.*, m.title AS material

                FROM materials_consumption cun
                LEFT JOIN ( SELECT batch, MAX(date_consumption) AS date_last
                            FROM materials_consumption
                            GROUP by batch) b ON b.batch = cun.batch
                LEFT JOIN materials_coming com ON com.id = cun.id_material_coming
                LEFT JOIN materials m ON m.id = com.id_material
                WHERE " . $where . "
                ORDER by b.date_last DESC, cun.date_consumption DESC ";

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $dataProvider;
    }
}
