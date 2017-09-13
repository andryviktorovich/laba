<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "marks".
 *
 * @property string $id_mark
 * @property integer $id_color
 * @property integer $id_additive
 * @property integer $heat_resistance
 * @property string $light_fastness
 * @property string $pigment_migration
 * @property integer $contact_with_food
 * @property string $norma_MFI
 * @property string $conditions_MFI
 * @property string $bulk_density
 * @property string $polymer_content
 * @property string $base_polymer
 * @property string $humidity
 * @property string $description
 * @property string $update_date
 * @property string $create_date
 */
class Marks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mark', 'contact_with_food', 'update_date', 'create_date'], 'required'],
            [['id_color', 'id_additive', 'heat_resistance', 'light_fastness', 'pigment_migration', 'contact_with_food'], 'integer'],
            [['description'], 'string'],
            [['polymer_content', 'humidity'], 'number', 'max' => 100, 'min' => 0],
            [['update_date', 'create_date'], 'safe'],
            [['id_mark'], 'string', 'max' => 100],
            [['norma_MFI', 'bulk_density'], 'string', 'max' => 20],
            [['conditions_MFI', 'base_polymer'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mark' => 'Марка',
            'id_color' => 'Цвет',
            'id_additive' => 'Добавка',
            'heat_resistance' => 'Термостойкость',
            'light_fastness' => 'Светостойкость',
            'pigment_migration' => 'Миграция пигмента',
            'contact_with_food' => 'Контакт с пищей',
            'norma_MFI' => 'Норма ПТР для рецептуры',
            'conditions_MFI' => 'Условия определения ПТР',
            'bulk_density' => 'Насыпная плотность для рецептуры',
            'polymer_content' => 'Содерж полимера (%)',
            'base_polymer' => 'Базовый полимер',
            'humidity' => 'Влажность, (%)',
            'description' => 'Описание',
            'update_date' => 'Дата обновления запси',
            'create_date' => 'Дата создание запси',
        ];
    }

    public function getColor()
    {
        return $this->hasOne(ListColor::className(), ['id_color' => 'id_color']);
    }

    public function getAdditive()
    {
        return $this->hasOne(ListAdditive::className(), ['id' => 'id_additive']);
    }

    public static function getListMarks(){
        $marks = Marks::find()->all();

        return ArrayHelper::map($marks, 'id_mark', 'id_mark');
    }
}
