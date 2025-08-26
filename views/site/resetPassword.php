<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password col-8 ml-5">
    <h4 class="text-center"><?= Html::encode($this->title) ?></h4>
    <p class="text-center">Please choose your new password:</p>

    <div class="col">
        <div class="text-center">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'class'=>'form-control form-control-lg']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>