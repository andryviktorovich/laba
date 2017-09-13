<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Connection;
/**
 * This is the model class for table "materials".
 *
 * @property integer $id
 * @property string $title
 * @property integer $analog
 * @property string $remark
 * @property string $description
 * @property string $update_date
 * @property string $create_date
 */
class Material extends \yii\db\ActiveRecord
{
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Yii::$app->db;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['analog'], 'integer'],
            [['title', 'remark', 'description'], 'string'],
            [['update_date', 'create_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID сырья',
            'title' => 'Название сырья',
            'analog' => 'Аналог',
            'remark' => 'Замечания',
            'description' => 'Описание',
            'update_date' => 'Дата изменения',
            'create_date' => 'Дата создания',
        ];
    }

    public static function getListMaterials(){
        $materials = Material::find()->all();

        return ArrayHelper::map($materials, 'id', 'title');
    }

    public static function getInStock(){
        $sql = "SELECT com.id,
                       com.id_material,
                       m.title AS material_title,
                       (com.amount - IFNULL(cun.amount,0)) as amount,
                       cost,
                       date_coming,
                       CONCAT(m.title, '(цена -', cost, ') - ', (com.amount - IFNULL(cun.amount,0)), ' кг') as title
                FROM (materials_coming com, materials m)
                LEFT JOIN ( SELECT id_material_coming, SUM(amount) AS amount
                            FROM materials_consumption
                            GROUP by id_material_coming) cun ON com.id = cun.id_material_coming
                WHERE (com.amount - IFNULL(cun.amount,0)) != 0 AND m.id = com.id_material
        ";

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return $data;//ArrayHelper::map($data, 'id', 'title');
    }
}
