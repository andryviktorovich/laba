<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "list__additives".
 *
 * @property integer $id
 * @property string $additive
 * @property string $description
 * @property string $toxicologists
 */
class ListAdditive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list__additives';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['additive'], 'required'],
            [['description', 'toxicologists'], 'string'],
            [['additive'], 'string', 'max' => 255],
            [['additive'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID добавки',
            'additive' => 'Добавка',
            'description' => 'Описание',
            'toxicologists' => 'токсикологи и ПС',
        ];
    }
}
