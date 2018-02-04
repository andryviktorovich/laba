<?php

namespace app\models\listmodels;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "list__type_product".
 *
 * @property integer $id
 * @property string $type_product
 */
class ListTypeProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list__type_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_product'], 'required'],
            [['type_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_product' => Yii::t('app', 'Тип продукции'),
        ];
    }

    public static function getListTypeProducts(){
        $types = ListTypeProduct::find()->all();

        return ArrayHelper::map($types, 'id', 'type_product');
    }
}
