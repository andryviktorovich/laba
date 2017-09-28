<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batch_detail".
 *
 * @property integer $id
 * @property string $batch
 * @property integer $number_feeder
 * @property integer $size_bag
 * @property string $update_date
 * @property string $create_date
 */
class BatchDetail extends \app\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batch_detail';
    }

    public function __construct()
    {
        parent::__construct();
        $this->size_bag = 25;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_feeder'], 'required'],
            [['number_feeder', 'size_bag'], 'integer'],
            [['update_date', 'create_date'], 'safe'],
            [['batch'], 'string', 'max' => 50],
            ['size_bag', 'default', 'value' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'batch' => Yii::t('app', 'Партия'),
            'number_feeder' => Yii::t('app', 'Номер дозатора'),
            'size_bag' => Yii::t('app', 'Размер мешка, кг'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'create_date' => Yii::t('app', 'Дата создания'),
        ];
    }

    public function getElements(){
        return $this->hasMany(BatchDetailElement::className(), ['id_detail' => 'id']);
    }
}
