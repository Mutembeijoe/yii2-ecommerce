<?php
/**@var $cartItems [] */

use common\models\Product;

?>


<table class="table table-striped">
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
                <img src="<?= Product::formatImageUrl($cartItem["image"]) ?>" alt="<?= $cartItem["name"] ?>" width="50px">
            </td>
            <td><?= $cartItem["price"] ?></td>
            <td><?= $cartItem["quantity"] ?></td>
            <td><?= $cartItem['quantity'] * $cartItem['price'] ?></td>
            <td>Action</td>
        </tr>
    <?php } ?>
</table>

