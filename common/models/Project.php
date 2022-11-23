<?php

namespace common\models;

use yii\base\Model;

class Project extends Model{
    public $name;
    public $created_date;
    public $owner_id;
    public $is_active;

    public function rules(){
        return [
            ['name, owner_id, created_date', 'required']
        ];
    }

    public function createProject(){

    }
}