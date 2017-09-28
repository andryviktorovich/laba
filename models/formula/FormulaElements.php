<?php

namespace app\models\formula;

use Yii;

/**
 * This is the model class for table "formula_elements".
 *
 * @property integer $id
 * @property integer $id_formula
 * @property integer $id_material
 * @property string $percent
 * @property string $cost
 * @property string $update_date
 * @property string $create_date
 */
class FormulaElements extends \app\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formula_elements';
    }

    public function __construct()
    {
        parent::__construct();
//        $this->update_date = date('Y-m-d h:i:s');
//        $this->create_date = date('Y-m-d h:i:s');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_material', 'percent'], 'required'],
            [['id_formula', 'id_material'], 'integer'],
            [['cost'], 'number'],
            [['percent'], 'number', 'min' => 0, 'max' => 100],
            [['update_date', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_formula' => 'Id формулы',
            'id_material' => 'Сырье',
            'percent' => 'Процент',
            'cost' => 'Цена за, кг',
            'update_date' => 'Дата изменения',
            'create_date' => 'Дата создания',
        ];
    }
}
