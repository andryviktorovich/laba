<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property integer $id
 * @property integer $id_employee
 * @property string $hours_operation
 * @property integer $id_work
 * @property integer $id_position
 */
class Timetable extends \app\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_employee', 'hours_operation'], 'required'],
            [['id_employee', 'id_work', 'id_position'], 'integer'],
            [['hours_operation'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_employee' => Yii::t('app', 'Сотрудник'),
            'hours_operation' => Yii::t('app', 'Часы работы'),
            'id_work' => Yii::t('app', 'Дата работы'),
            'id_position' => Yii::t('app', 'Должность'),
        ];
    }
}
