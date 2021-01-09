<?php


namespace frontend\base;


use frontend\services\CartService;

class BaseController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        $userId = \Yii::$app->user->id;
        $cartService = new CartService();
        $cartItemsCount = $cartService->getItemsInCartCount($userId);
        $this->view->params["cartItemsCount"] = $cartItemsCount;
        return parent::beforeAction($action);
    }


}