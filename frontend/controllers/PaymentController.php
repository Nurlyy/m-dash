<?php 

namespace backend\controllers;

use common\components\AccessRule;
use yii\filters\AccessControl;
use yii\web\Controller;



class PaymentController extends Controller{
    public function behaviors(){
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ]
            ]
        ];

        return $behaviors;
    }

    public function actionIndex(){
        
    }
}