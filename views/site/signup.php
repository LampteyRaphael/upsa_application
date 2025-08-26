<?php

use app\models\TblCountry;
use dmstr\adminlte\widgets\Alert;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<div class="signup-form-container">
    <div class="signup-form-content animate-fade" style="animation-delay: 0.1s">
        <div class="signup-form-header">
            <div class="alert alert-info">
                <small>
                 <i class="fas fa-info-circle"></i> <b>Note:</b> After successfully signing up, you will be redirected to a payment page to complete the non-refundable application fee. Once the payment is processed, you can proceed with your application.
                </small>
            </div>
        </div>
        
        <?= Alert::widget() ?>

        <?php $form = ActiveForm::begin([
                        'class' => 'form-horizontal',
                        'id' => 'form-signup',
                        'enableClientValidation' => true,
                        'enableAjaxValidation' => false,
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback']
                        ],
                    ]); ?>

                    <!-- Former Student Section -->
                    <div class="form-group">
                        <?= $form->field($model, 'studOption')->dropdownList([
                            '' => 'Are you a former student?',
                            'yes' => 'Yes, I am a former student',
                            'no' => 'No, I am a new student'
                        ], [
                            'id' => 'tblosn-studoption',
                            'class' => 'form-control'
                        ])->label(false) ?>
                    </div>

                    <div id="opt" class="form-group" style="display: none;">
                        <?= $form->field($model, 'studentID')->textInput([
                            'placeholder' => 'Enter your student ID',
                            'autocomplete' => 'off'
                        ])->label(false) ?>
                    </div>

                    <!-- Name Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput([
                                'placeholder' => 'First Name',
                                'autocomplete' => 'given-name'
                            ])->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput([
                                'placeholder' => 'Last Name',
                                'autocomplete' => 'family-name'
                            ])->label(false) ?>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'phone_number')->textInput([
                                'placeholder' => 'Phone Number',
                                'type' => 'tel',
                                'autocomplete' => 'tel'
                            ])->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput([
                                'placeholder' => 'Email Address',
                                'type' => 'email',
                                'autocomplete' => 'email'
                            ])->label(false) ?>
                        </div>
                    </div>

                    <!-- Nationality & Password -->
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'nationality')->dropDownList(
                                ArrayHelper::map(TblCountry::find()->asArray()->all(), 'country', 'country'),
                                [
                                    'prompt' => 'Select Nationality',
                                    'class' => 'form-control'
                                ]
                            )->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password')->passwordInput([
                                'placeholder' => 'Create Password',
                                'autocomplete' => 'new-password'
                            ])->label(false) ?>
                            <small class="form-text text-muted">
                                Use 8 or more characters with a mix of letters, numbers & symbols
                            </small>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                        <label class="form-check-label" for="termsCheck">
                            I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>
                        </label>
                    </div>

    

        <!-- Submit Button -->
        <button type="submit" class="submit-btn animate-input" style="animation-delay: 0.5s">
            Sign Up
        </button>

        <?php ActiveForm::end(); ?>

        <!-- New Applicant Sign Up Option -->
        <div class="new-applicant animate-input" style="animation-delay: 0.6s; text-align: center; margin-top: 20px;">
            <p>Already have an account? <?= Html::a('Login here', ['site/login'], [
                'class' => 'signup-link'
            ]) ?></p>
        </div> 
    </div>
</div>


<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your terms and conditions content here -->
                <p>Application fee is non-refundable. By creating an account, you agree to our privacy policy and terms of service.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
// Toggle student ID field
$('#tblosn-studoption').change(function() {
    if ($(this).val() === 'yes') {
        $('#opt').slideDown();
    } else {
        $('#opt').slideUp();
    }
});

// Form submission loading state
$('#form-signup').on('beforeSubmit', function() {
    var btn = $('#btnclick');
    btn.prop('disabled', true);
    btn.html(btn.data('loading-text'));
});
JS;
$this->registerJs($js);
?>