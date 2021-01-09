<?php


namespace frontend\controllers;

use common\models\Product;
use frontend\base\BaseController;
use frontend\services\CartService;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends BaseController
{
    public function behaviors(): array
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
        $cartService = new CartService();
        $cartItems = $cartService->getCartItems();
        return $this->render("index", ['cartItems' => $cartItems]);
    }


    public function actionAdd($productId): array
    {

        $product = Product::findOne(["id" => $productId]);
        $userId = Yii::$app->user->id;

        if (!$product) {
            throw new NotFoundHttpException('product not found');
        }

        $cartService = new CartService();
        $ok = $cartService->addItemToCart($product);
        $itemsCount = $cartService->getItemsInCartCount($userId);

        if (!$ok) {
            return [
                'message' => 'Failed to add Item to cart',
                'code' => 500,
            ];
        }
        return [
            'message' => 'success',
            'itemsCount' => $itemsCount,
            'code' => 200,
        ];
    }

    public function actionDelete($productId): Response
    {
        $cartService = new CartService();
        $cartService->removeItemFromCart($productId);
        return $this->redirect(["index"]);
    }
}