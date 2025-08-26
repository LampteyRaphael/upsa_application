<?php
use app\models\TblEduLevel;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Educational Background';
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
    <div class="program-selection-container">
    <div class="selection-header">
        <h3>Educational Background</h3>
        <p>Please provide your highest educational qualification details</p>
    </div>
    
    <div class="selection-body">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{hint}",
            'options' => ['class' => 'form-group']
        ],
        'options' => ['class' => 'education-form']
    ]); ?>
   
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'institution')->dropdownList(
                ArrayHelper::map(TblEduLevel::find()->asArray()->all(), 'name', 'name'),
                [
                    'class' => 'form-control',
                    'prompt' => 'Select Highest Qualification'
                ]
            )->label('Highest Qualification<span class="text-red"> * </span>', ['class' => 'label-class']); ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'program_offered')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter Programme Offered',
                'value' => $program !== "" ? $program : $model->program_offered,
                'readOnly' => $program !== "" ? true : false,
                'class' => 'form-control'
            ])->label('Programme Offered<span class="text-red"> * </span>', ['class' => 'label-class']); ?>
        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'date')->input('date', [
                'class' => 'form-control'
            ])->label('Date Completed<span class="text-red"> * </span>', ['class' => 'label-class']); ?>
        </div>
    </div>
    
    <div class="action-buttons d-flex justify-content-between">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Back', ['program'], [
            'class' => 'btn btn-outline-secondary',
            'data-method' => 'post'
        ]) ?>
        
        <?= Html::submitButton('Next <i class="fas fa-arrow-right"></i>', [
            'class' => 'btn btn-primary'
        ]) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
</div>

<?php
$this->registerJs(<<<JS
    // Add focus styles dynamically
    $('.form-control').on('focus', function() {
        $(this).parent().find('.label-class').css('color', '#3498db');
    }).on('blur', function() {
        $(this).parent().find('.label-class').css('color', '#495057');
    });
JS);
?>