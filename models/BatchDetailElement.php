<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batch_detail_elements".
 *
 * @property integer $id
 * @property integer $id_detail
 * @property integer $id_material
 * @property float $percent
 * @property string $update_date
 * @property string $create_date
 */
class BatchDetailElement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'batch_detail_elements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_material', 'percent'], 'required'],
            [['id_detail', 'id_material'], 'integer'],
            [['percent'],'number', 'max' => 100],
            [['update_date', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_detail' => Yii::t('app', 'Наряд'),
            'id_material' => Yii::t('app', 'Сырье'),
            'percent' => Yii::t('app', 'Количество, %'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'create_date' => Yii::t('app', 'Дата создания'),
        ];
    }
}
