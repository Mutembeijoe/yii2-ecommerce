<?php
/**@var $model \common\models\Product */
?>

<div class="card h-100">
    <a href="<?php \yii\helpers\Url::to(['/site/view', ["id" => $model->id]]) ?>">
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
    <div class="card-footer d-flex justify-content-between p-2">
        <button class="btn btn-sm btn-primary ml-auto"> Add To Cart </button>
    </div>
</div>
