<?php
/**@var $userAddress \common\models\UserAddress */

/**@var $success bool */

use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
    'id' => 'address_form',
    'enablePushState' => false
]) ?>

<?php if (isset($success) && $success) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your address was successfully update.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php $userAddressForm = ActiveForm::begin([
    'id' => 'address_form',
    'action' => 'update-address',
    'options' => ['data' => ['pjax' => true]]
]) ?>
<?= $userAddressForm->field($userAddress, 'address')->textInput() ?>
<?= $userAddressForm->field($userAddress, 'city')->textInput() ?>
<?= $userAddressForm->field($userAddress, 'postal_code')->textInput() ?>
<?= $userAddressForm->field($userAddress, 'state')->textInput() ?>
<?= $userAddressForm->field($userAddress, 'country')->textInput() ?>
<button class="btn btn-primary">
    Update
</button>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
