<?php


namespace frontend\controllers;

use common\models\User;
use frontend\base\BaseController;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class ProfileController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update-profile', 'update-address'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        /**@var User $user */
        $user = \Yii::$app->user->identity;
        $userAddress = $user->address;
        return $this->render('index', ['user' => $user, 'userAddress' => $userAddress]);
    }


    public function actionUpdateAddress()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException('Request Not Allowed');
        }
        /** @var $user User */
        $user = \Yii::$app->user->identity;
        $userAddress = $user->address;
        $success = false;
        if ($userAddress->load(\Yii::$app->request->post()) && $userAddress->save()) {
            $success = true;
        }
        return $this->renderAjax('_address_form', ['userAddress' => $userAddress, 'success' => $success]);
    }

    public function actionUpdateProfile()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new ForbiddenHttpException('Request Not Allowed');
        }

        /** @var $user User */
        $user = \Yii::$app->user->identity;
        $success = false;
        if ($user->load(\Yii::$app->request->post()) && $user->save()) {
            $success = true;
        }
        return $this->renderAjax('_profile_form', ['user' => $user, 'success' => $success]);
    }

}