<?php


namespace frontend\services;


use common\models\CartItem;
use common\models\Product;
use Yii;

class CartService
{

    public function getItemsInCartCount($userId)
    {
        $count = 0;
        if (Yii::$app->user->isGuest) {
            $cart = Yii::$app->session->get("cart", []);
            foreach ($cart as $item) {
                $count += $item['quantity'];
            }
        } else {
            $count = CartItem::find()->createdByUser($userId)->sum("quantity");
        }

        return $count;
    }


    public function addItemToCart($product)
    {
        /**@var $product Product */
        if (Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            $cart = $session->get("cart");
            if ($cart && isset($cart[$product->id])) {
                $cart[$product->id]["quantity"] += 1;
                $session->set("cart", $cart);
            } else {
                $cartItem["quantity"] = 1;
                $cartItem["name"] = $product->name;
                $cartItem["price"] = $product->price;
                $cartItem["image"] = $product->image;
                $cart[$product->id] = $cartItem;
                $session->set("cart", $cart);
            }
            return true;
        }

        $userId = Yii::$app->user->id;
        $cartItem = CartItem::find()->createdByUser($userId)->withProductId($product->id)->one();
        if (!$cartItem) {
            $cartItem = new CartItem();
            $cartItem->created_by = $userId;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
        } else {
            $cartItem->quantity++;
        }

        return $cartItem->save();
    }

    public function getCartItems(): array
    {
        $user = Yii::$app->user;
        $cartItems = [];
        if ($user->isGuest) {
            $cart = Yii::$app->session->get("cart", []);
            foreach ($cart as $key => $value) {
                $value["product_id"] = $key;
                $cartItems[] = $value;
            }
        } else {
//            TODO: FIND A FIX FOR BINDING SYNTAX
            $cartItems = CartItem::findBySql("
            SELECT c.product_id, p.name, p.image, p.price, c.quantity, c.quantity*p.price as total_price
            FROM cart_item c
            LEFT JOIN product p
            ON c.product_id = p.id
            WHERE c.created_by = $user->id
            "
            )->asArray()->all();
        }

        return $cartItems;
    }


}
