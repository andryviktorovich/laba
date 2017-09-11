<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "list__colors".
 *
 * @property integer $id_color
 * @property string $color
 * @property string $color_en
 */
class ListColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'list__colors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['color', 'color_en'], 'string', 'max' => 50],
            [['color'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_color' => 'Id цвета',
            'color' => 'Цвет',
            'color_en' => 'Цвет на анг.',
        ];
    }

    public static function getListColor(){
        $colors = ListColor::find()->all();

        return ArrayHelper::map($colors, 'id_color', 'color');
    }

}
