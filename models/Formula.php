<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "formula".
 *
 * @property integer $id_formula
 * @property string $id_mark
 * @property string $title
 * @property string $update_date
 * @property string $create_date
 */
class Formula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formula';
    }

    public function __construct()
    {
        parent::__construct();
//        $this->update_date = date('Y-m-d h:i:s');
//        $this->create_date = date('Y-m-d h:i:s');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mark', 'title'], 'required'],
            [['update_date', 'create_date'], 'safe'],
            [['id_mark'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_formula' => 'id формулы',
            'id_mark' => 'Марка',
            'title' => 'Подпись формулы',
            'update_date' => 'Дата обновления',
            'create_date' => 'Дата создания',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->update_date = date('Y-m-d H:i:s');
            if($this->isNewRecord){
//                $this->create_date = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    public function getElements()
    {
        return $this->hasMany(FormulaElements::className(), ['id_formula' => 'id_formula']);
    }

    public function validateElements($models, $attributeNames = null)
    {
        $valid = true;
        $totalPercent = 0;
        /* @var $model Model */
        foreach ($models as $model) {
            $valid = $model->validate($attributeNames) && $valid;
            $totalPercent += (float) $model->percent;
        }
        if($totalPercent > 100 || $totalPercent < 0){
            $this->addError('elements', 'Сумма процентного отношения сырья в формуле не должна быть больше 100%.');
            $valid = false;
        }

        return $valid;
    }
}
