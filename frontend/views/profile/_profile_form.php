<?php
/**@var $user \common\models\User */
/**@var $this \yii\web\View */

/**@var $success bool */

use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
    'enablePushState' => false,
    'id' => 'profile_form'
]) ?>

<?php if (isset($success) && $success) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your address was successfully update.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php $form = ActiveForm::begin([
    'id' => 'profile_form',
    'action' => 'update-profile',
    'options' => ['data' => ['pjax' => true]]
]); ?>
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
<?php Pjax::end() ?>
