<?php

namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\CartItem]].
 *
 * @see \common\models\CartItem
 */
class CartItemQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\CartItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CartItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function createdByUser($userId): CartItemQuery
    {
        return $this->andWhere(['created_by' => $userId]);
    }

    public function joinWithProductTable(): CartItemQuery
    {
        return $this->with('product');
    }

    public function withProductId($id): CartItemQuery
    {
        return $this->andWhere(["product_id" => $id]);
    }
}
