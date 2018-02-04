<?php

namespace app\models;

use Yii;
use \yii\helpers\ArrayHelper;
/**
 * This is the model class for table "position".
 *
 * @property integer $id
 * @property string $title
 * @property string $payment
 * @property string $description
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['payment'], 'number'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Должность'),
            'payment' => Yii::t('app', 'Оплата за час'),
            'description' => Yii::t('app', 'Описание'),
        ];
    }

    public static function getListPosition(){
        $positions = Position::find()->all();

        return ArrayHelper::map($positions, 'id', 'title');
    }
}
