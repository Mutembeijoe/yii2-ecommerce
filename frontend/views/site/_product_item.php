<?php
/**@var $model \common\models\Product */

use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="card h-100">
    <a href="<?php Url::to(['/site/view', ["id" => $model->id]]) ?>">
        <img class="card-img-top"
             src="<?php echo $model->getImageUrl() ?>"
             alt=""></a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="#"><?php $model->name ?></a>
        </h4>
        <h5>$24.99</h5>
        <p class="card-text"><?php echo $model->getSummaryDesc() ?></p>
    </div>

    <div class="card-footer d-flex justify-content-end p-2">
        <!--        --><?php //Pjax::begin([
        //            'enablePushState' => false,
        //            'linkSelector' => '#addToCart'
        //        ]) ?>
<!--        --><?php //echo Html::a(
//            "Add to Cart",
//            ["/cart/add/", "productId" => $model->id],
//            [
//                "data-method" => 'post',
//                'data-pjax' => 1,
//                'class' => 'btn btn-primary btn-sm'
//            ]
//        ) ?>
<!---->
        <a id="<?php echo $model->id?>" href="<?php echo Url::to(["/cart/add", "productId" => $model->id])?>" class="btn btn-primary btn-sm btn-cart">
            Add to Cart
        </a>

        <!--        --><?php //Pjax::end() ?>
    </div>

</div>
