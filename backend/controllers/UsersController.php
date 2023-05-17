<?php

namespace backend\controllers;

use common\models\User;
use app\models\City;
use app\models\Resources;
use app\models\Projects;
use common\components\AccessRule;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class UsersController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    'matchCallback' => function($rule, $action){
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function($rule, $action){
                        return $this->redirect(['/main/search']);
                    }
                ]
            ]
        ];

        return $behaviors;
    }

    public function actionGetfreeusers()
    {
        $projectUsers = Projects::find()->select('user_id')->asArray()->all();
        $project_user_ids = [];
        foreach ($projectUsers as $users) {
            array_push($project_user_ids, $users['user_id']);
        }
        $users = User::find()->select(['username',  'id'])->where(['not in', 'id', $project_user_ids])->andWhere('status != 3')->all();
        return $users;
    }

    public function actionGetusersinformation()
    {
        return Projects::getUsersInformation();
    }

    public function actionDeleteuser()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $user = User::findOne(['id' => intval($id)]);
        if (Projects::getProjectForUser($user->id) === null) {
            return $user->delete();
        }
    }

    public function actionChangestatus()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $user = User::findOne(['id' => intval($id)]);
        if (Projects::getProjectForUser($user->id) === null) {
            if ($user->status == 10) {
                $user->status = 9;
            } else if ($user->status == 9) {
                $user->status = 10;
            }
            return $user->save();
        }
    }
}
