<?php
use common\models\TblCountry;
use common\models\TblTitleTb;
use common\models\TblVotersType;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

// use yii\bootstrap\ActiveForm;
// use yii\helpers\ArrayHelper;
// use yii\bootstrap\Html;
$this->title = 'Application';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
?>
<div class="site-application appform">
 <?php $form = ActiveForm::begin(["options"=>['enctype'=>'multipart/form-data']]) ?>
 <div class="row">
        <div class="col-md-8">
        <p ><b><h3>Personal Information</h3></b></p>
        </div>
        <div class="col-sm-3">
            <div class="row float-right">
                <img id="logo" src="<?= $modelp->photo? Yii::getAlias('@web').'images/'.$modelp->photo : '/images/userIcon2.svg' ?>" class="thumbnail rounded float-right" height="80" width="80">
            </div>
            <div class="row float-right ml-5">
              <label for="img"><b>Click me to upload image</b></label>    
              <?php $form->field($modelp, 'photo')->Input('file',['value'=>$modelp->photo, "id"=>"img", "style"=>"display:none;",'class'=>'float-right',"onChange"=>"document.getElementById('logo').src=window.URL.createObjectURL(this.files[0])"])->label(false); ?>
            </div>
        </div>
 </div>
 <div class="row">
    <?php $user_title=TblTitleTb::find()->where(['name'=>ucwords($old_student_details['data']['stud_title'])])->one()?>
    <div class="col-md-3">
        <?= $form->field($modelp, 'title')->dropdownList(ArrayHelper::map(TblTitleTb::find()->asArray()->all(),'id','name'),
            [
            'value'=> $user_title->id,
            'prompt' =>'Choose Option', 
            'class' => 'classname',
        ]
        )->label('Title'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelp, 'first_name')->textInput(['maxlength' => true,'placeholder'=>'Enter  first name','value'=>$old_student_details['data']['firstname']??''],['class'=>'form-group form-group-lg','disabled'=> true])->label('First Name'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelp, 'middle_name')->textInput(['maxlength' => true,'placeholder'=>'Enter  middle name','value'=>$old_student_details['data']['midname']??''],['disabled'=> true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelp, 'last_name')->textInput(['maxlength' => true,'placeholder'=>'Enter  Last Name','value'=>$old_student_details['data']['lastname']??''],['disabled'=> true])->label('Last Name'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelp, 'gender')->dropdownList(['male'=>'Male','female'=>'Female'],
        [
            'value'=> strtolower($old_student_details['data']['stud_gender']), 
            'prompt' =>'Choose Option', 
            'class' => 'classname',
        ]
        )->label('Gender'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelp, 'date_of_birth')->Input('date',[
            'placeholder'=>'YY-MM-dd',
            'value'=>date('Y-d-m',strtotime($old_student_details['data']['stud_dobx']) ),
            ])->label('Date Of Birth'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelp, 'nationality')->dropDownList(ArrayHelper::map(TblCountry::find()->asArray()->all(),'country','country'),
        [
        'value'=>'Ghana', 
        'prompt' =>'Choose Option', 
        'class' => 'classname'
        ]
    ); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelad, 'voters_id_type')->dropDownList(ArrayHelper::map(TblVotersType::find()->asArray()->all(),'id','name'),['prompt'=>'Choose Option'])->label('ID Type'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelad, 'voters_id')->textInput(['maxlength' => true,'placeholder'=>'example:ID Number']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelp, 'contact_person')->textInput(['placeholder'=>'Emergency Person'])->label('Emergency Person'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($modelp, 'contact_number')->Input('number',['placeholder'=>'example: 0240000000'])->label('Emergency Number',['class'=>'label-class'])->widget('yii\widgets\MaskedInput', [
                'mask' => '999-999-9999'
            ]);?>
    </div>
</div>
<p class="col-md-12"><b><h3>Personal Address</h3></b></p>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($modelad, 'address')->textInput(['maxlength' => true,'placeholder'=>'Enter  Address'])->label('Postal/Residential Address'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelad, 'email')->textInput(['maxlength' => true,'placeholder'=>'Enter  Email','value'=>$old_student_details['data']['stud_email']??''])->label('Email'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelad, 'gps')->textInput(['maxlength' => true,'placeholder'=>'Enter Code'])->label('Postal Code'.'<span class="text-red"> </span>',['class'=>'label-class']);  ?>
    </div>
</div>
<div class="row">
<div class="col-md-4">
        <?= $form->field($modelad, 'country')->dropDownList(
        ArrayHelper::map(TblCountry::find()->asArray()->all(),'id','country'),
        [
            'value'=>42, 
            'prompt' =>'Choose Option', 
            'class' => 'classname'
        ]
        )->label('Country'.'<span class="text-red"> * </span>',['class'=>'label-class','id'=>'country']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelad, 'city')->textInput(['maxlength' => true,'placeholder'=>'Enter City'])->label('City'.'<span class="text-red"> * </span>',['class'=>'label-class']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($modelad, 'telephone_number')->Input('number',['value'=>$old_student_details['data']['stud_tel_num']??''])->label('Phone Number'.'<span class="text-red" style="font-size:10px;"> * (example: 0240000000) </span>',['class'=>'label-class']);?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <?= Html::submitButton('Save And Continue', ['class' => 'btn btn-primary float-right']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
</div>