<?php

namespace backend\controllers;


// use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use app\models\Organization;
use app\models\Project;
use Yii;
use common\models\User;
use common\components\AccessRule;
use yii\filters\AccessControl;

// use yii\filters\auth\QueryParamAuth;


class MainController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // $behaviors['authenticator']['only'] = ['create', 'update', 'delete', 'read', 'search', 'temp'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => [
                'class' => AccessRule::class,
            ],
            // 'only' => ['search'],
            'rules' => [
                [
                    'actions' => ['search'],
                    'allow' => true,
                    'roles' => ['@', User::STATUS_ACTIVE, User::STATUS_SUPERUSER],

                    // 'matchCallback' => function ($rule, $action) {
                    //     return !Yii::$app->user->identity->isAdmin();
                    // },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },

                ],
                [
                    'actions' => ['createproject', 'addcandidate', 'removeproject', 'removecandidate', 'getprojects'],
                    'allow' => true,
                    'roles' => ['@', User::STATUS_SUPERUSER],
                    'matchCallback' => function ($rule, $action) {
                        return Yii::$app->user->identity->isAdmin();
                    },
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(["/main/search"]);
                    },
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionSearch()
    {
        $projectModel = new Project();
        $project_candidates = $projectModel->getProjectCandidates(Yii::$app->user->id);
        $project_id = $projectModel->getProjectId(Yii::$app->user->id)[0]["id"];
        $temp = [];
        foreach ($project_candidates as $i) {
            array_push($temp, $i['id']);
        }
        $project_candidates = $temp;
        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $candidate_id = isset($_GET['candidate_id']) ? (in_array($_GET['candidate_id'], $project_candidates) ? $_GET['candidate_id'] : -1) : null;
        $first = isset($_GET['first']) ? (in_array($_GET['first'], $project_candidates) ? $_GET['first'] : -1) : null;
        $second = isset($_GET['second']) ? (in_array($_GET['second'], $project_candidates) ? $_GET['second'] : -1) : null;
        $discussionChart = isset($_GET['discussionChart']) ? $_GET['discussionChart'] : false;
        $sentimentChart = isset($_GET['sentimentChart']) ? $_GET['sentimentChart'] : false;
        $subsChart = isset($_GET['subsChart']) ? $_GET['subsChart'] : false;
        $likesChart = isset($_GET['likesChart']) ? $_GET['likesChart'] : false;
        $commentsChart = isset($_GET['commentsChart']) ? $_GET['commentsChart'] : false;
        $repostsChart = isset($_GET['repostsChart']) ? $_GET['repostsChart'] : false;
        $result = [];

        switch ($type) {
            case 1:
                $all_data = $projectModel->get_all_data($candidate_id, $start_date, $end_date, $type);
                $candidates_data = $projectModel->get_candidates_data($project_id, [$candidate_id]);
                $result = array_merge(['all_data' => $all_data], ['candidate_data' => $candidates_data]);
                break;
            case 2:
                $all_data = $projectModel->get_all_data($candidate_id, $start_date, $end_date, $type);
                $candidates_data = $projectModel->get_candidates_data($project_id, [$candidate_id]);
                $candidate_posts = $projectModel->get_candidate_posts($candidate_id, $start_date, $end_date);
                $result = array_merge(['all_data' => $all_data], ['candidate_data' => $candidates_data], ['candidate_posts' => $candidate_posts]);
                break;
            case 3:
                $all_data = $projectModel->get_all_data($candidate_id, $start_date, $end_date, $type, $first, $second, $discussionChart, $sentimentChart, $subsChart, $likesChart, $commentsChart, $repostsChart);
                $candidates_data = $projectModel->get_candidates_data($project_id, [$first, $second]);
                $result = array_merge(['all_data' => $all_data], ['candidate_data' => $candidates_data]);
                break;
            case 'index':
                $candidates_data = $projectModel->get_candidates_data($project_id);
                $result = ['candidate_data' => $candidates_data];
                break;
        }
        return $result;
    }


    // public function actionGetprojects(){
    //     $result = [];
    //     $projectModel = new Project();
    //     $result['projects'] = $projectModel->getProjects();
    //     return $result;
    // }


    // public function actionCreateproject()
    // {
    //     $projectModel = new Project();
    //     $project_name = isset($_POST['project_name']) ? $_POST['project_name'] : null;
    //     $created_date = isset($_POST['created_date']) ? $_POST['created_date'] : null;
    //     $owner = isset($_POST['owner']) ? $_POST['owner'] : null;
    // }


    // public function actionAddcandidate()
    // {
    //     $projectModel = new Project();
    //     $candidate_name = isset($_POST['candidate_name']) ? $_POST['candidate_name'] : null;
    //     $partia = isset($_POST['partia']) ? $_POST['partia'] : null;
    //     $fb_account = isset($_POST['fb_account']) ? $_POST['fb_account'] : null;
    //     $ig_account = isset($_POST['ig_account']) ? $_POST['ig_account'] : null;
    //     $web_site = isset($_POST['web_site']) ? $_POST['web_site'] : null;
    //     $photo = isset($_POST['photo']) ? $_POST['photo'] : null;
    //     $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
    //     $experience = isset($_POST['experience']) ? $_POST['experience'] : null;
    //     $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
    // }

    // public function actionRemoveProject(){
    //     $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
    //     $projectModel = new Project();
    //     $projectModel->removeProject($project_id);
    // }


    // public function actionTemp()
    // {
    //     $projectModel = new Project();

    //     $project_id = $projectModel->getUserProject(Yii::$app->user->id);

    //     $temp = [];
    //     foreach ($project_id as $i) {
    //         array_push($temp, $i['id']);
    //     }
    //     $project_id = $temp;

    //     return $project_id;
    // }
}
