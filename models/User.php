<?php

namespace app\models;
use  mdm\admin\models\User as UserModel;
use yii\helpers\ArrayHelper;

class User extends UserModel
{
    public function getRoles(){
        return $this->hasMany(AuthAssignment::className(),['user_id' => 'id']);
    }

    public static function getDropDownList(){
        $array =  AuthItem::find()->where(['type' => 1])->all();
        return ArrayHelper::map($array ,'name' , 'name');
    }
}
