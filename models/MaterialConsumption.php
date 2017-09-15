<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "materials_consumption".
 *
 * @property integer $id
 * @property integer $id_material_coming
 * @property string $batch
 * @property string $amount
 * @property string $date_consumption
 * @property string $update_date
 * @property string $create_date
 */
class MaterialConsumption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materials_consumption';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_material_coming', 'batch', 'amount', 'date_consumption', 'update_date', 'create_date'], 'required'],
            [['id_material_coming'], 'integer'],
            [['amount'], 'number'],
            [['date_consumption', 'update_date', 'create_date'], 'safe'],
            [['batch'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID расхода',
            'id_material_coming' => 'Сырье',
            'batch' => 'Партия',
            'amount' => 'Количество, кг.',
            'date_consumption' => 'Дата списания',
            'update_date' => 'Дата изменения записи',
            'create_date' => 'Дата создания записи',
        ];
    }

    public  function getItemsToUpdate($batch){
        return MaterialConsumption::find()
                    ->where(['batch' => $batch])
                    ->orderBy('date_consumption')
                    ->all();
    }

    public function getMaterial(){
        return $this->hasOne(Material::className(), ['id' => 'id_material']);
    }
}
