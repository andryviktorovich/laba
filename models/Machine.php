<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "machine".
 *
 * @property integer $id
 * @property string $title
 * @property integer $count_feeder
 * @property string $description
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'count_feeder'], 'required'],
            [['count_feeder'], 'integer'],
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
            'title' => Yii::t('app', 'Машина'),
            'count_feeder' => Yii::t('app', 'Количество дозаторов'),
            'description' => Yii::t('app', 'Описание'),
        ];
    }

    public static function getListMachine(){
        $machine = Machine::find()->all();

        return ArrayHelper::map($machine, 'id', 'title');
    }
}
