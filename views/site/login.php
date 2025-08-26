<?php

use dmstr\adminlte\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\helpers\Html;

?>
<div class="login-form-container">
    <div class="form-content animate-fade" style="animation-delay: 0.1s">
        <div class="form-header">
            <h2 class="form-title">Applicant Login</h2>
            <p class="form-subtitle">Access your application dashboard</p>
        </div>
        
        <!-- New Applicant Sign Up Option - Moved to top -->
        <div class="new-applicant animate-input" style="animation-delay: 0.15s; text-align: center;">
            <p>New Applicant? <?= Html::a('Sign Up Here', ['site/signup'], [
                'class' => 'signup-link'
            ]) ?></p>
        </div>

        <?= Alert::widget() ?>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'auth-form'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group'],
                'template' => "{label}\n<div class='input-wrapper'>{input}\n{error}</div>\n{hint}",
                'errorOptions' => ['class' => 'invalid-feedback'],
                'labelOptions' => ['class' => 'form-label']
            ]
        ]); ?>

        <!-- Progress Bar -->
        <div class="progress-container" id="login-progress">
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <div class="progress-text" id="progress-text">Authenticating...</div>
        </div>

        <!-- Username Field -->
        <div class="form-group animate-input" style="animation-delay: 0.2s">
            <?= $form->field($model, 'email', [
                'template' => "<div class='input-wrapper'><i class='fas fa-user form-icon'></i>{input}</div>\n{error}\n{hint}"
            ])->textInput([
                'class' => 'form-control',
                'placeholder' => 'Email',
                'autocomplete' => 'email'
            ]) ?>
        </div>

        <!-- Password Field -->
        <div class="form-group animate-input" style="animation-delay: 0.3s">
            <?= $form->field($model, 'password', [
                'template' => "<div class='input-wrapper'><i class='fas fa-lock form-icon'></i>{input}<button type='button' class='password-toggle'><i class='fas fa-eye'></i></button></div>\n{error}\n{hint}"
            ])->passwordInput([
                'class' => 'form-control password-field',
                'placeholder' => 'Password',
                'autocomplete' => 'current-password'
            ]) ?>
        </div>

        <!-- Form Options -->
        <div class="form-options animate-input" style="animation-delay: 0.4s">
            <div class="remember-me">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "{input} {label}",
                    'labelOptions' => ['class' => 'remember-label']
                ]) ?>
            </div>
            <?= Html::a('Forgot password?', ['site/request-password-reset'], [
                'class' => 'forgot-link'
            ]) ?>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn animate-input" style="animation-delay: 0.5s">
            Sign In
        </button>

        <?php ActiveForm::end(); ?>

        <!-- Divider -->
        <div class="form-divider animate-input" style="animation-delay: 0.55s; text-align: center; margin: 20px 0">
            <span class="divider-line"></span>
            <span class="divider-text">OR</span>
            <span class="divider-line"></span>
        </div>

        <!-- OSN Application Link -->
        <div class="osn-application animate-input" style="animation-delay: 0.6s; text-align: center; margin-top: 10px;">
            <?= Html::a('Apply with OSN', ['site/osn'], [
                'class' => 'osn-link'
            ]) ?>
        </div>
    </div>
</div>