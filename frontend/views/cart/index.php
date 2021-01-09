<?php
/**@var $cartItems [] */

use common\models\Product;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>


<div class="card">
    <div class="card-header">
        <h5>Your Cart Items</h5>
    </div>

    <div class="card-body px-0">
        <?php if (!empty($cartItems)): ?>
            <table class="table table-hover">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($cartItems as $cartItem) { ?>
                    <tr>
                        <td><?= $cartItem["name"] ?></td>
                        <td>
                            <img src="<?= Product::formatImageUrl($cartItem["image"]) ?>" alt="<?= $cartItem["name"] ?>"
                                 width="50px">
                        </td>
                        <td><?= Yii::$app->formatter->asCurrency($cartItem["price"]) ?></td>
                        <td><?= $cartItem["quantity"] ?></td>
                        <td><?= Yii::$app->formatter->asCurrency($cartItem['quantity'] * $cartItem['price']) ?></td>
                        <td>
                            <?= Html::a(
                                'Delete',
                                [
                                    "/cart/delete/",
                                    'productId' => $cartItem["product_id"],
                                ],
                                [
                                    'class' => 'btn btn-sm btn-danger',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Are you sure you want to remove item?',
                                ]
                            ) ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php else: ?>
            <p class="lead text-center">You have no Items in cart</p>
        <?php endif; ?>
    </div>
    <div class="card-footer text-right">
        <?= Html::a(
            'CheckOut',
            ["/checkout/index/"],
            [
                'class' => 'btn btn-primary',
            ]
        ) ?>
    </div>
</div>


