<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property integer $position
 * @property string $phone
 * @property string $email
 * @property string $skype
 * @property string $birth_day
 * @property integer $head
 * @property integer $active
 * @property string $update_date
 * @property string $create_date
 */
class Employees extends \app\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surname', 'position'], 'required'],
            [['position', 'head', 'active'], 'integer'],
            [['birth_day', 'update_date', 'create_date'], 'safe'],
            [['name', 'surname', 'middle_name', 'phone', 'email', 'skype'], 'string', 'max' => 50],
            ['active', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'middle_name' => Yii::t('app', 'Отчество'),
            'position' => Yii::t('app', 'Должность'),
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Email'),
            'skype' => Yii::t('app', 'Skype'),
            'birth_day' => Yii::t('app', 'Дата рождения'),
            'head' => Yii::t('app', 'Руководитель'),
            'active' => Yii::t('app', 'Активен'),
            'update_date' => Yii::t('app', 'Дата изменения'),
            'create_date' => Yii::t('app', 'Дата создания записи'),
        ];
    }

    public function getFIO(){
        return  $this->surname .
                (!empty($this->name) ? (' ' . strtoupper(substr($this->name, 0, 1)) . '.') : '') .
                (!empty($this->middle_name) ? ' ' . strtoupper(substr($this->middle_name, 0, 1)) . '.' : ''
                );
    }

    public function getActive()
    {
        return $this->active ? 'Да' : 'Нет';
    }

    public function getPositions()
    {
        return $this->hasOne(Position::className(), ['id' => 'position']);
    }

    public static function getListEmployees(){
        $sql = "SELECT *,
                       CONCAT(
                          surname, 
                          IF( name IS NULL OR name = '',
                            '', 
                            CONCAT( 
                                ' ',
                                substr(name, 1, 1),
                                '.',
                                IF(middle_name IS NULL OR middle_name = '', '', CONCAT(substr(middle_name, 1, 1), '.'))
                            )
                          )
                       ) FIO
                FROM employees
                WHERE active = 1
                ORDER BY surname
        ";

        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::map($data, 'id', 'FIO');
    }
}
