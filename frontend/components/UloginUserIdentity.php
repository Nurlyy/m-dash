<?php

use yii\web\IdentityInterface;
use common\models\User;

class UloginUserIdentity implements IdentityInterface
{

    private $id;
    private $name;
    private $isAuthenticated = false;
    private $states = array();

    public function __construct()
    {
    }

    public function getIsAdmin(){
        return Yii::$app->user->status == 3;
    }

    public static function findIdentity($id)
    {
        return User::findOne(['id' => $id, 'status' => ['or', User::STATUS_ACTIVE, User::STATUS_SUPERUSER]]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['access_token'=>$token,'status'=>['or', User::STATUS_ACTIVE, User::STATUS_SUPERUSER]]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return Yii::$app->user->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function authenticate($uloginModel = null)
    {
        $user = User::find()->where([
            'identity' => $uloginModel->identity,
            'network' => $uloginModel->network,
        ])->one();

        if ($user !== null) {
            $this->id = $user->id;
            $this->name = $user->full_name;
        } else {
            $user = new User();
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->email = $uloginModel->email;
            $user->full_name = $uloginModel->full_name;
            $user->save();

            $this->id = $user->id;
            $this->name = $user->full_name;
        }

        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPersistentStates()
    {
        return $this->states;
    }
}
