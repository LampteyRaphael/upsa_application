<?php

use dmstr\adminlte\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\helpers\Html;

?>
<div class="login-form-container">
    <div class="form-content animate-fade" style="animation-delay: 0.1s">
        <div class="form-header">
        <?= Html::img('@web/images/download.png', [
                'alt' => 'IPS Logo',
                'class' => 'form-logo animate-pulse'
            ]) ?>
                    <h2 class="form-title"><?= Html::encode($this->title) ?></h2>
                    <p class="form-subtitle">Please fill out your email. A link to reset password will be sent there.</p>
                </div>
        
        <?= Alert::widget() ?>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true,'class'=>'form-control form-control-lg']) ?>

 
        <!-- Submit Button -->
        <button type="submit" class="submit-btn animate-input" style="animation-delay: 0.5s">
            Send
        </button>

        <?php ActiveForm::end(); ?>

        <!-- New Applicant Sign Up Option -->
        <div class="new-applicant animate-input" style="animation-delay: 0.6s; text-align: center; margin-top: 20px;">
            <p>Return to Applicant Portal
            <?= Html::a('Login', ['site/login'], [
                'class' => 'signup-link'
            ]) ?>
            </p>
        </div>  
    </div>
</div>