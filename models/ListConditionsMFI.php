<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "list__conditions_MFI".
 *
 * @property integer $id
 * @property string $conditions_MFI
 * @property string $conditions_MFI_en
 */
class ListConditionsMFI extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list__conditions_MFI';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['conditions_MFI'], 'required'],
            [['conditions_MFI', 'conditions_MFI_en'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID Условия определения ПТР',
            'conditions_MFI' => 'Условия определения ПТР',
            'conditions_MFI_en' => 'Условия определения ПТР англ',
        ];
    }

    public static function getListConditionsMFI(){
        $conditionsMFI = ListConditionsMFI::find()->all();

        return ArrayHelper::map($conditionsMFI, 'conditions_MFI', 'conditions_MFI');
    }
}
