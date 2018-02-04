<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "batches".
 *
 * @property string $batch
 * @property string $id_mark
 * @property float $cost
 * @property float $amount
 * @property integer $id_formula
 * @property string $date_start
 * @property string $release_date
 * @property boolean $active
 * @property integer $count_bag
 * @property string $update_date
 * @property string $create_date
 */
class Batch extends \app\base\BaseModel
{
    CONST ACTIVE = 1;
    CONST NO_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batches';
    }

    public function __construct()
    {
        parent::__construct();
        $this->count_bag = 1;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'id_mark', 'amount'], 'required'],
            [['cost', 'amount'], 'number'],
            [['id_formula', 'id_machine', 'count_bag'], 'integer'],
            [['release_date', 'date_start', 'update_date', 'create_date'], 'safe'],
            [['batch'], 'string', 'max' => 50],
            [['id_mark'], 'string', 'max' => 100],
            ['active', 'default', 'value' => 1],
            ['count_bag', 'default', 'value' => 1],
            [['count_bag'], 'integer', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'batch' => 'Партия',
            'id_mark' => 'Марка',
            'cost' => 'Цена за кг.',
            'amount' => 'Количество, кг.',
            'id_formula' => 'Формула',
            'id_machine' => 'Машина',
            'date_start' => 'Дата начала',
            'release_date' => 'Дата выпуска',
            'active' => 'Активен',
            'count_bag' => 'Количесво мешков',
            'update_date' => 'Дата изменения записи',
            'create_date' => 'Дата создания записи',
        ];
    }

    public static function getListBatches(){
        $batches = Batch::find()->where(['active' => 1])->all();

        return ArrayHelper::map($batches, 'batch', 'batch');
    }

    public function getMark()
    {
        return $this->hasOne(Marks::className(), ['id_mark' => 'id_mark']);
    }

    public function getMachine()
    {
        return $this->hasOne(Machine::className(), ['id' => 'id_machine']);
    }

    public function getDetails(){
        return $this->hasMany(BatchDetail::className(), ['batch' => 'batch']);
    }

    public function getCalculationDetail(){
        $sql = "SELECT
                FROM batch_detail bd, batch_detail_elements be


                WHERE bd.id = be.id_detail";
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
}
