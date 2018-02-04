<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $date_work
 * @property integer $id_machine
 * @property integer $operator
 * @property integer $shift
 * @property string $plan_product
 * @property string $fact_product
 * @property bool   $active
 * @property string $update_date
 * @property string $create_date
 * @property mixed timetables
 */
class Work extends \app\base\BaseModel
{
    CONST ACTIVE = 1;
    CONST NO_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_work', 'id_machine', 'operator', 'shift'], 'required'],
            [['date_work', 'update_date', 'create_date'], 'safe'],
            [['id_machine', 'operator', 'shift'], 'integer'],
            [['plan_product', 'fact_product'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_work' => Yii::t('app', 'Дата работы'),
            'id_machine' => Yii::t('app', 'Машина'),
            'operator' => Yii::t('app', 'Оператор'),
            'shift' => Yii::t('app', 'Смена'),
            'plan_product' => Yii::t('app', 'План на смену'),
            'fact_product' => Yii::t('app', 'Факт за смену'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'create_date' => Yii::t('app', 'Дата создания'),
        ];
    }

    public function delete()
    {
        $this->active = self::NO_ACTIVE;
        return $this->save();
    }

    public static function findOne($condition)
    {
        if(is_null($condition)){
            return null;
        }
        $model = parent::findOne($condition);
        if($model->active) {
            return $model;
        } else {
            return null;
        }
    }

    public function getMachine()
    {
        return $this->hasOne(Machine::className(), ['id' => 'id_machine']);
    }

    public function getOperatorMachine()
    {
        return $this->hasOne(Employees::className(), ['id' => 'operator']);
    }

    public function getTimetables(){
        return $this->hasMany(Timetable::className(), ['id_work' => 'id']);
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['id_work' => 'id']);
    }
}
