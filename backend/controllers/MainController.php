<?php 

namespace backend\controllers;


// use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use app\models\Organization;
use app\models\Project;
use Yii;
// use yii\filters\auth\QueryParamAuth;


class MainController extends Controller {

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // $behaviors['authenticator']['only'] = ['create','update','delete', 'read', 'search'];
        // $behaviors['authenticator']['authMethods'] = [
        //     HttpBearerAuth::class
        // ];

        return $behaviors;
    }

    public function actionSearch(){
        $projectModel = new Project();

        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $compare_type = isset($_GET['compare_type'])?$_GET['compare_type']:null;
        $candidate_id = isset($_GET['candidate_id'])?$_GET['candidate_id']:null;
        $result = [];
        $all_data = $projectModel->get_all_data($candidate_id, $start_date, $end_date, $type, $compare_type);
        $candidates_data = $projectModel->get_candidates_data();
        $result = array_merge(['all_data' => $all_data], ['candidates_data' => $candidates_data]);
        return $result;
    }

    // public function actionSearch(){
    //     $projectModel = new Project();

    //     $type = isset($_GET['type']) ? $_GET['type'] : null;
    //     $id = isset($_GET['id']) ? $_GET['id'] : null;
    //     $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
    //     $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
    //     $result = [];

    //     $users_organizations = $projectModel->get_organizations_for_user(Yii::$app->user->id);
    //     $organizations_ids = [];
    //     foreach($users_organizations as $key=>$value){
    //         array_push($organizations_ids, implode("", $value));
    //     }
    //     $organizations = $projectModel->get_organizations($organizations_ids);
    //     $posts = [];

    //     return $this->get_data($projectModel, $organizations_ids, $type, $start_date, $end_date);

        

    //     // return $posts;

    //     // foreach($organizations_ids as $id){
    //     //     $organization = Yii::$app->db->createCommand("SELECT * from organization where ")
    //     // }


    //     // if(isset($type)){
    //     //     switch($type) {
    //     //         case '1': return 
    //     //     }
    //     // }

    //     // $result = Yii::$app->db->createCommand("SELECT organization_id from users_organization where user_id = " . Yii::$app->user->id)->queryAll();
    //     // return $result;
    // }

    // private function get_data($projectModel, $organizations_ids, $type, $start_date, $end_date){
    //     $result = [];
    //     foreach($organizations_ids as $id){
    //         $total_posts_data = $projectModel->get_total_posts_data($id, $start_date, $end_date, $type);
    //         // return $total_posts_data;
    //         $date_posts_data = $projectModel->get_date_posts_data($id, $start_date, $end_date, $type);
    //         $total_subscribers = $projectModel->get_total_subscribers_data($id, $start_date, $end_date, $type);
    //         $date_subscribers = $projectModel->get_date_subscribers_data($id, $start_date, $end_date, $type);
    //         $dates = $projectModel->get_dates($start_date, $end_date);
    //         // return $dates;
    //         $organization_data = $projectModel->get_organization_data($id);
    //         // return $type_posts;

    //         $total_posts_data = ['total_posts_data' => $total_posts_data];
    //         $date_posts_data = ['date_posts_data' => $date_posts_data];
    //         $total_subscribers = ['total_subscribers' => $total_subscribers];
    //         $date_subscribers = ['date_subscribers' => $date_subscribers];
    //         $organization_data = ['organization_data' => $organization_data];
    //         $dates = ['dates' => $dates];

    //         $result[$id] = array_merge($total_posts_data, $date_posts_data, $total_subscribers, $date_subscribers, $organization_data, $dates);
    //     }
        // if($request_type == 'index'){
        //     foreach($organizations_ids as $id){
        //         $total_posts_data = $projectModel->get_total_posts_data($id, $start_date, $end_date, $type);
        //         // return $total_posts_data;
        //         $date_posts_data = $projectModel->get_date_posts_data($id, $start_date, $end_date, $type);
        //         $total_subscribers = $projectModel->get_total_subscribers_data($id, $start_date, $end_date, $type);
        //         $date_subscribers = $projectModel->get_date_subscribers_data($id, $start_date, $end_date, $type);
        //         $organization_data = $projectModel->get_organization_data($id);
        //         // return $type_posts;

        //         $total_posts_data = ['total_posts_data' => $total_posts_data];
        //         $date_posts_data = ['date_posts_data' => $date_posts_data];
        //         $total_subscribers = ['total_subscribers' => $total_subscribers];
        //         $date_subscribers = ['date_subscribers' => $date_subscribers];
        //         $organization_data = ['organization_data' => $organization_data];

        //         $result[$id] = array_merge($total_posts_data, $date_posts_data, $total_subscribers, $date_subscribers, $organization_data);
        //     }
        // }
        // else if($request_type == 'facebook'){
        //     foreach($organizations_ids as $id){
        //         $total_posts_data = $projectModel->get_total_posts_data($id, $start_date, $end_date, $type);
        //         // return $total_posts_data;
        //         $date_posts_data = $projectModel->get_date_posts_data($id, $start_date, $end_date, $type);
        //         $total_subscribers = $projectModel->get_total_subscribers_data($id, $start_date, $end_date, $type);
        //         // return $total_subscribers;
        //         $date_subscribers = $projectModel->get_date_subscribers_data($id, $start_date, $end_date, $type);
        //         $organization_data = $projectModel->get_organization_data($id);
                
        //         $total_posts_data = ['total_posts_data' => $total_posts_data];
        //         $date_posts_data = ['date_posts_data' => $date_posts_data];
        //         $total_subscribers = ['total_subscribers' => $total_subscribers];
        //         $date_subscribers = ['date_subscribers' => $date_subscribers];
        //         $organization_data = ['organization_data' => $organization_data];

        //         $result[$id] = array_merge($total_posts_data, $date_posts_data, $total_subscribers, $date_subscribers, $organization_data);
        //     }
        // }
        // return $result;
    // }
}