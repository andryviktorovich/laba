<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "providers".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $description
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'providers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country'], 'required'],
            [['name', 'phone', 'email', 'country', 'city', 'address', 'description'], 'string'],
            [['name', 'address'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 50],
            [['country', 'city'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID поставщика',
            'name' => 'Имя поставщика',
            'phone' => 'Телефон',
            'email' => 'Email',
            'country' => 'Страна',
            'city' => 'Город',
            'address' => 'Адрес',
            'description' => 'Описание',
        ];
    }

    public static function getListProviders(){
        $providers = Provider::find()->all();

        return ArrayHelper::map($providers, 'id', 'name');
    }
}
