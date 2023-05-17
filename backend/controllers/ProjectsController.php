<?php 

namespace backend\controllers;

use yii\rest\Controller;
use Yii;
use app\models\City;
use app\models\Projects;

class ProjectsController extends Controller {
    public function behaviors(){
        $behaviors = parent::behaviors();

        

        return $behaviors;
    }
}