<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'id',
            'contentOptions' => [
                'style' => 'width:60px',
            ]
        ],
        [
            'attribute' => 'image',
            'content' => function ($model) {
                /* @var $model \common\models\Product */
                return
                    Html::img($model->getImageUrl(),
                        ['class' => 'img-fluid',
                            'style' => 'width:50px',]);
            }
        ],
        'name',
        'price:currency',
        [
            'attribute' => 'status',
            'content' => function ($model) {
                /* @var $model \common\models\Product */
                $badgeContent = $model->status ? 'Published' : 'Draft';
                return Html::tag('span', $badgeContent, ['class' => "badge " . ($model->status ? 'badge-success' : 'badge-danger')]);
                },

                'contentOptions' => [
                        "style" => 'width:100px'
                ]
            ],
            'created_at:date',
            'updated_at:date',
            ['class' => 'common\widgets\ActionColumn'],
        ],
    ]); ?>


</div>


