<?php

namespace app\models\formula;

use Yii;
use yii\data\SqlDataProvider;
/**
 * This is the model class for table "formula".
 *
 * @property integer $id_formula
 * @property string $id_mark
 * @property string $title
 * @property string $active
 * @property string $update_date
 * @property string $create_date
 */
class Formula extends \app\base\BaseModel
{
    CONST STATUS_UNKNOWN = -1;
    CONST STATUS_NOT_USED = 0;
    CONST STATUS_ONE_USE = 1;
    CONST STATUS_MORE_ONE_USED = 2;

    CONST ACTIVE = 1;
    CONST NO_ACTIVE = 0;

    public $status;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formula';
    }

    public function __construct()
    {
        parent::__construct();
        $this->status = self::STATUS_UNKNOWN;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mark', 'title'], 'required'],
            [['update_date', 'create_date'], 'safe'],
            [['id_mark'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
            ['active', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_formula' => 'id формулы',
            'id_mark' => 'Марка',
            'title' => 'Подпись формулы',
            'update_date' => 'Дата обновления',
            'create_date' => 'Дата создания',
        ];
    }

    public function delete()
    {
        $this->active = self::NO_ACTIVE;
        return $this->save();
    }

    public function getElements()
    {
        return $this->hasMany(FormulaElements::className(), ['id_formula' => 'id_formula']);
    }

    public function validateElements($models, $attributeNames = null)
    {
        $valid = true;
        $totalPercent = 0;
        /* @var $model Model */
        foreach ($models as $model) {
            $valid = $model->validate($attributeNames) && $valid;
            $totalPercent += (float) $model->percent;
        }
        if($totalPercent > 100 || $totalPercent < 0){
            $this->addError('elements', 'Сумма процентного отношения сырья в формуле не должна быть больше 100%.');
            $valid = false;
        }

        return $valid;
    }

    public function searchElements(){
        $sql = "SELECT fe.*, m.title AS material, ROUND(IFNULL(fe.percent,0)/100*IFNULL(fe.cost,0), 3) AS costM
                FROM formula f, formula_elements fe, materials m
                WHERE f.active = 1 AND f.id_formula = fe.id_formula AND m.id = fe.id_material AND f.id_formula = " . (is_null($this->id_formula) ? 'NULL' : $this->id_formula);

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'pagination' => false,
        ]);
        return $dataProvider;
    }

    public function getStatus(){
        if(empty($this->id_formula)){
            $this->status = self::STATUS_UNKNOWN;
        }
        $sql = "SELECT COUNT(b.batch) AS count
                FROM formula f, batches b
                WHERE b.active = 1 AND f.id_formula = b.id_formula AND f.id_formula = $this->id_formula";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        if($count > 1 ) $this->status = self::STATUS_MORE_ONE_USED;
        elseif($count == 1) $this->status = self::STATUS_ONE_USE;
        else $this->status = self::STATUS_NOT_USED;

        return $this->status;
    }

    public static function findOne($condition)
    {
        if(is_null($condition)) {
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
