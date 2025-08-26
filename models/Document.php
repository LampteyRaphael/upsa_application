<?php
namespace app\models;

use app\models\TblApp;
use app\models\TblAppDocument;
use app\models\TblAppEduBg;
use app\models\TblAppEmpDetails;
use app\models\TblAppProgram;
use app\models\TblOsn;
use app\models\TblTitleTb;
use app\models\ResendVerificationEmailForm;
use app\models\VerifyEmailForm;
use kartik\mpdf\Pdf;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\TblAcadamicYear;
use app\models\TblAdmissionAccessTemp;
use app\models\TblAdmissionProfessionalTemp;
use app\models\TblAppAddress;
use app\models\TblAppAdmission;
use app\models\TblAppPersDetails;
use app\models\TblAppQuali;
use app\models\TblDeclaration;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\ContactForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use app\models\TblProgram;
use app\models\TblProgramType;
use app\models\Validate;
use DateTime;
use Exception;
use xj\rsa\RsaPrivate;
use xj\rsa\RsaPublic;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Gitplus\PayFluid\PayFluid;
use Gitplus\PayFluid\Payment;
/**
 * Site controller
 */
class Ligrary
{

/*****************************************************************
/** 0 .. IP, 1 ... network, 2 ... MAC, 3.... C, 4 ... Net Adopter*
/*****************************************************************/

/*****************************************************************
/** Login Mac Address Insertion After Successfull Login          *
/*****************************************************************/

    public function getMacdetails(){
        $macAddr=false;
        $arp=`arp -n`;
        $lines=explode("\n", $arp);

        foreach($lines as $line){
            $cols=preg_split('/\s+/', trim($line));

            if ($cols[0]==$_SERVER['REMOTE_ADDR']){
               //$macAddr=$cols[3];

               $log = Yii::$app->db->createCommand()
             ->insert('login_details_log',
                [
                'login_details_log_ip'=>$cols[0],
                'login_details_log_mac'=>$cols[2] ,
                'login_details_log_network_adopter'=>$cols[4] ,
                'login_details_log_c'=>$cols[3] ,
                'login_details_log_login_time'=> new Expression('NOW()'),
                'login_details_log_created_at'=> new Expression('NOW()'),
                'login_details_log_user'=> ArrayHelper::getValue(Yii::$app->user, 'identity.id'),
            ])->execute();

            if($log){
                return 1;
            }else{
                return 0;
            }

            }
        }
    }


/******************************************************************
/** 0 .. IP, 1 ... network, 2 ... MAC, 3.... C, 4 ...Net Adopter  *
/******************************************************************/
/******************************************************************
/** Login Mac Address Insertion *
/******************************************************************/
    public function getMaclogoutdetails(){

        $macAddr=false;
        $arp=`arp -n`;
        $lines=explode("\n", $arp);

        foreach($lines as $line){
            $cols=preg_split('/\s+/', trim($line));

            if ($cols[0]==$_SERVER['REMOTE_ADDR']){
               //$macAddr=$cols[3];

               $log = Yii::$app->db->createCommand()
               ->update('login_details_log',
                       [
                       'login_details_log_logput_time'=> new Expression('NOW()'),
                       ],
                       [
                        'login_details_log_ip'=>$cols[0],
                        'login_details_log_mac'=>$cols[2] ,
                        'login_details_log_network_adopter'=>$cols[4] ,
                        'login_details_log_c'=>$cols[3] ,
                        'login_details_log_user'=> ArrayHelper::getValue(Yii::$app->user, 'identity.id'),
                        ])
               ->execute();

            if($log){
                return 1;
            }else{
                return 0;
            }

            }
        }

    }



/**************************************
/**   Applicant OSN ID                *
/**************************************/

protected function osnID(){

if(($osn=Yii::$app->session->get('osn')) !==null){
return $osn;
}
// throw new HttpException('Error with your osn');
}


/**************************************
/**   validating Osn, Pin Code        *
/**   and update transaction number   *
/**************************************/
public function actionOsn(){


try {
$this->layout = 'main-login';
$model = new TblOsn();
$validate=new Validate();

if ($model->load(Yii::$app->request->post())){

   $student_option= $validate->replace($_POST['TblOsn']['studOption']);
   $usis_student_ID=$validate->replace($_POST['TblOsn']['studentID']);
   $transID=$validate->replace($_POST['TblOsn']['transaction_no']);
   $pin_code=$validate->replace($_POST['TblOsn']['pin_code']);
   $transID=$validate->replace($_POST['TblOsn']['transaction_no']);
   $year=TblAcadamicYear::find()->where(['status'=>1])->one()->academic_year;

    // Query Applicant OSN Information
   $osn=TblOsn::find()->where(['osn_number'=> $validate->replace($_POST['TblOsn']['osn_number'])])->andwhere(['pin_code'=> $validate->replace($_POST['TblOsn']['pin_code'])])->one();
   Yii::$app->session->set('pincode',$pin_code);

   if(!empty ($imageurl= TblApp::find()->where(['osn'=>$osn->id])->select('personal_details_id')->one())){

       Yii::$app->session->set('imageurl',$imageurl->personalDetails->photo);
   }
   Yii::$app->session->set('pin',$pin_code);
   Yii::$app->session->set('sn',$validate->replace($_POST['TblOsn']['osn_number']));

   Yii::$app->session->set('academic_year',$year);

    // Fetch OSN Details, if grant access
    if(!empty($osn->osn_number))
    {
        if($student_option=='yes')
        {           
            $osn->transaction_no=$transID;
            $osn->year= date('Y-m-d');
            $osn->pin_code= $pin_code;
            $osn->studOption=$student_option;
            $osn->studentID=$usis_student_ID;
            $osn->status=1;
            $osn->save();
            Yii::$app->session->set('studentID',$usis_student_ID);
            $osn=Yii::$app->session->set('osn',$osn->id);
            return $this->redirect(['application-student',]);

        }elseif($student_option=='no')
        {
            $osn->transaction_no=$transID;
            $osn->year= date('Y-m-d');
            $osn->studOption=$student_option;
            $osn->status=1;
            $osn->save();
            $osn=Yii::$app->session->set('osn',$osn->id);

         return $this->redirect(['application']);
        }
         return $this->redirect(['osn']);
    }
        Yii::$app->session->setFlash('error', 'invalid');
        return $this->redirect(['osn']);
} 

}catch (\Exception $e){

// return $e->getMessage();

}
return $this->render('osn',[
'model'=>$model,
// 'link'=> $paymentLink->webUrl
]);

}








/* -------------------------------------------------------------------------- */
/*Saving  applicant personal information, address and photo                   */
/* -------------------------------------------------------------------------- */
public  function  actionApplicationStudent(){
if (!isset($res)) 
$res = new \stdClass();
$res->success = false;
if (!empty( $studID= Yii::$app->session->get('studentID')) && !empty($this->osnID())) {

    if($this->applicantQualification()==true){

        return $this->redirect(['/site/stages-student']);

    }else{

try{
        $this->layout = 'main-application'; 
        $cleanup=new Validate();

        if (!empty($per=$this->personalDetails()))
        {
            $modelp=$per;
        }else 
        {
            $modelp  = new TblAppPersDetails();
        }
        
        if (!empty($ad=$this->personalAddress()))
        {
            $modelad =$ad;
        }else 
        {
            $modelad = new TblAppAddress();
        }
    if ($modelp->load(Yii::$app->request->post())) {
        $imageFile = UploadedFile::getInstance($modelp, 'photo');

        //Save Images
        $imagefiles= $this->applicantPhoto($imageFile,$modelp);
        //saving to personal details tabel
        $personalDetails= $this->applicantDetails($modelp,$cleanup,$imagefiles);
        //saving to personal address tab
        $personalAddress= $this->applicantAddress($modelad,$cleanup);
            
        if ($personalDetails !=null && $personalAddress !=null) {
        $app=new TblApp();
        $app->personal_details_id=$modelp->id;
        $app->personal_address_id=$modelad->id;
        $app->status=2;
        $app->osn=$this->osnID();
        $app->date = date('Y-m-d');
        $app->save();
    }
    Yii::$app->session->set('person', $modelp->id);
    Yii::$app->session->set('address', $modelad->id);
    Yii::$app->session->setFlash('success', 'Successfully Saved');

    return $this->redirect(['program-student']);
    }
}catch(Exception $e){
Yii::$app->session->setFlash('error', 'Error!! something went wrong');
return $this->redirect(['applicationStudent']);
}
    $old_student_details = $cleanup->usis_student($studID);
    $title=$old_student_details['data']['stud_title'];
    $title2=TblTitleTb::find()->where(['name'=>$title])->select('id')->one();

    return $this->render('applicationStudent', [
        'modelp' => $modelp,
        'modelad' => $modelad,
        'old_student_details'=>$old_student_details,
        'title'=>$title2->id??'',
    ]);
}

}else{
return $this->redirect(['/site/osn']);
}
}



 public function actionPrograms($id){

    $program=TblProgram::find()->where(['program_category_id'=>$id])->all();
    $programs=[];
    foreach($program as $item){
        $programs[]=[
            'programme'=>$item->program_name??'',
            'code'=>$item->program_code??'', 
            'level'=>$item->level->level_name??'',
            'id'=>$item->id,
            'category'=>strtoupper($item->programCategory->name),
        ];
    }
    return $this->asJson($programs);
 }




/* -------------------------------------------------------------------------- */
/*  Applicant    Programme of Study                                           */
/* -------------------------------------------------------------------------- */
public function actionProgram()
{
$this->layout = 'main-application';
if (!empty($this->osnID())) {
    if(!empty($this->applicantMainTable()->personal_details_id) && $this->applicantQualification()==false){
try{
        $model=new TblProgramType();
    if ($model->load(Yii::$app->request->post())) {
        $program=TblProgram::find()->where(['program_category_id'=>$_POST['TblProgramType']['name']])->all();

            return $this->render('program', [
                'model' => $model,
                'program'=>$program,
                'application'=>$this->applicantQualification(),
            ]);
    }
}catch(Exception $e){
    return $this->redirect(['program']);
}

return $this->render('program', [
    'model' => $model,
    'program'=>$_POST['TblProgramType']['name']??'',
]);
    }else{

        return $this->redirect(['/site/application']);
    }

}else{
 return $this->redirect(['/site/osn']);
}
}



/* -------------------------------------------------------------------------- */
/*  program applicant want to study                                           */
/* -------------------------------------------------------------------------- */
public function actionProgramStudent()
{
$this->layout = 'main-application';
$validate=new Validate();
if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {


    if(!empty($this->applicantMainTable()->personal_details_id) && $this->applicantQualification()==false){
try{
        $model=new TblProgramType();
    if ($model->load(Yii::$app->request->post())) 
    {
        $program=TblProgram::find()->where(['program_category_id'=>$_POST['TblProgramType']['name']])->all();

        Yii::$app->session->set('program',$program->id);

            return $this->render('programStudent', [
                'model' => $model,
                'program'=>$program,
            ]);
    }
}catch(Exception $e)
{
    // Yii::$app->session->setFlash('error', 'Error!! something went wrong');
    return $this->redirect(['programStudent']);
}

}else{

    return $this->redirect(['/site/application-student']);
}

return $this->render('programStudent', [
    'model' => $model,
    'program'=>$_POST['TblProgramType']['name']??'',
]);
}else
{
// Yii::$app->session->setFlash('error', 'Provide Step one');
return $this->redirect(['/site/application2']);
}
}

/* -------------------------------------------------------------------------- */
/*  Step two of the program applying for                                     */
/* -------------------------------------------------------------------------- */

public function actionCourses(){ 

if (!empty($this->osnID())) {
try{
    if (isset($_POST['program'])){

        if (!empty($programs=TblAppProgram::find()->where(['osn_id'=>$this->osnID()])->one())){
            $program=$programs;
        }else {
            $program=new TblAppProgram();
        }
        $program->tbl_program= $_POST['program'];
        $program->osn_id=$this->osnID();

    if($program->save())
    {
            $app=TblApp::find()->where(['osn'=>$this->osnID()])->one();

            if(!empty($app))
            {
                $app['program_id']=$program->id;
                $app->save();
            }
            Yii::$app->session->set('program', $program->id);
            Yii::$app->session->setFlash('success', 'Program Successfully Selected');
            return $this->redirect(['site/program']);
    }else
    {
            Yii::$app->session->setFlash('error', 'Program Already Selected');
            return $this->redirect(['site/program']);
    }
    
    }else{
        // Yii::$app->session->setFlash('error', 'Select At List One Program');
        return $this->redirect(['/site/program']);
    }

}catch(Exception $e){
// Yii::$app->session->setFlash('error', 'Error!! something went wrong');
return $this->redirect(['program']);
}
}else{
return $this->redirect(['/site/osn']);
}
}



public function actionCoursesStudent(){

if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {
try{
    if (isset($_POST['program']))
    {
     if(!empty($programs=TblAppProgram::find()->where(['osn_id'=>$this->osnID()])->one())){
            $program=$programs;
        }else{
            $program=new TblAppProgram();
        }

        $program->tbl_program= $_POST['program'];
        $program->osn_id=$this->osnID();   
        
        if($program->save()){

            $app=$this->applicantMainTable();
            if($app !=null){
                $app['program_id']=$program->id;
                $app->save();
            }

            Yii::$app->session->set('program', $program->id);
            Yii::$app->session->setFlash('success', 'Program Successfully Selected');
            return $this->redirect(['site/program-student']);
        }else{
            Yii::$app->session->setFlash('error', 'Program Already Selected');
            return $this->redirect(['site/program-student']);
        }
    }else{
        Yii::$app->session->setFlash('error', 'Select At List One Program');
        return $this->redirect(['/site/program-student']);
    }
}catch(Exception $e){
return $this->redirect(['programStudent']);
}
}else{
return $this->redirect(['/site/osn']);
}
}


// Remove selected courses
public function actionRemove(){
$this->layout = 'main-application';
if (!empty(Yii::$app->session->get('osn'))) {

if (!empty($_POST['program'])){

$removed=TblAppProgram::find()->where(['id'=>$_POST['program']])->one();
if($removed->delete()){

Yii::$app->session->setFlash('success', 'Successfully removed');

return $this->redirect(['/site/program']);
}
}else{
   Yii::$app->session->setFlash('error', 'course is not selected');
   return $this->redirect(['/site/program']);
}
}else{
return $this->redirect(['osn']);
}
}

//Save or Store Applicant Educational Details
public function actionEducation(){
$this->layout = 'main-application';
$res=new \stdClass();
$res->seccess=null;

if (!empty($this->osnID()))
{
    if(!empty($this->applicantMainTable()->program_id) && $this->applicantQualification() ==false){
     try{

         $cleanup=new Validate();

        if (!empty($ed=$this->applicantEducation())){

            $model=$ed;

        }else {
            $model = new TblAppEduBg();
        }
    if ($model->load(Yii::$app->request->post()))
     {
        $model['osn_id']=$this->osnID()??'';
        $model['institution']=$cleanup->replace2($_POST['TblAppEduBg']['institution']);    
        $model['program_offered']= $cleanup->replace2($_POST['TblAppEduBg']['program_offered']); 

         if ($model->save()) 
        {
           $edu=$this->applicantMainTable();

            if($edu !=null){
                $edu['personal_education_id']=$model->id;
                $edu->save();
            }

            Yii::$app->session->set('education', $model->id);
            Yii::$app->session->setFlash('success', 'Successfully Saved');

            return $this->redirect(['site/employment']);

        }
        elseif (!$model->save())
        {
                // Yii::$app->session->setFlash('error', 'Step Four Already Saved');

                return $this->redirect(['/site/employment']);
        }
    }

    return $this->render('education', [
        'model' => $model,
    ]);

    }catch(Exception $e){

        // Yii::$app->session->setFlash('error', 'Error!! something went wrong'.$e->getMessage());

        return $this->redirect(['education']);
    }
   }else{
        return  $this->redirect(['site/program']);
    }

}else{
    return $this->redirect(['/site/osn']);
}
}



// Save or Store Applicant Educational Details
public function actionEducationStudent(){

    $this->layout = 'main-application';

if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {

    if(!empty($this->applicantMainTable()->program_id) && $this->applicantQualification()==false){

   try{
   
    $cleanup=new Validate();
    $studID=   Yii::$app->session->get('studentID');

    $old_student_details = $cleanup->usis_student($studID);
      $program=$old_student_details['data']['program'];

       if (!empty($ed=$this->applicantEducation())){
           $model=$ed;
       }else {
           $model = new TblAppEduBg();
       }
   if ($model->load(Yii::$app->request->post())) {
       $model->osn_id=$this->osnID();
       $model->institution= $cleanup->replace2($_POST['TblAppEduBg']['institution']);
       $model->program_offered=$cleanup->replace2($_POST['TblAppEduBg']['program_offered']);
       if ($model->save()) 
       {
           $edu=$this->applicantMainTable();
           $edu->personal_education_id=$model->id;
           $edu->save();
           Yii::$app->session->set('education2', $model->id);
           Yii::$app->session->setFlash('success', 'Successfully Saved');
           return $this->redirect(['site/employment-student']);
       }
       else
        if (!$model->save())
        {
            return $this->redirect(['/site/employment-student']);
        }
   }

   return $this->render('educationStudent', [
       'model' => $model,
       'program'=>$program,
   ]);

   }catch(Exception $e){
       return $this->redirect(['education']);
   }

}else{
    return $this->redirect(['/site/program-student']);
}

}else{
   return $this->redirect(['/site/program2']);
}
}



public function actionEmployment(){

$this->layout = 'main-application';
if (!empty($this->osnID())) {
    if(!empty($this->applicantMainTable()->personal_education_id) && $this->applicantQualification()==false){
    try{
        if (!empty($em=$this->applicantEmployment())){
            $model=$em;
        }else {
            $model = new TblAppEmpDetails();
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->osn_id=$this->osnID();
            if ($model->save()){
                $edu=$this->applicantMainTable();
                $edu->personal_employment_id=$model->id;
                $edu->save();
                Yii::$app->session->set('employment', $model->id);
                Yii::$app->session->setFlash('success', 'Successfully Saved');
            }elseif (!$model->save()){
                    Yii::$app->session->setFlash('error', 'Step Three Already Saved');
            }

            return $this->redirect(['document']);
        }
        return $this->render('employment', [
            'model' => $model,
        ]);

    }catch(Exception $e){
        Yii::$app->session->setFlash('error', $e->getMessage());
        return $this->redirect(['employment']);
    }
  }else{
        return $this->redirect(['education']);
    }
    
}else{
    return $this->redirect(['/site/osn']);
}
}


public function actionEmploymentStudent(){
$this->layout = 'main-application';
if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {
    if(!empty($this->applicantMainTable()->personal_education_id) && $this->applicantQualification()==false){

    try{

        $validate=new Validate();
        $studID=   Yii::$app->session->get('studentID');
        $old_student_details = $validate->usis_student($studID);
        $program=$old_student_details['data']['program'];
        $em=$this->applicantEmployment();
        if (!empty($em)){
            $model=$em;
        }
        else {
            $model = new TblAppEmpDetails();
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->osn_id=$this->osnID();
            if ($model->save()){
                $edu=$this->applicantMainTable();
                $edu->personal_employment_id=$model->id;
                $edu->save();
                Yii::$app->session->set('employment', $model->id);
                Yii::$app->session->setFlash('success', 'Successfully Saved');
                return $this->redirect(['document-student']);
            }
            elseif (!$model->save())
            {
                    Yii::$app->session->setFlash('error', 'Already Saved');
                    return $this->redirect(['document-student']);
            }
        }
        return $this->render('employmentStudent', [
            'model' => $model,
        ]);

    }catch(Exception $e){
        return $this->redirect(['employment-student']);
    }

}else{

        return $this->redirect(['/site/education-student']);
    }

}else{
    return $this->redirect(['osn']);
}
}



    public function actionDocument(){
        $this->layout = 'main-application'; 

    if (!empty($this->osnID())) {

        if(!empty($this->applicantMainTable()->personal_employment_id) && $this->applicantQualification()==false){
              try{
                      $model=new  TblAppDocument();
                      $document_upload=new Validate();
                      $doc=TblAppDocument::find()->where(['personalDetail_id'=>$this->applicantMainTable()->personal_details_id]);

                    if ($model->load( Yii::$app->request->post()))
                     {                     
                            $imageFile=UploadedFile::getInstance($model, 'doc_name');
                            $fileName=$_POST['TblAppDocument']['category'];
                            $application_year=date('Y');
                            $student_category='Professional';
                            $foldername=Yii::$app->session->get('pin');
                            $filename=$fileName;
                            $filetype = $imageFile->type;
                            $filedata = $imageFile->tempName;
                            $doc_upload_status=$document_upload->actionAlfrescoMain($application_year, $student_category,$foldername,$filename,$filetype,$filedata );

                            if(!empty($doc_upload_status)){

                                $model->doc_name=$_POST['TblAppDocument']['category'];
                                $model->category=Yii::$app->session->get('pin').'_'.'IPS'.'_'.$_POST['category_name'];
                                $model->personalDetail_id=$this->applicantMainTable()->personal_details_id;
                               if($model->save()){

                                                            
                                if(((int) $doc->count() >=1) && (empty($this->applicantMainTable()->sms_2)) ){

                                    $update_document= $this->applicantMainTable();
                                    $update_document->personal_document_id=$this->applicantMainTable()->personal_details_id;
                                    $update_document->status=1;
                                    $update_document->sms_2=1;
                                    $update_document->save();

                                    //Application final sms
                                    $sn= Yii::$app->session->get('sn');
                                    $p= Yii::$app->session->get('pin');
                                    $document_upload->sms2($this->personalDetails()->first_name,$this->personalAddress()->telephone_number,$sn,$p);

                                    // return $this->redirect(['declaration']);
                                    // Yii::$app->session->setFlash('success', 'Successfully Uploaded');
                                }

                                // else{
                                    Yii::$app->session->setFlash('success', 'Successfully Uploaded');

                                    return $this->redirect(['document']);

                                // }

                              

                               }

                            }

                            Yii::$app->session->setFlash('error', 'Not Successfully Uploaded');

                            return $this->redirect(['document']);
                    }

        }catch(Exception $e){
            return $this->redirect(['document']);
        }

        return $this->render('document', [
            'model' => $model,
            'doc'=>$doc->orderBy('created_at','asc')->all(),
        ]);

    }else{
        return $this->redirect(['/site/employment']);
    }
        

    }else{
        return $this->redirect(['/site/osn']);
    }
}


public function actionDocumentStudent(){

$this->layout = 'main-application';
if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {
    if(!empty($this->applicantMainTable()->personal_employment_id) && $this->applicantQualification()==false){

        try{
            $model=new  TblAppDocument();
            $document_upload=new Validate();
            $document=TblAppDocument::find();

          if ($model->load( Yii::$app->request->post()))
           {
              $model->doc_name=$_POST['TblAppDocument']['category'];
              $model->category=Yii::$app->session->get('pin').'_'.'IPS'.'_'.$_POST['category_name'];
              $model->personalDetail_id=$this->applicantMainTable()->personal_details_id;
             if($model->save()){

               
              //updating application document table with personal details id
                  Yii::$app->session->setFlash('success', 'Successfully Uploaded');
                  $imageFile=UploadedFile::getInstance($model, 'doc_name');
                  $fileName=$_POST['TblAppDocument']['category'];
                  $application_year=date('Y');
                  $student_category='Professional';
                  $foldername=Yii::$app->session->get('pin');
                  $filename=$fileName;
                  $filetype = $imageFile->type;
                  $filedata = $imageFile->tempName;
                  $document_upload->actionAlfrescoMain($application_year, $student_category,$foldername,$filename,$filetype,$filedata );

                  if($document->count() >3){

                      $update_document= $this->applicantMainTable();
                      $update_document->personal_document_id=$this->applicantMainTable()->personal_details_id;
                      $update_document->save();


                      $sn= Yii::$app->session->get('sn');
                      $p= Yii::$app->session->get('pin');
                      $document_upload->sms2($this->personalDetails()->first_name,$this->personalAddress()->telephone_number,$sn,$p);

                      return $this->redirect(['declaration-student']);
                  }
                  
                  return $this->redirect(['document-student']);
              }
          }

}catch(Exception $e){
  return $this->redirect(['document-student']);
}

return $this->render('documentStudent', [
  'model' => $model,
  'doc'=>$document->where(['personalDetail_id'=>$this->applicantMainTable()->personal_details_id])->orderBy('created_at','asc')->all(),
]);

}else{

    return $this->redirect(['/site/employment-student']);
}

}else{
return $this->redirect(['osn']);
}
}


public function actionDelete($id){

    $app_remove=TblAppDocument::find()->where(['id'=>$id])->andWhere(['personalDetail_id'=>$this->applicantMainTable()->personal_details_id])->one();
    if($app_remove!==null){

        if($app_remove->delete()){
        
            Yii::$app->session->setFlash('success', 'Successfully Removed Document');
    
            return $this->redirect(Yii::$app->request->referrer);
            // return $this->redirect(['document']);
    
        }else{
            Yii::$app->session->setFlash('error', 'Not Successfully Removed');
    
            return $this->redirect(Yii::$app->request->referrer);
            // return $this->redirect(['document']);
        }
    }
    return $this->redirect(['document']);
}



public function actionDeclaration(){
$this->layout = 'main-application';

if (!empty(Yii::$app->session->get('osn'))) {
    if(!empty($this->applicantMainTable()->personal_document_id) && $this->applicantQualification()==false){
    try{
      $applications=TblApp::find()->where(['osn'=>$this->osnID()])->one();
      
      $declaration=TblDeclaration::find()->all();
         if($applications !==null){
            return $this->render('declaration', [ 'personal' => $applications,'declaration'=>$declaration]);
        }else{
            // Yii::$app->session->setFlash('error', 'You Have Not Complete All The Steps');
            return $this->redirect(['document']);
        }
    }catch(Exception $e){
        return $this->redirect(['document']);
    }

    return $this->render('declaration', [ 'personal' => $applications,'declaration'=>$declaration]);

 }else{
    return $this->redirect(['/site/document']);
 }

 }else{
    return $this->redirect(['/site/osn']);
  }
}


public function actionDeclarationStudent(){
$this->layout = 'main-application';
if (!empty(Yii::$app->session->get('studentID')) && !empty($this->osnID())) {
    if(!empty($this->applicantMainTable()->personal_document_id) && $this->applicantQualification()==false){

    try{
         $applications=TblApp::find()->where(['osn'=>$this->osnID()])->one();
      
         if($applications !==null){

            return $this->render('declarationStudent', [ 'personal' => $applications]);
        }else{
            // Yii::$app->session->setFlash('error', 'You Have Not Complete All The Steps');
            return $this->redirect(['document-student']);
        }
    }catch(Exception $e){
        return $this->redirect(['document-student']);
    }

}else{

    return $this->redirect(['/site/document-student']);
}

    return $this->render('declarationStudent', [ 'personal' => $applications]);

}else{
    return $this->redirect(['osn']);
}
}



public function actionStages(){
    $this->layout = 'main-application';
    if (!empty($this->osnID())) {

        if($this->applicantQualification()==true){

    try{
        
    $app= TblApp::find()->where(['id'=>$this->applicantMainTable()->id])->one();
    // return   $app->id;die;
    $apps= $app->status0->name;

    $quali = TblAppQuali::find()->where(['application_id'=>$app->id])->where(['status'=>[2,3]])->one();
    $qualis=$quali->status0->name;

    $admiss = TblAppAdmission::find()->where(['application_id'=>$app->id])->one();

    if($quali->status==3){
        $admission='Pending';
    }else{
        $admission=$admiss->status0->name;
    }
   

    }catch(Exception $e){

    }
    return $this->render('stages',[
        'app'=>$apps??'Pending',
        'quali'=>$qualis??'Pending',
        'admiss'=>$admission?? "Pending"

    ]);

}else{
    return $this->redirect(['application']);
}
}else{
    return $this->redirect(['osn']);
}
   
}


public function actionStagesStudent(){
    $this->layout = 'main-application';
    if (!empty($this->osnID())) {

        if($this->applicantQualification()==true){

    try{


    $app= TblApp::find()->where(['osn'=>$this->osnID()])->one()??'';
    $apps= $app->status0->name;


    $quali = TblAppQuali::find()->where(['application_id'=>$app->id])->one();
    $qualis=$quali->status0->name;


    $admiss = TblAppAdmission::find()->where(['application_id'=>$app->id])->one();
    $admission=$admiss->status0->name;

  

    }catch(Exception $e){

    }
    return $this->render('stages',[
        'app'=>$apps??'Pending',
        'quali'=>$qualis??'Pending',
        'admiss'=>$admission?? "Pending"

    ]);

}else{
    return $this->redirect(['application-student']);
}
}else{
    return $this->redirect(['osn']);
}
   
}


/**
* Requests password reset.
*
* @return mixed
*/
public function actionRequestPasswordReset()
{
$this->layout = 'main-login';
$model = new PasswordResetRequestForm();
if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    
    if ($model->sendEmail()) {
        Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

        return $this->goHome();
    } else {
        Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
    }
}

return $this->render('requestPasswordResetToken', [
    'model' => $model,
])  ;
}

/**
* Resets password.
*
* @param string $token
* @return mixed
* @throws BadRequestHttpException
*/
public function actionResetPassword($token)
{
$this->layout = 'main-login';

try {
    $model = new ResetPasswordForm($token);
} catch (InvalidArgumentException $e) {
    throw new BadRequestHttpException($e->getMessage());
}

if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    Yii::$app->session->setFlash('success', 'New password saved.');

    // return $this->goHome();
    return $this->redirect(['/site/login']);
}

return $this->render('resetPassword', [
    'model' => $model,
]);
}

/**
* Verify email address
*
* @param string $token
* @throws BadRequestHttpException
* @return yii\web\Response
*/
public function actionVerifyEmail($token)
{
$this->layout = 'main-login';
try {
    $model = new VerifyEmailForm($token);
} catch (InvalidArgumentException $e) {
    throw new BadRequestHttpException($e->getMessage());
}
if ($user = $model->verifyEmail()) {
    if (Yii::$app->user->login($user)) {
        Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
        return $this->goHome();
    }
}

Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
return $this->goHome();
}

/**
* Resend verification email
*
* @return mixed
*/
public function actionResendVerificationEmail()
{        
$this->layout = 'main-login';
$model = new ResendVerificationEmailForm();
if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    if ($model->sendEmail()) {
        Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
        return $this->goHome();
    }
    Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
}

return $this->render('resendVerificationEmail', [
    'model' => $model
]);
}


public function actionReport($id) 
{
    Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $personal= TblApp::find()->where(['id'=>$id])->one();
    $declaration=TblDeclaration::find()->all();
    $content=$this->renderPartial('_declaration',['personal'=>($personal??''),'declaration'=>$declaration]);
    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, 
        'destination' => Pdf::DEST_BROWSER,
        'content' => $content,
        'destination' => Pdf::DEST_BROWSER,
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'options' => [
           
        ],
        'methods' => [
            'SetTitle' => 'IPS',
            'SetSubject' => 'UPSA',
            'SetHeader' => ['Institute Of Professional Studies(IPS)||Generated On: ' . date("r")],
            'SetAuthor' => 'UPSA',
            'SetCreator' => 'UPSA',
            'SetKeywords' => 'UPSA',
        ]
    ]);
    return $pdf->render();
}


public function actionExit()
{
Yii::$app->user->logout();
Yii::$app->getSession()->destroy();
Yii::$app->cache->flush();

return $this->redirect(['osn']);
}


public function actionForgot()
{
$this->layout = 'main-login';
$model = new PasswordResetRequestForm();

if ($model->load(Yii::$app->request->post()))
{

    if ($model->sendEmail()) {
        Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
        return $this->goHome();
    }
    Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
}

return $this->render('requestPasswordResetToken', [
    'model' => $model,
])  ;
}






public function actionDownload(){
    $validate=new Validate();
    $admission=TblAppAdmission::find()->where(['application_id'=>$this->applicantMainTable()->id])->one();
    $model= new TblAppPersDetails();
    $declaration=TblAdmissionProfessionalTemp::find()->all();
    Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $content=$this->renderPartial('_admission',['admission'=>$admission,'validate'=>$validate,'declaration'=>$declaration,'model'=>$model]);
    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        'destination' => Pdf::DEST_BROWSER,
        'destination' => Pdf::DEST_BROWSER,
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'content' => $content,
    
        'methods' => [
            'SetTitle' => 'Institute Of Professional Studies',
            'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
            'SetHeader' => ['Institute Of Professional Studies||Generated On: ' . date("r")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
            'SetAuthor' => 'Kartik Visweswaran',
            'SetCreator' => 'Kartik Visweswaran',
            'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
        ]
    ]);
    return $pdf->render();
}

}