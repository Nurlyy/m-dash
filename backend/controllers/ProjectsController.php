<?php 

namespace backend\controllers;

use yii\rest\Controller;
use Yii;
use app\models\City;
use app\models\Projects;
use common\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use common\models\User;
use app\models\Resources;

class ProjectsController extends Controller {

    public function behaviors(){
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
                        return $this->redirect(["/main/search"]);
                    }
                ]
            ]
        ];

        return $behaviors;
    }

    

    public function actionDeleteproject()
    {
        if (Yii::$app->request->post()) {
            $projid = Yii::$app->request->post('projid');
            return Projects::findOne(['id' => $projid])->delete();
        }
    }

    public function actionGetproject()
    {
        $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
        $project = [];
        $project['project'] = Projects::find()->where(['id' => $project_id])->asArray()->one();
        $project['project']['username'] = User::find()->select('username')->where(['id' => $project['project']['user_id']])->one()['username'];
        $cities = City::find()->where(['project_id' => $project_id])->asArray()->all();
        $cities_new = [];
        foreach ($cities as $key => $city) {
            $resources = Resources::find()->where(['city_id' => $city['id'], 'status' => 1])->asArray()->all();
            $city['resources'] = [];
            foreach ($resources as $resource) {
                $city['resources'][$resource['id']] = $resource;
            }
            $cities_new[$city['id']] = $city;
        }
        $project['project']['cities'] = $cities_new;
        return $project;
    }


    public function actionCreateproject()
    {
        if (isset($_POST['id'])) {
            $project = Projects::findOne(['id' => $_POST['id']]);
        } else {
            $project = new Projects();
            $project->is_active = 0;
            $project->created_date = $_POST['created_date'];
        }
        $project->name = $_POST['name'];
        $project->user_id = $_POST['user_id'];
        return $project->save();
    }

    public function actionGetprojects()
    {
        $projects = Projects::find()->asArray()->all();
        foreach ($projects as $key => $project) {
            $user = User::findOne(['id' => intval($project['user_id'])]);
            $cities = City::find()->where('project_id=' . $project['id'])->asArray()->all();
            $project['username'] = $user->username;
            $project['email'] = $user->email;
            $project['cities'] = sizeof($cities);
            $project['resources'] = 0;
            if (sizeof($cities) > 0) {
                foreach ($cities as $city) {
                    $project['resources'] += Resources::find()->where(['city_id' => $city['id'], 'status' => 1])->count();
                }
            } else {
                $project['resources'] = 0;
            }
            $projects[$key] = $project;
            $project = null;
            $cities = 0;
            $user = null;
        }
        return $projects;
    }

    public function actionTurnstateproject()
    {
        if (Yii::$app->request->isPost && isset($_POST['project_id']) && isset($_POST['state'])) {
            $project = Projects::findOne(['id' => $_POST['project_id']]);
            $project->is_active = intval($_POST['state']);
            return $project->save();
        }
    }
}