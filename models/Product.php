<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $id_mark
 * @property string $type_product
 * @property integer $id_work
 * @property integer $batch
 * @property string $finiched
 * @property string $reject
 * @property string $starting
 * @property string $cleaning
 * @property string $waste
 * @property string $update_date
 * @property string $create_date
 */
class Product extends \app\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mark', 'type_product', 'batch'], 'required'],
            [['id_work'], 'integer'],
            [['id_mark', 'batch'], 'string'],
            [['finiched', 'reject', 'starting', 'cleaning', 'waste'], 'number'],
            [['update_date', 'create_date'], 'safe'],
            [['type_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_mark' => Yii::t('app', 'Марка'),
            'type_product' => Yii::t('app', 'Тип продукции'),
            'id_work' => Yii::t('app', 'Дата работы'),
            'batch' => Yii::t('app', 'Партия'),
            'finiched' => Yii::t('app', 'Готовая'),
            'reject' => Yii::t('app', 'Брак'),
            'starting' => Yii::t('app', 'Пусковые'),
            'cleaning' => Yii::t('app', 'Чистка'),
            'waste' => Yii::t('app', 'Отходы'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'create_date' => Yii::t('app', 'Дата создания'),
        ];
    }

    public function getMark()
    {
        return $this->hasOne(Marks::className(), ['id_mark' => 'id_mark']);
    }

    public function getBatch()
    {
        return $this->hasOne(Batch::className(), ['batch' => 'batch']);
    }
}
