<?php


namespace frontend\controllers;


use common\models\User;
use common\models\UserAddress;

class ProfileController extends \yii\web\Controller
{


    public function actionIndex()
    {
        /**@var User $user */

        $user = \Yii::$app->user->identity;
        $userAddresses = $user->addresses;
        $userAddress = $userAddresses? $userAddresses[0] : new UserAddress();
        return $this->render('index', ['user' => $user, 'userAddress' => $userAddress]);
    }

}