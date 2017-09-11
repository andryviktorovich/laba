<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "list__polymers".
 *
 * @property integer $id
 * @property string $base_polymer
 * @property string $melting_temperature
 */
class ListPolymer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list__polymers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['base_polymer'], 'required'],
            [['base_polymer', 'melting_temperature'], 'string', 'max' => 50],
            [['base_polymer'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID полимера',
            'base_polymer' => 'Базовый полимер',
            'melting_temperature' => 'Температура плавления',
        ];
    }

    public static function getListPolymer(){
        $polymers = ListPolymer::find()->all();

        return ArrayHelper::map($polymers, 'base_polymer', 'base_polymer');
    }
}
