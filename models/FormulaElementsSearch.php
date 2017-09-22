<?php
//
namespace app\models;
//
//use Yii;
//use yii\base\Model;
//use yii\data\ActiveDataProvider;
//use yii\data\SqlDataProvider;
//
///**
// * FormulaElementsSearch represents the model behind the search form about `app\models\FormulaElements`.
// */
//class FormulaElementsSearch extends FormulaElements
//{
//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return [
//            [['id', 'id_formula', 'id_material'], 'integer'],
//            [['percent', 'cost'], 'number'],
//            [['update_date', 'create_date'], 'safe'],
//        ];
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }
//
//    /**
//     * Creates data provider instance with search query applied
//     *
//     * @param array $params
//     *
//     * @return ActiveDataProvider
//     */
//    public function search($id)
//    {
//        $sql = "SELECT f.*, m.title AS material, ROUND(IFNULL(f.percent,0)/100*IFNULL(f.cost,0), 3) AS costM
//
//                FROM formula_elements f, materials m
//                WHERE m.id = f.id_material AND f.id_formula = $id";
//
//        $dataProvider = new SqlDataProvider([
//            'sql' => $sql,
//            'pagination' => false,
//        ]);
//        return $dataProvider;
//    }
//}
