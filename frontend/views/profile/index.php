<?php
/**@var $user \common\models\User */

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
                <?php $userAddressForm = ActiveForm::begin(['action' => 'profile/address-update']) ?>

                <?= $userAddressForm->field($userAddress, 'address')->textInput() ?>
                <?= $userAddressForm->field($userAddress, 'city')->textInput() ?>
                <?= $userAddressForm->field($userAddress, 'postal_code')->textInput() ?>
                <?= $userAddressForm->field($userAddress, 'state')->textInput() ?>
                <?= $userAddressForm->field($userAddress, 'country')->textInput() ?>
                <button class="btn btn-primary">
                    Update
                </button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                Profile Information
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['action' => 'profile/profile-update']); ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $form->field($user, 'firstname')->textInput()->label('First Name') ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $form->field($user, 'lastname')->textInput()->label('Last name') ?>
                    </div>
                </div>

                <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($user, 'email') ?>

                <?= $form->field($user, 'oldPassword')->passwordInput() ?>
                <?= $form->field($user, 'newPassword')->passwordInput() ?>

                <button class="btn btn-primary">
                    Update
                </button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


