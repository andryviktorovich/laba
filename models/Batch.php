<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "batches".
 *
 * @property string $batch
 * @property string $id_mark
 * @property string $cost
 * @property string $amount
 * @property string $id_formula
 * @property string $release_date
 * @property string $update_date
 * @property string $create_date
 */
class Batch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batch', 'id_mark', 'amount', 'release_date', 'update_date', 'create_date'], 'required'],
            [['cost', 'amount'], 'number'],
            [['id_formula'], 'integer'],
            [['release_date', 'update_date', 'create_date'], 'safe'],
            [['batch'], 'string', 'max' => 50],
            [['id_mark'], 'string', 'max' => 100],
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
            'release_date' => 'Дата выпуска',
            'update_date' => 'Дата изменения',
            'create_date' => 'Дата создания',
        ];
    }

    public static function getListBatches(){
        $batches = Batch::find()->all();

        return ArrayHelper::map($batches, 'batch', 'batch');
    }

    public function getMark()
    {
        return $this->hasOne(Marks::className(), ['id_mark' => 'id_mark']);
    }
}
