<?php

namespace app\models\material;

use Yii;
use app\models\Provider;

/**
 * This is the model class for table "materials_coming".
 *
 * @property integer $id
 * @property integer $id_material
 * @property integer $id_provider
 * @property string $amount
 * @property string $cost
 * @property string $date_coming
 * @property string $remark
 * @property string $update_date
 * @property string $create_date
 */
class MaterialComing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materials_coming';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_material', 'id_provider', 'amount', 'cost', 'date_coming', 'update_date', 'create_date'], 'required'],
            [['id_material', 'id_provider'], 'integer'],
            [['amount', 'cost'], 'number'],
            [['date_coming', 'update_date', 'create_date'], 'safe'],
            [['remark'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID поставки',
            'id_material' => 'Сырье',
            'id_provider' => 'Поставщик',
            'amount' => 'Количество, кг.',
            'cost' => 'Цена за кг.',
            'date_coming' => 'Дата поставки',
            'remark' => 'Замечания',
            'update_date' => 'Дата изменения записи',
            'create_date' => 'Дата создания записи',
        ];
    }

    public function getMaterial(){
        return $this->hasOne(Material::className(), ['id' => 'id_material']);
    }

    public function getProvider(){
        return $this->hasOne(Provider::className(), ['id' => 'id_provider']);
    }
}
