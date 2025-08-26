<?php

/* @var $this yii\web\View */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;


$this->title = 'Employment';
$this->registerCss(<<<CSS
    .education-form-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .form-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .form-header h3 {
        color: #2c3e50;
        font-weight: 600;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .label-class {
        font-weight: 500;
        color: #495057;
        margin-bottom: 8px;
    }
    .text-red {
        color: #dc3545;
    }
    .form-control {
        height: 45px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .action-buttons {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    .btn-outline-secondary {
        padding: 10px 25px;
        font-weight: 500;
    }
    @media (max-width: 768px) {
        .education-form-container {
            padding: 20px;
        }
        .col-md-4 {
            margin-bottom: 15px;
        }
    }
CSS);
?>
    <!-- <div class="site-employment">
    <div class="form-header">
        <div class="col-12 text-center">
            <h3>Current Employment</h3>
            <p class="text-muted">Please provide your current employment details</p>
        </div>
    </div> -->
    <div class="program-selection-container">
    <div class="selection-header">
        <h3>Current Employment</h3>
        <p>Please provide your current employment details</p>
    </div>
    
    <div class="selection-body">

                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true,'placeholder'=>'Enter Company Name']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'position')->textInput(['maxlength' => true,'placeholder'=>'Enter Position']) ?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'employer_telephone_number')->textInput(['placeholder' => 'Phone Number'])->label('Phone Number' . '<span class="text-red"> * </span>', ['class' => 'label-class'])
                            ->widget('yii\widgets\MaskedInput', [
                                'mask' => '999-999-9999'
                            ]);
                        ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'employer_address')->textarea(['maxlength' => true,'placeholder'=>'Enter Employer Address','rows'=>3,'cols'=>2,]) ?>
                    </div>
       
                    <div class="col-12">
                    <div class="action-buttons d-flex justify-content-between">
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Back', ['education'], [
                        'class' => 'btn btn-outline-secondary',
                        'data-method' => 'post'
                    ]) ?>
                    
                    <?= Html::submitButton('Next <i class="fas fa-arrow-right"></i>', [
                        'class' => 'btn btn-primary'
                    ]) ?>
                </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
    </div>