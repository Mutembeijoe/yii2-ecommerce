<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price:currency',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    /**@var $model \common\models\Product */
                    return Html::img($model->getImageUrl(), ['style' => "width:50px"]);
                }
            ],
            'description:html',
            [
                'attribute' => 'status',
                'format'=> 'html',
                'value' => function ($model) {
                    /* @var $model \common\models\Product */
                    $badgeContent = $model->status ? 'Published' : 'Draft';
                    return Html::tag('span', $badgeContent, ['class' => "badge p-1 " . ($model->status ? 'badge-success' : 'badge-danger')]);
                },

            ],
            'created_at:date',
            'updated_at:date',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>
