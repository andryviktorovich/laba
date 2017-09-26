<?php

namespace app\base;

use Yii;
use yii\helpers\ArrayHelper;

class BaseModel extends \yii\db\ActiveRecord
{

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $attr = $this->activeAttributes();
            if(array_search('update_date', $attr)) {
                $this->update_date = date('Y-m-d H:i:s');
                if ($this->isNewRecord && array_search('create_date', $attr)) {
                    $this->create_date = date('Y-m-d H:i:s');
                }
            }
            return true;
        }
        return false;
    }

}
