<?php

namespace app\models;
use  mdm\admin\models\User as UserModel;

class User extends UserModel
{
    public function getRoles(){
        return $this->hasMany(AuthAssignment::className(),['user_id' => 'id']);
    }
}
