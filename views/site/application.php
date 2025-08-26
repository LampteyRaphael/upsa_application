<?php
use app\models\TblCountry;
use app\models\TblTitleTb;
use app\models\TblVotersType;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Application';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];

$this->registerCss(<<<CSS

    .form-section-title {
        border-left: 4px solid #007bff;
        padding-left: 10px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .form-control::placeholder {
        color: #999;
        font-style: italic;
    }

    .custom-photo-preview {
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 10px;
        /* margin-top:-80px; */
        text-align: center;
        background: #f9f9f9;
    }

    .custom-photo-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .help-text {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: -10px;
        margin-bottom: 15px;
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
    
<!-- <div class="site-application container"> -->
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'class' => 'form-horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'errorOptions' => ['class' => 'invalid-feedback'],
        ],
    ]) ?>

    <div class="selection-header">
        <h4><strong>Personal Information</strong></h4>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($modelp, 'title')
                        ->dropDownList(ArrayHelper::map(TblTitleTb::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Choose Title', 'class' => 'form-control']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($modelp, 'first_name')
                        ->textInput([
                            'maxlength' => true,
                            'placeholder' => 'First Name',
                            'readOnly' => $old_student_details['data']['lastname'] ?? false
                        ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($modelp, 'middle_name')
                        ->textInput([
                            'maxlength' => true,
                            'placeholder' => 'Middle Name',
                            'readOnly' => $old_student_details['data']['midname'] ?? false
                        ]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($modelp, 'last_name')
                        ->textInput([
                            'maxlength' => true,
                            'placeholder' => 'Last Name',
                            'readOnly' => $old_student_details['data']['lastname'] ?? false
                        ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($modelp, 'gender')->dropDownList(['male' => 'Male', 'female' => 'Female'],['prompt' => 'Choose gender','class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelp, 'date_of_birth')->input('date', ['placeholder' => 'YYYY-MM-DD']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($modelp, 'nationality')
                        ->dropdownList(ArrayHelper::map(TblCountry::find()->asArray()->all(), 'country', 'country'), ['prompt' => 'Select Country','class' => 'form-control']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="custom-photo-preview">
                <img id="preview" src="<?= $modelp->photo ? Yii::$app->params['sidebarlogo'].'/'.$modelp->photo : Yii::$app->params['logo2'] ?>" alt="Photo">
                <?= $form->field($modelp, 'photo')->fileInput(['onchange' => "document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"])->label(false) ?>
                <div class="help-text">Upload recent passport photo</div>
            </div>
        </div>
    </div>

    <div class="form-section-title">
        <h4><strong>Identification & Emergency Info</strong></h4>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($modelad, 'voters_id_type')->dropDownList(
                ArrayHelper::map(TblVotersType::find()->asArray()->all(), 'id', 'name'),
                ['prompt' => 'Choose ID Type','class' => 'form-control']
            ) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($modelad, 'voters_id')->textInput(['maxlength' => true, 'placeholder' => 'ID Number']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($modelp, 'contact_person')->textInput(['placeholder' => 'Emergency Contact']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($modelp, 'contact_number')->widget('yii\widgets\MaskedInput', [
                'mask' => '999-999-9999'
            ])->textInput(['placeholder' => 'Emergency Number']) ?>
        </div>
    </div>

    <div class="form-section-title">
        <h4><strong>Personal Address</strong></h4>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($modelad, 'address')->textInput(['placeholder' => 'e.g., P.O. Box 142, Accra']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($modelad, 'email')->textInput([
                'placeholder' => 'Email Address',
                'readOnly' => $old_student_details['data']['stud_email'] ?? false
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($modelad, 'gps')->textInput(['placeholder' => 'GPS Code']) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($modelad, 'country')->dropDownList(
                ArrayHelper::map(TblCountry::find()->asArray()->all(), 'country', 'country'),
                ['prompt' => 'Select Country','class' => 'form-control']
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($modelad, 'city')->textInput(['placeholder' => 'Enter City']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($modelad, 'telephone_number')->widget('yii\widgets\MaskedInput', [
                'mask' => '999-999-9999'
            ])->textInput(['placeholder' => 'Telephone Number']) ?>
        </div>
    </div>

    <div class="row mt-4 mb-3">
        <div class="col-12 text-right">
             <?= Html::submitButton('Next <i class="fas fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary'
        ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
