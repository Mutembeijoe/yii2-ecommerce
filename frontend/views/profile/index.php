<?php
/**@var $user \common\models\User */
/**@var $this \yii\web\View */

/**@var $userAddress \common\models\UserAddress */

use yii\bootstrap4\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Address
            </div>

            <div class="card-body">
                <?= $this->render('_address_form', [
                    'userAddress' => $userAddress,
                ]) ?>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                Profile Information
            </div>
            <div class="card-body">
                <?= $this->render('_profile_form', [
                    'user' => $user,
                ]) ?>

            </div>
        </div>
    </div>
</div>


