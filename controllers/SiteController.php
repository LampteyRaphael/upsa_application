<?php
namespace app\controllers;

use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\AppLoginForm;
use app\models\TblApp;
use app\models\TblAppDocument;
use app\models\TblAppEduBg;
use app\models\TblAppEmpDetails;
use app\models\TblAppProgram;
use app\models\ResendVerificationEmailForm;
use app\models\VerifyEmailForm;
use kartik\mpdf\Pdf;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\SignupForm;
use app\models\TblAcadamicYear;
use app\models\TblAcademicYear;
use app\models\TblAppAddress;
use app\models\TblAppAdmission;
use app\models\TblAppPersDetails;
use app\models\TblAppQuali;
use app\models\TblCountry;
use app\models\TblDeclaration;
use app\models\TblOsn;
use yii\web\UploadedFile;
use app\models\TblProgram;
use app\models\TblProgramType;
use app\models\TblTransaction;
use app\models\Validate;
use app\models\Validate2;
use Exception;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use Gitplus\PayFluid\PayFluid;
/**
 * Site controller
 */
class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except'=>['signup','status','request-password-reset','reset-password','index','homep'],
                'rules' => [
                    [
                        'actions' => ['login', 'error',
                        'application','program',
                        'programs','education',
                        'employment','document','declaration',
                        'report','remove','courses','download',
                        'stages','delete','about','osn','osnform'
                    ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','osn','osnform'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        $this->layout = 'main-login2';
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

  

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


public function actionIndex()
{

    $this->layout = 'demo';

 return $this->render('index');

    // return $this->actionLogin();
}

public function actionHomep(){

        $this->layout = 'homep';

 return $this->render('homep');

    // return $this->actionLogin();
}

/**
* Logs out the current user.
*
* @return mixed
*/
public function actionLogout()
{
    $this->layout = 'main-login';
    // $this-> getMaclogoutdetails();
    Yii::$app->user->logout();

    return $this->redirect(['login']);
}


public function actionStatus()
{
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        try {
            $qs = $_GET["qs"];
            $cleanup = new Validate2();
            $model_Login = new AppLoginForm();
  
            $trans=TblTransaction::find()->where(['txn_payLink'=>$cleanup->paymentLink($qs)])->one();
            
            $paymentStatus = PayFluid::verifyPayment($qs, $trans->txn_sess);

            if ($paymentStatus->statusCode === "0") {

                $statusAsJson = $paymentStatus;
                $trans->txn_currency = htmlspecialchars($statusAsJson ->currency??'');
                $trans->txn_amt = htmlspecialchars($statusAsJson ->amount??'');
                $trans->txn_sc_msg = htmlspecialchars($statusAsJson ->statusString??'');
                $trans->txn_clientReference = htmlspecialchars($statusAsJson ->clientReference??'');
                $trans->txn_sc = htmlspecialchars($statusAsJson ->dateTime??'');
                $trans->txn_gw_sc = htmlspecialchars($statusAsJson ->upStreamDebitStatus);
                $trans->txn_maskedInstr = htmlspecialchars($statusAsJson ->maskedInstrument??'');
                $trans->txn_payReference = htmlspecialchars($statusAsJson ->payReference??'');
                $trans->txn_payScheme = htmlspecialchars($statusAsJson ->payScheme??'');
                $trans->txn_payFluidReference = htmlspecialchars($statusAsJson ->payFluidReference??'');
                $trans->txn_statusCode = htmlspecialchars($statusAsJson->statusCode==="0"? "SUCCESS":"FAILED");
                $trans->txn_signature = htmlspecialchars($statusAsJson ->signature??'');   
                if($trans->save()){

                // Fetch the user transaction details, change the status from 0 (none active) to 1(active)
                   $user = TblOsn::find()->where(['id'=> $trans->user_id])->one();
                   $user->status=1;
                   $user->save();

                // Attempt to Login
                   $model_Login->email = $user->email??'';
                   $model_Login->password = Yii::$app->session->get('password');
                   $model_Login->login();

                   Yii::$app->session->set('osn', $user->id);
                   Yii::$app->session->setFlash('success', 'Payment successful continue with the application');
                   return $this->redirect(['application']);

                }else{
                    return "not saved";
                }

            } else {
                $statusAsJson = $paymentStatus;
                $trans->txn_currency = htmlspecialchars($statusAsJson->currency??'');
                $trans->txn_amt = htmlspecialchars($statusAsJson->amount??'');
                $trans->txn_sc_msg = htmlspecialchars($statusAsJson->statusString??'');
                $trans->txn_clientReference = htmlspecialchars($statusAsJson->clientReference??'');
                $trans->txn_sc = htmlspecialchars($statusAsJson->dateTime??'');
                $trans->txn_maskedInstr = htmlspecialchars($statusAsJson->maskedInstrument??'');
                $trans->txn_payReference = htmlspecialchars($statusAsJson->payReference??'');
                $trans->txn_payScheme = htmlspecialchars($statusAsJson->payScheme??'');
                $trans->txn_payFluidReference = htmlspecialchars($statusAsJson->payFluidReference??'');
                $trans->txn_statusCode = htmlspecialchars($statusAsJson->statusCode==="0"? "SUCCESS":"FAILED");
                $trans->txn_signature = htmlspecialchars($statusAsJson->signature);

                if($trans->save()){
                    Yii::$app->session->setFlash('error', 'Payment failed');
                    return $this->redirect(['login']);
                }

                // return $this->redirect(['login']);

                // echo "Payment failed: " . $paymentStatus->statusString;
            }
        } catch (\Throwable $e) {
            // return $this->redirect(['signup']);
            // echo "Verifying payment failed: ";
            return  $this->goBack(Yii::$app->request->referrer);
        }   
    }

}



public function actionContact()
{

    $this->layout = 'main-login2';
 
    return $this->render('contact', [
        // 'model' => $model,
        'link'=> '',
    ]);
}



public function actionOsn()
{
    $this->layout = 'main-login';
    $model = new TblOsn();
    
    if ($model->load(Yii::$app->request->post())) {
        
        // Process OSN login here        
        $osnNumber = trim($model->osn_number);
        $osnNumber = preg_replace('/\s+/', '', $osnNumber); // Remove all whitespace
        $student = TblOsn::findOne(['osn_number' => $osnNumber,'status_osn'=>'SUCCESS']);
        
        if ($student) {
            // Login successful logic
            Yii::$app->session->set('osnnumber', $osnNumber);
            return $this->render('osn_form', [
                'model' => $model,
            ]);

            // return $this->redirect(['create/index']); // Change to your desired redirect
        } else {
            Yii::$app->session->setFlash('error', 'Invalid OSN Number');
        }
    }
    
    return $this->render('osn', [
        'model' => $model,
    ]);
}


public function actionOsnform()
{
    // Check if osnnumber session exists, otherwise redirect back
    if (!Yii::$app->session->get('osnnumber')) {
        Yii::$app->session->setFlash('error', 'Invalid access. Please start your application from the beginning.');
        return  $this->goBack(Yii::$app->request->referrer);
    }

    $this->layout = 'main-login2';
    $model = new TblOsn();
    $cleanup = new Validate();
    $model_Login = new AppLoginForm();
    
    try {
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $osn_number = $cleanup->replace(Yii::$app->session->get('osnnumber'));
            $password = $cleanup->replace($_POST['TblOsn']['password']);
            $email = $cleanup->filter_mail($_POST['TblOsn']['email']);
            $phoneNumber = $cleanup->replace($_POST['TblOsn']['phone_number']);
            $nationality = $cleanup->replace($_POST['TblOsn']['nationality']);
            $first_name = $cleanup->replace($_POST['TblOsn']['first_name']);
            $last_name = $cleanup->replace($_POST['TblOsn']['last_name']);
            $studOption = $cleanup->replace($_POST['TblOsn']['studOption']);
            $studentID = $cleanup->replace($_POST['TblOsn']['studentID']);

            try {
                // Find existing user or create new
                $user = TblOsn::findOne(['osn_number' => $osn_number]) ?? new TblOsn();
                
                // Generate student index number
                $apps = new Validate2();
                
                // Set user attributes
                $user->setAttributes([
                    'username' => trim($model->first_name . ' ' . $model->last_name),
                    'email' => $email,
                    'phone_number' => $phoneNumber,
                    'nationality' => $nationality,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'password_hash' => Yii::$app->security->generatePasswordHash($password),
                    'status' => 1,
                    'year' => date('Y'),
                    'role_id' => 1,
                    'studOption' => $studOption,
                    'studentID' => $studentID,
                    'status_osn'=>'USED',
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                ]);

                if (!$user->save()) {
                    throw new \Exception('Failed to save user: ' . implode(', ', $user->getFirstErrors()));
                }

                // Get current academic year
                $academicYear = TblAcadamicYear::find()
                    ->where(['status' => 1])
                    ->select('academic_year')
                    ->scalar();

                if (!$academicYear) {
                    throw new \Exception('No active academic year found.');
                }

                // Set session variables
                $model_Login->email=$email;
                $model_Login->password=$password;
               

                $transaction->commit();
                $model_Login->login();
                Yii::$app->session->set('academic_year', $academicYear);
                Yii::$app->session->set('osn', $user->id);
                Yii::$app->session->setFlash('success', 'Registration successful! Welcome to the Application Portal.');
                return $this->redirect(['application']);

            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }

    } catch (\Exception $e) {
        Yii::error("OSN Form Error: {$e->getMessage()}\n{$e->getTraceAsString()}", 'application');
        
        $errorMessage = YII_DEBUG 
            ? $e->getMessage() 
            : 'An error occurred during registration. Please try again.';
            
        Yii::$app->session->setFlash('error', $errorMessage);
        
        return $this->refresh();
    }

    return $this->render('signup', [
        'model' => $model,
    ]);
}

    public function actionSignup()
    {
       try {
            $this->layout = 'main-login';
            $model = new SignupForm();
            $cleanup=new Validate();
            $apps=new Validate2();

            if ($model->load(Yii::$app->request->post())) 
            {

               $phoneNumber= $cleanup->check_only_int2($_POST['SignupForm']['phone_number']);
               $email=  $cleanup->filter_mail($_POST['SignupForm']['email']);
               $password=  $cleanup->filter_mail($_POST['SignupForm']['password']);
               $app_name= $cleanup->replace2($_POST['SignupForm']['first_name']) . ' ' . $cleanup->replace2($_POST['SignupForm']['last_name']);
               $user_id = $model->osnup();

               Yii::$app->session->set('password',$password);
               if(!empty($user_id)){

                $amounts = TblCountry::find()->where(['country'=>htmlspecialchars($_POST['SignupForm']['nationality'])])->select('amount')->one();

                $amount =  $amounts->amount??'0';

                $link = $apps->payment($user_id,$amount, $phoneNumber, $email,$app_name);
                
                if(!empty($user_id)){

                    return '<script type="text/javascript">window.top.location.href = "' . $link . '"; </script>';
                    
                }else{
                    // return $this->render('_reportView',['link'=>$link]);   
                    Yii::$app->session->setFlash('error','Account already created');
                    return $this->render('signup', [
                        'model' => $model,
                    ]);
                }
                Yii::$app->session->setFlash('error','Account already created');
                // return  $this->goBack(Yii::$app->request->referrer);
               }

               Yii::$app->session->setFlash('error','Account already created');

               return $this->render('signup', [
                'model' => $model,
                ]);
        }

        }catch(Exception $e){

        // return $this->redirect(['signup']);
            // var_dump($e->getMessage());die;
             Yii::$app->session->setFlash('error','Post Failed');
             return  $this->goBack(Yii::$app->request->referrer);
    
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }



/**************************************
/**   validating Osn, Pin Code        *
/**   and update transaction number   *
/**************************************/
public function actionLogin(){

try {
$this->layout = 'main-login';
$model = new AppLoginForm();
$validate=new Validate();

if ($model->load(Yii::$app->request->post()) && $model->login()){

   $year=TblAcadamicYear::find()->where(['status'=>1])->one()->academic_year;
   
   Yii::$app->session->set('academic_year',$year);
   Yii::$app->session->set('osn', Yii::$app->user->identity->id??'');
     return $this->redirect(['application']);

} 

$model->password='';

}catch (\Exception $e){

    return $this->redirect(['login']);

//   return  Yii::$app->session->setFlash('success', $e->getMessage());

}

return $this->render('login',[
'model'=>$model,
]);


}



/* -------------------------------------------------------------------------- */
/*Saving  applicant personal information, address and photo                   */
/* -------------------------------------------------------------------------- */
// public function actionApplication()
// {
//     $this->layout = 'main-application';

//     $cleanup = new Validate();
//     $apps = new Validate2();

//     // Check if OSN exists
//     if (empty($apps->osnID())) {
//         return $this->redirect(['login']);
//     }

//     // If qualification is filled, redirect to next stage
//     if (!empty($apps->applicantQualification())) {
//         return $this->redirect(['/site/stages']);
//     }

//     try {
//         // Personal Details
//         $modelp = $apps->personalDetails() ?? new TblAppPersDetails();

        
//         // Personal Address
//         $modelad = $apps->personalAddress() ?? new TblAppAddress();

//         // On form submit
//         if ($modelp->load(Yii::$app->request->post())) {

            
            
//             $imageFile = UploadedFile::getInstance($modelp, 'photo');
//             $imagePath = $apps->applicantPhoto($imageFile, $modelp);

//             // Save to DB
//             $personalDetails = $apps->applicantDetails($modelp, $cleanup, $imagePath);
//             $personalAddress = $apps->applicantAddress($modelad, $cleanup);

//             $academicYear = TblAcademicYear::find()->where(['status' => 1])->one();

//             if ($personalDetails && $personalAddress && $academicYear) {
//                 $app = $apps->applicantMainTable() ?? new TblApp();
//                 $app->personal_details_id = $modelp->id;
//                 $app->personal_address_id = $modelad->id;
//                 $app->status = 2;
//                 $app->sms_1 = 1;
//                 $app->academic_year = $academicYear->id;
//                 $app->osn_id = $apps->osnID();
//                 $app->date = date('Y-m-d');
//                 $app->save();

//                 // Send SMS notification
//                 if ($app->sms_1 == 1) {
//                     $name = $apps->personalDetails()->first_name ?? '';
//                     $phone = $apps->personalAddress()->telephone_number ?? '';
//                     $sn = Yii::$app->user->identity->osn_number ?? '';

//                     $cleanup->sms($name, $phone, $sn);
//                 }

//                 Yii::$app->session->setFlash('success', 'Great! Your bio-data has been saved successfully. Now, continue by selecting your preferred program.');
//                 return $this->redirect(['program']);
//             }
//         }

//         // Optionally pre-fill details for known students
//         if (Yii::$app->user->identity->studentID !== null) {
//             $old_student_details = []; // Fetch from USIS or other source
//             // You may populate $modelp and $modelad here if needed
//         }

//         return $this->render('application', [
//             'modelp' => $modelp,
//             'modelad' => $modelad,
//         ]);
//     } catch (\Throwable $e) {
//         Yii::$app->session->setFlash('error', 'Something went wrong: ' . $e->getMessage());
//         return $this->goBack(Yii::$app->request->referrer);
//     }
// }

public  function  actionApplication(){

        $this->layout = 'main-application'; 
        $cleanup=new Validate();
        $apps=new Validate2();

    if (!empty($apps->osnID()))
    {
        if(!empty($apps->applicantQualification())){

            return $this->redirect(['/site/stages']);

        }else{

        try{

            if (!empty($per=$apps->personalDetails()))
            {
                $modelp=$per;
            }else 
            {
                $modelp  = new TblAppPersDetails();
            }

            if (!empty($ad=$apps->personalAddress()))
            {
                $modelad =$ad;
            }else 
            {
                $modelad = new TblAppAddress();
            }

            if ($modelp->load(Yii::$app->request->post())){

                // Save Applicant Photo
                $imageFile = UploadedFile::getInstance($modelp, 'photo');
                // Store Images
                $imagefiles= $apps->applicantPhoto($imageFile,$modelp);
                //saving to personal details tabel

               $personalDetails= $apps->applicantDetails($modelp,$cleanup,$imagefiles);

                //saving to personal address tab
                $personalAddress= $apps->applicantAddress($modelad,$cleanup);
                
                //Academic Year to the Database
                $academic_year_id= TblAcademicYear::find()->where(['status'=>1])->one()->id;

                if ($personalDetails !==null && $personalAddress !==null){
                    if($app_old=$apps->applicantMainTable()){
                        $app=$app_old;
                    }else{
                        $app=new TblApp();
                    }
                    // $app=new TblApp();
                    $app->personal_details_id=$modelp->id;
                    $app->personal_address_id=$modelad->id;
                    $app->status=2;
                    $app->sms_1=1;
                    $app->academic_year=$academic_year_id;
                    $app->osn_id=$apps->osnID();
                    $app->date = date('Y-m-d');
                    $app->save();
                    if($app->sms_1==1)
                    {
                    //Application First stages 
                     $sn=  Yii::$app->user->identity->osn_number??'';

                    $cleanup->sms($apps->personalDetails()->first_name,$apps->personalAddress()->telephone_number,$sn);
                    }
                
                    Yii::$app->session->setFlash('success', 'Successfully Saved');
                    return $this->redirect(['program']);
                }
            }      




            if(Yii::$app->user->identity->studentID !==null){
                $old_student_details =[];
                //  $cleanup->usis_student(Yii::$app->user->identity->studentID);
            }
            
            $osnid=[];
            // TblOsn::find()->where(['id'=>Yii::$app->user->identity->id])->one();

            //  $modelp->first_name= $old_student_details['data']['firstname'];
            //  $modelp->middle_name= $old_student_details['data']['midname'];
            //  $modelp->last_name= $old_student_details['data']['lastname'];
            //  $modelp->gender=strtolower($old_student_details['data']['stud_gender']);
            //  $modelad->email=$old_student_details['data']['stud_email'];
            //  $modelad->telephone_number= $old_student_details['data']['stud_tel_num']??$modelad->telephone_number;

            return $this->render('application',[
                'modelp' => $modelp,
                'modelad' => $modelad,
                // 'old_student_details'=>$old_student_details??'',
                // 'user'=>$osnid,
            ]);
        }catch(Exception $e)
        {

            Yii::$app->session->setFlash('error', $e->getMessage());
            return  $this->goBack(Yii::$app->request->referrer);
            // return $this->redirect(['application']);
        }
    }
    }else{
        return $this->redirect(['login']);
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
    $apps = new Validate2();

    

    // Check if user has OSN ID
    if (empty($apps->osnID())) {
        return $this->redirect(['login']);
    }

    $applicant = $apps->applicantMainTable();

    // Check if applicant has personal details and has NOT filled qualification
    if (!empty($applicant->personal_details_id) && !$apps->applicantQualification()) {
        $model = new TblProgramType();

        try {
            if ($model->load(Yii::$app->request->post())) {
                $selectedCategoryId = $_POST['TblProgramType']['name'] ?? null;

                $programs = TblProgram::find()
                    ->where(['program_category_id' => $selectedCategoryId])
                    ->all();

                return $this->render('program', [
                    'model' => $model,
                    'program' => $programs,
                    'application' => $apps->applicantQualification(),
                ]);
            }
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('error', 'Error loading program options.');
            return $this->redirect(['program']);
        }

        // Initial load or no post data yet
        return $this->render('program', [
            'model' => $model,
            'program' => [],
            'application' => $apps->applicantQualification(),
        ]);
    }

    // If condition not met, redirect to application page
    return $this->redirect(['/site/application']);
}

// public function actionProgram(){
// $this->layout = 'main-application';
// $apps=new Validate2();
// if (!empty($apps->osnID())) {
    
//     if(!empty($apps->applicantMainTable()->personal_details_id) && $apps->applicantQualification()==false){

// try{
//         $model= new TblProgramType();
        
//     if ($model->load(Yii::$app->request->post())) {

//         $program=TblProgram::find()->where(['program_category_id'=>$_POST['TblProgramType']['name']])->all();

//             return $this->render('program', [
//                 'model' => $model,
//                 'program'=>$program,
//                 'application'=>$apps->applicantQualification(),
//             ]);
//     }
// }catch(Exception $e){
//     return $this->redirect(['program']);
// }

// return $this->render('program', [
//     'model' => $model,
//     'program'=>$_POST['TblProgramType']['name']??'',
// ]);
//     }else{

//         return $this->redirect(['/site/application']);
//     }

// }else{
//  return $this->redirect(['login']);
// }
// }



/* -------------------------------------------------------------------------- */
/*  Step two of the program applying for                                     */
/* -------------------------------------------------------------------------- */
public function actionCourses(){ 
    $apps=new Validate2();
    if (!empty($apps->osnID())) {
            try{
                if (isset($_POST['program'])){
                    if (!empty($programs=TblAppProgram::find()->where(['osn_id'=>$apps->osnID()])->one())){
                        $program=$programs;
                    }else {
                        $program=new TblAppProgram();
                    }
                    $program->tbl_program= $_POST['program'];
                    $program->osn_id=$apps->osnID();
                if($program->save())
                {
                    $app=TblApp::find()->where(['osn_id'=>$apps->osnID()])->one();
                    if(!empty($app))
                    {
                        $app->program_id = $program->id;
                        $app->status = $app->status;
                        $app->osn_id = $app->osn_id;
                        $app->save();
                    }
                    Yii::$app->session->set('program', $program->id);
                    Yii::$app->session->setFlash("success", "Program selected successfully. Click 'Next' to proceed with your educational background.");
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
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['program']);
            }

    }else{
        return $this->redirect(['login']);
    }
}




// Remove selected courses
public function actionRemove(){
// $this->layout = 'main-application';
$this->layout = 'main-login2'; 


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
return $this->redirect(['login']);
}
}

//Save or Store Applicant Educational Details
// public function actionEducation(){

// $this->layout = 'main-application';
// // $this->layout = 'main-login2'; 

// $apps = new Validate2();

// if (!empty($apps->osnID()))
// {
//     if(!empty($apps->applicantMainTable()->program_id) && $apps->applicantQualification() ==false){
//      try{

//          $cleanup=new Validate();

//         if (!empty($ed=$apps->applicantEducation())){

//             $model=$ed;

//         }else {
//             $model = new TblAppEduBg();
//         }
//     if ($model->load(Yii::$app->request->post()))
//      {
//         $model['osn_id']=$apps->osnID()??'';
//         $model['institution']=$cleanup->check2($_POST['TblAppEduBg']['institution']);    
//         $model['program_offered']= $cleanup->check2($_POST['TblAppEduBg']['program_offered']); 

//          if ($model->save()) 
//         {
//            $edu=$apps->applicantMainTable();

//             if($edu !=null){
//                 $edu['personal_education_id']=$model->id;
//                 $edu->save();
//             }

//             Yii::$app->session->set('education', $model->id);
//             Yii::$app->session->setFlash('success', 'Successfully Saved');

//             return $this->redirect(['site/employment']);

//         }
//         elseif (!$model->save())
//         {
//                 // Yii::$app->session->setFlash('error', 'Step Four Already Saved');

//                 return $this->redirect(['/site/employment']);
//         }
//     }

//     if(Yii::$app->user->identity->studentID !==null){
//         $old_student_details = $cleanup->usis_student(Yii::$app->user->identity->studentID);
//     }

//     return $this->render('education', [
//         'model' => $model,
//         'program'=>$old_student_details['data']['program']??'',
//     ]);

//     }catch(Exception $e){

//         // Yii::$app->session->setFlash('error', 'Error!! something went wrong'.$e->getMessage());

//         return $this->redirect(['education']);
//     }
//    }else{
//         return  $this->redirect(['site/program']);
//     }

// }else{
//     return $this->redirect(['login']);
// }
// }

public function actionEducation()
{
    $this->layout = 'main-application';
    $apps = new Validate2();

    if (empty($apps->osnID())) {
        return $this->redirect(['login']);
    }

    $applicant = $apps->applicantMainTable();

    if (empty($applicant->program_id) || $apps->applicantQualification()) {
        return $this->redirect(['site/program']);
    }

    try {
        $cleanup = new Validate();
        $model = $apps->applicantEducation() ?? new TblAppEduBg();

        if ($model->load(Yii::$app->request->post())) {
            $model->osn_id = $apps->osnID();
            $model->institution = $cleanup->check2($_POST['TblAppEduBg']['institution']);
            $model->program_offered = $cleanup->check2($_POST['TblAppEduBg']['program_offered']);

            if ($model->save()) {
                // Attach to main application table
                $applicant->personal_education_id = $model->id;
                $applicant->save(false); // skip validation if already handled

                Yii::$app->session->set('education', $model->id);
                Yii::$app->session->setFlash('success', "Educational background information saved successfully.Please provide your current employment history to proceed");

                return $this->redirect(['site/employment']);
            } else {
                Yii::$app->session->setFlash('error', 'Unable to save education details.');
                return $this->redirect(['site/employment']);
            }
        }

        // Handle USIS student data (if needed)
        $program = '';
        if (!empty(Yii::$app->user->identity->studentID)) {
            $oldStudent = $cleanup->usis_student(Yii::$app->user->identity->studentID);
            $program = $oldStudent['data']['program'] ?? '';
        }

        Yii::$app->session->setFlash("success", "You’re now in the Educational Background section. Please provide your academic history to proceed.");
        return $this->render('education', [
            'model' => $model,
            'program' => $program,
        ]);
    } catch (\Throwable $e) {
        Yii::$app->session->setFlash('error', 'Something went wrong');
        return $this->redirect(['education']);
    }
}


// public function actionEmployment(){

// $this->layout = 'main-application';
// // $this->layout = 'main-login2'; 

// $apps = new validate2();
// if (!empty($apps->osnID())) {
//     if(!empty($apps->applicantMainTable()->personal_education_id) && $apps->applicantQualification()==false){
//     try{
//         if (!empty($em=$apps->applicantEmployment())){
//             $model=$em;
//         }else {
//             $model = new TblAppEmpDetails();
//         }
//         if ($model->load(Yii::$app->request->post())) {
//             $model->osn_id=$apps->osnID();
//             if ($model->save()){
//                 $edu=$apps->applicantMainTable();
//                 $edu->personal_employment_id=$model->id;
//                 $edu->save();
//                 Yii::$app->session->set('employment', $model->id);
//                 Yii::$app->session->setFlash('success', 'Successfully Saved');
//             }elseif (!$model->save()){
//                     Yii::$app->session->setFlash('error', 'Step Three Already Saved');
//             }

//             return $this->redirect(['document']);
//         }
//         return $this->render('employment', [
//             'model' => $model,
//         ]);

//     }catch(Exception $e){
//         Yii::$app->session->setFlash('error', $e->getMessage());
//         return $this->redirect(['employment']);
//     }
//   }else{
//         return $this->redirect(['education']);
//     }
    
// }else{
//     return $this->redirect(['login']);
// }
// }

public function actionEmployment()
{
    $this->layout = 'main-application';
    $apps = new Validate2();

    if (empty($apps->osnID())) {
        return $this->redirect(['login']);
    }

    $applicant = $apps->applicantMainTable();

    if (empty($applicant->personal_education_id) || $apps->applicantQualification()) {
        return $this->redirect(['education']);
    }

    try {
        $model = $apps->applicantEmployment() ?? new TblAppEmpDetails();

        if ($model->load(Yii::$app->request->post())) {
            $model->osn_id = $apps->osnID();

            if ($model->save()) {
                $applicant->personal_employment_id = $model->id;
                $applicant->save(false); // safe to skip validation

                Yii::$app->session->set('employment', $model->id);
                Yii::$app->session->setFlash('success', "Your employment information has been saved successfully. Please click 'Next' to proceed to the Supporting Documents section.");
            } else {
                Yii::$app->session->setFlash('error', 'Unable to save employment details.');
            }

            return $this->redirect(['document']);
        }

        return $this->render('employment', [
            'model' => $model,
        ]);
    } catch (\Throwable $e) {
        Yii::$app->session->setFlash('error', 'Something went wrong: ' . $e->getMessage());
        return $this->redirect(['employment']);
    }
}



public function actionDocument(){
        $this->layout = 'main-application'; 

        $apps = new Validate2();

    if (!empty($apps->osnID())) {

        if(!empty($apps->applicantMainTable()->personal_employment_id) && $apps->applicantQualification() ==false){
              try{
                      $model=new  TblAppDocument();
                      $document_upload=new Validate();
                      $doc=TblAppDocument::find()->where(['personalDetail_id'=>$apps->applicantMainTable()->personal_details_id]);

                      //Get user index number
                      $user_index_number=TblOsn::find()->where(['id'=>$apps->osnID()])->one();


                    if ($model->load( Yii::$app->request->post()))
                     {                     
                            $imageFile=UploadedFile::getInstance($model, 'doc_name');
                            $fileName=$_POST['TblAppDocument']['category'];
                            $application_year=date('Y');
                            $student_category='Professional';
                            $foldername=$user_index_number->osn_number;
                            $filename=$fileName;
                            $filetype = $imageFile->type;
                            $filedata = $imageFile->tempName;
                            $doc_upload_status =$document_upload->uploadFile($application_year, $student_category,$foldername,$filename,$filetype,$filedata);
                            
                            // dd($doc_upload_status);die;
                            
                            // dd($doc_upload_status);die;
                            if($doc_upload_status){

                                $model->doc_name=$_POST['TblAppDocument']['category'];
                                $model->category=$user_index_number->osn_number.'_'.'IPS'.'_'.$_POST['category_name'];
                                $model->personalDetail_id=$apps->applicantMainTable()->personal_details_id;

                               if($model->save()){        
                                if($doc->count() >=3){

                                    $update_document= $apps->applicantMainTable();
                                    $update_document->personal_document_id=$apps->applicantMainTable()->personal_details_id;
                                    $update_document->status=1;
                                    $update_document->sms_2=1;
                                    $update_document->save();

                                    //Application final sms
                                    $sn= Yii::$app->session->get('sn');
                                    $p= Yii::$app->session->get('pin');
                                    // $document_upload->sms2($apps->personalDetails()->first_name,$apps->personalAddress()->telephone_number,$sn,$p);

                                    // return $this->redirect(['declaration']);
                                    // Yii::$app->session->setFlash('success', 'Successfully Uploaded');
                                }
                                    Yii::$app->session->setFlash('success', 'Successfully Uploaded');

                                    return $this->redirect(['document']);
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
        return $this->redirect(['login']);
    }
}




public function actionDelete($id){

    $apps = new Validate2();

    $app_remove=TblAppDocument::find()->where(['id'=>$id])->andWhere(['personalDetail_id'=>$apps->applicantMainTable()->personal_details_id])->one();
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
$apps = new Validate2();

if(!empty($apps->osnID())) {

    if(!empty($apps->applicantMainTable()->personal_document_id) && (empty($apps->applicantQualification()))){

    try{

      $applications=TblApp::find()->where(['osn_id'=>$apps->osnID()])->one();
      
      $declaration=TblDeclaration::find()->all();

         if($applications !==null){

            return $this->render('declaration', [ 'personal' => $applications,'declaration'=>$declaration]);

        }else{
            
            // Yii::$app->session->setFlash('error', 'You not nomplete all The Steps');
            return $this->redirect(['document']);
        }

    }catch(Exception $e){
        // return $this->redirect(['document']);
    }

    return $this->render('declaration', [ 'personal' => $applications]);

 }else{

    return $this->redirect(['/site/document']);
 }

 }else{
    return $this->redirect(['login']);
  }
}



public function actionStages(){
    $this->layout = 'main-application';

    $apps = new Validate2();
    if (!empty($apps->osnID())) {
        if(!empty($apps->applicantQualification())){
    try{
    $quali = TblAppQuali::find()->where(['application_id'=>$apps->applicantMainTable()->id])->where(['status'=>[1]])->one();
    $admiss = TblAppAdmission::find()->where(['application_id'=>$apps->applicantMainTable()->id])->one();

    return $this->render('stages',[
        'app'=>$apps->applicantMainTable()->status===3? 'Applied':'Pending',
        'quali'=>$quali->status0->name?? 'Pending',
        'admiss'=>$admiss->status0->name?? "Pending"
    ]);

 }catch(Exception $e){}

}else{

    return $this->redirect(['application']);
}
}else{
    return $this->redirect(['login']);
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
    ]);

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


public function actionReport() 
{
       $apps = new Validate2();
    if (!empty($apps->osnID())) {

    $perId=$apps->personalDetails()->id??'';
    // Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
    $personal= TblApp::find()->where(['personal_details_id'=>$perId])->one();
    // $declaration=TblDeclaration::find()->all();
    // var_dump($personal->personalDetails->photo);die;
    $logo=Yii::$app->params['logo'];
    $logo2='application/images/'.$personal->personalDetails->photo??'';
    // Yii::getAlias('@applications').'/application/images/'.($personal->personalDetails->first_name->photo??'')
    $content=$this->renderPartial('_declaration',['personal'=>$personal, 'logo' =>$logo,'userLogo'=>  $logo2 ]);

    Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE, 
        'destination' => Pdf::DEST_BROWSER,
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'content' => $content,

        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',


        // 'cssInline' => '.kv-heading-1{font-size:18px}',
     
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

}else{
    return $this->redirect(['login']);
}

}


public function actionExit()
{
    $apps = new Validate2();
if (!empty($apps->osnID())) {
$this->layout = 'main-login';
Yii::$app->user->logout();
Yii::$app->getSession()->destroy();
Yii::$app->cache->flush();

return $this->redirect(['login']);

}else{
    return $this->redirect(['login']);
}
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
    $this->layout = 'main-application';
    
        //Access Programme
        // if($admission->application->program->program->programCategory->id===2){

        //     $content=$this->renderPartial('_access',['admission'=>$admission, 'image'=>$image, 'logo'=>$logo,'validate'=>$validate]);
    
            //Professional Programme
        // }elseif($admission->application->program->program->programCategory->id===1){
    
            // $content=$this->renderPartial('_professional',['admission'=>$admission, 'image'=>$image, 'logo'=>$logo,'validate'=>$validate]);
        // }
    $apps = new Validate2();

    if (!empty($apps->osnID())){
    $validate=new Validate();
    $admission=TblAppAdmission::findOne(['application_id'=>$apps->applicantMainTable()->id]);

    $logo=Yii::$app->params['logo'];
    $signature=Yii::$app->params['signature'];
    $image = 'application/images/' . ($apps->applicantMainTable()->personalDetails->photo ?? '');

    $photo = $apps->applicantMainTable()->personalDetails->photo ?? '';
    $image = 'application/images/' . $photo;

    Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

    $content=$this->renderPartial('_professional',['admission'=>$admission, 'image'=>$image, 'logo'=>$logo,'validate'=>$validate,'signature'=>$signature]);

    $pdf = new Pdf([
        'mode' => Pdf::MODE_CORE,
        'destination' => Pdf::DEST_BROWSER,
        'destination' => Pdf::DEST_BROWSER,
        'format' => Pdf::FORMAT_A4,
        'orientation' => Pdf::ORIENT_PORTRAIT,
        'content' => $content,
        'methods' => [
            'SetTitle' => 'Institute Of Professional Studies',
            'SetSubject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
            // 'setIcom'=>'/images/download.jpg',
            // 'SetHeader' => ['Institute Of Professional Studies||Generated On: ' . date("r")],
            // 'SetFooter' => ['|Page {PAGENO}|'],
            'SetAuthor' => 'Kartik Visweswaran',
            'SetCreator' => 'Kartik Visweswaran',
            'SetKeywords' => 'Krajee, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
        ]
    ]);
    return $pdf->render();

}else{
    return $this->redirect(['login']);
}
}

}