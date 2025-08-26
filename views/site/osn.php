<?php
use dmstr\adminlte\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\helpers\Html;

$this->title = 'OSN Login';
?>

<div class="login-form-container">
    <div class="form-content animate-fade" style="animation-delay: 0.1s">
        <div class="form-header">
            <h2 class="form-title">OSN NUMBER LOGIN</h2>
            <p class="form-subtitle">Access your application dashboard</p>
        </div>
        
        <div class="row mt-5">
        <h3 class="text-center m-auto"><b></b></h3>
    </div> 
    <?= Alert::widget() ?>
        <?php $form = ActiveForm::begin([
            'id' => 'osn-login-form',
            'options' => ['class' => 'auth-form'],
            'fieldConfig' => [
                'options' => ['class' => 'form-group'],
                'template' => "{label}\n<div class='input-wrapper'>{input}\n{error}</div>\n{hint}",
                'errorOptions' => ['class' => 'invalid-feedback'],
                'labelOptions' => ['class' => 'form-label']
            ]
        ]); ?>
        <div class="col-md-lg-12">
            <?= $form->field($model, 'osn_number')->textInput([
                'placeholder' => 'Enter your OSN Number',
                'autofocus' => true
            ])->label(false) ?>
        </div>
        

                <!-- Submit Button -->
        <button type="submit" class="submit-btn animate-input" style="animation-delay: 0.5s">
            Login with OSN
        </button>
        
        <div class="text-center mt-3">
          <p class="text-muted">Already have an account? <?= Html::a('Login here', ['site/login']) ?></p>
        </div>
        
        <?php ActiveForm::end(); ?>
</div>
</div>