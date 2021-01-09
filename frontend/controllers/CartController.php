<?php


namespace frontend\controllers;


use common\models\CartItem;
use common\models\Product;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends \yii\web\Controller
{


    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::class,
                'only' => ['add'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }


    public function actionIndex(): string
    {
        $cartItems = null;
        $user = \Yii::$app->user;
        if ($user->isGuest) {
//            Fetch cartItems from session
        } else {
            $cartItems = CartItem::find()->select("")->joinWithProductTable()->createdByUser($user->id)->all();
        }

        return $this->render("index", ['cartItems' => $cartItems]);
    }


    public function actionAdd($productId): array
    {

        $product = Product::findOne(["id" => $productId]);
        $userId = Yii::$app->user->id;

        if(!$product){
            throw new NotFoundHttpException('product not found');
        }

        $itemsCount = 0 ;

        if (Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            $cart = $session->get('cart');
            if(!$cart){
                $cartItem["quantity"] = 1;
                $session->set("cart", [$productId => $cartItem]);
            }else{
                if(isset($cart[$productId])){
                    $cart[$productId]["quantity"]+=1;
                }else{
                    $cart[$productId]["quantity"] = 1;
                }
                $session->set("cart", $cart);
            }

            $cart = Yii::$app->session->get("cart");

            foreach ($cart as $item){
                $itemsCount += $item['quantity'];
            }

        } else {
            $cartItem = CartItem::find()->createdByUser($userId)->withProductId($productId)->one();
            if (!$cartItem) {
                $cartItem = new CartItem();
                $cartItem->created_by = $userId;
                $cartItem->product_id = $productId;
                $cartItem->quantity = 1;
            } else {
                $cartItem->quantity++;
            }
            $cartItem->save();

            $itemsCount = CartItem::find()->createdByUser($userId)->sum("quantity");

            if($cartItem->save()){
                return [
                    'message' => 'success',
                    'itemsCount' => $itemsCount,
                    'code' => 200,
                ];
            }

            return [
                'message' => 'failure',
                'errors' => $cartItem->errors,
                'code' => 500,
            ];

        }

        return [
            'data' => 'success',
            'itemsCount' => $itemsCount,
            'code' => 200,
        ];
    }
}