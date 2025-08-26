<?php

namespace app\models;

use Exception;
use Gitplus\PayFluid\CustomerInput;
use Gitplus\PayFluid\Customization;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use Gitplus\PayFluid\PayFluid;
use Gitplus\PayFluid\Payment;
use InvalidArgumentException;
use yii\web\HttpException;

class Validate2
{

/**************************************
/**   Applicant OSN ID                *
/**************************************/

// public function osnID(){

//     //$osn=Yii::$app->session->get('osn')

//   if(!empty($osn=Yii::$app->user->identity->id??'')){
//    return $osn;
//   }
  
//   }


public function osnID() {
    $osn = Yii::$app->user->identity->id ?? null;

    if (!empty($osn)) {
        return $osn;
    }

    return null; // Explicitly return null if $osn is empty
}


  public function studID(){
    
    // Yii::$app->session->get('studentID')
    if(($studId=Yii::$app->user->identity->studentID) !==null){
    return $studId;
    }
    // throw new HttpException('Error with your osn');
    }

 

/**************************************
/**   Applicant Index number          *
/**************************************/

    public function student_index_number(){
        $year = date('Y');
        $month = date('m');
        $day = date('d');
    
        $y=array_sum(str_split($year));
    
        $m=array_sum(str_split($month));
    
        $d=array_sum(str_split($day));
       
        $rand = rand(1231,9999);
       
        $index = ($y.$d.$m.$rand.$d);
    
       return $index;
    }
  
  
  /**************************************
  /** Fetch Personal ID With OSN ID     *
  /**************************************/
  
  public function personalDetails(){
  if(($model=TblAppPersDetails::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
  return $model;
  }
  // throw new HttpException('Error Fetching Data');
  }
  
  /**************************************
  /**   Fetch Personal Address          *
  /**************************************/
  
  public function personalAddress(){
  if(($model=TblAppAddress::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
      return $model;
  }
  // throw new HttpException('Error Fetching Data');
  }
  
  
  /**************************************
  /**   Get Applicant ID                *
  /**************************************/
   public function applicantMainTable(){
    
  
      if(($model=TblApp::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
          return $model;
      }
  }
  
  
  /**************************************
  /**   Get Applicant's Educational ID  *
  /**************************************/
  public  function  applicantEducation(){
  
  if(($model=TblAppEduBg::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
  
  return $model;
  }
  }
  
  
  /**************************************
  /** Get Applicant Employment ID       *
  /**************************************/
  public function  applicantEmployment(){
  if(($model=TblAppEmpDetails::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
  return $model;
  }
  }
  
  
  /**************************************
  /** Get Applicant Employment ID       *
  /**************************************/
  public function  applicantQualification(){

      if(($model=TblAppQuali::find()->where(['application_id'=>$this->applicantMainTable()->id??''])->one()) !==null){
        
      if(!empty($model->id)){
          return true;
      }else{
          return false;
      }
      }
      }
  
  
  /**************************************
  /** Get Applicant Program ID          *
  /**************************************/
  public function applicantPrograms(){
  if(($model=TblAppProgram::find()->where(['osn_id'=>$this->osnID()])->one()) !==null){
  return  $model;
  }
  throw new NotFoundHttpException('The requested page does not exist.');
  }
  
  public function applicantCourse($program){
  
  if(($program=TblProgram::find()->where(['program_category_id' => $program])->all()) !==null){
  
  return $program;
  }
  }
  
  /* -------------------------------------------------------------------------- */
  /*      Saving Applicant's Personal Details                                   */
  /* -------------------------------------------------------------------------- */
  
  public function applicantDetails($modelp,$cleanup,$photo){

   $oldphoto = $this->personalDetails()->photo??'';
// Yii::$app->user->identity->id??''
  $modelp->title = $cleanup->check_only_int($_POST['TblAppPersDetails']['title']);
  $modelp->last_name = $cleanup->replace2($_POST['TblAppPersDetails']['last_name']);
  $modelp->first_name = $cleanup->replace2($_POST['TblAppPersDetails']['first_name']);
  $modelp->middle_name = $cleanup->replace2($_POST['TblAppPersDetails']['middle_name']);
  $modelp->gender =   $cleanup->replace($_POST['TblAppPersDetails']['gender']);
  $modelp->date_of_birth =$cleanup->replace($_POST['TblAppPersDetails']['date_of_birth']);
  $modelp->nationality = $cleanup->replace2($_POST['TblAppPersDetails']['nationality']);
  $modelp->contact_person =$cleanup->replace2($_POST['TblAppPersDetails']['contact_person']);
  $modelp->contact_number = $cleanup->check_only_int($_POST['TblAppPersDetails']['contact_number']);
  $modelp->osn_id = $this->osnID()??'';
  $modelp->date_apply = date('Y-m-d');
  $modelp->photo = $photo ==""?  $oldphoto: $photo;
  if($modelp->save()){
  return $modelp->id;
  }
  
  }
  
  /* -------------------------------------------------------------------------- */
  /*    Saving Applicant's Personal Address                                     */
  /* -------------------------------------------------------------------------- */
  public function applicantAddress($modelad, $cleanup){
  $modelad->address = $cleanup->check($_POST['TblAppAddress']['address']);
  $modelad->city = $cleanup->replace2($_POST['TblAppAddress']['city']);
  $modelad->country = $cleanup->replace2($_POST['TblAppAddress']['country']);
  $modelad->voters_id = $cleanup->replace2($_POST['TblAppAddress']['voters_id']);
  $modelad->voters_id_type = $cleanup->replace2($_POST['TblAppAddress']['voters_id_type']);
  $modelad->gps = $cleanup->replace2($_POST['TblAppAddress']['gps']);
  $modelad->email = $cleanup->filter_mail($_POST['TblAppAddress']['email']);
  $modelad->telephone_number = $cleanup->check_only_int($_POST['TblAppAddress']['telephone_number']);
  $modelad->osn_id = $this->osnID();
  $modelad->save();
  if(!empty($modelad->id)){
  return $modelad->id;
  }
  
  
  return  $modelad->id;
  
  }
  
  /* -------------------------------------------------------------------------- */
  /*   Saving Applicant's Personal Photo                                        */
  /* -------------------------------------------------------------------------- */
  
  public  function applicantPhoto($imageFile,$modelp){
  
  if(isset($imageFile->size)){

  if(!file_exists(Url::to('application/images/'))){
      mkdir(Url::to('application/images/'),0777,true);
  }
  $fileName=time().''.$imageFile->baseName.'.'.$imageFile->extension;
  $imageName=Url::to('application/images/').$fileName;

  $imageFile->saveAs($imageName);

  $modelp->photo = $fileName?? $modelp->photo;
  
  return $fileName;
  }
  
  }
  
  
  /* -------------------------------------------------------------------------- */
  /* Saving Applicant's Personal Documents                                      */
  /* -------------------------------------------------------------------------- */
  public function applicantDocument($imageFile){
//   $modeld = new \stdClass();
//   $modeld->success = false; 
  
  if(isset($imageFile)){
  if(!file_exists(Url::to('application/documents/'))){
      mkdir(Url::to('application/documents'),0777,true);
  }
  foreach ($imageFile as $name){
      $modeld=new  TblAppDocument();
      $fileName= time().''.$name->baseName.'.'.$name->extension; 
      $modeld->doc_name=$fileName;
      $modeld->personalDetail_id = Yii::$app->session->get('person');
      $modeld->osn_id=$this->osnID();  
      $imageName=Url::to('application/documents/').$fileName;
      $name->saveAs($imageName);
      $modeld->save();
  }
  return $modeld->id;
  }
  }




  public function transaction($user_id, $tnx_ref,$amount,$number, $link, $txn_sess ){

    $trans= new TblTransaction();
    $trans->user_id=$user_id; 
    $trans->txn_ref= $tnx_ref;
    $trans->txn_amt=$amount;
    $trans->txn_sess=$txn_sess;
    // $trans->txn_currency='ghs';
    // $trans->txn_sc='1';
    // $trans->txn_sc_msg='1';
    $trans->txn_payLink=$link;
    // $trans->txn_otherInfo='1';
    $trans->txn_number=$number;
    // $trans->txn_maskedInstr='1';
    // $trans->txn_cref='1';
    return $trans->save();


}


public function payment2($user_id,$amount, $phoneNumber, $email,$app_name){


try {    

    $testOrLiveMode='';
    $encryptionKey='MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAI8LN/AC3XOz23O7v/de/jbYFQYrbeFqQVaIYpFRIR+YSCWfHlcl3PNKy7Vniq+rWG8KPN8uw2RUU/1qvoZP3xsCAwEAAQ==';

    $apiKey='781e5e245d69b566979b86e28d23f2c7';

    $clientId='04040405';

    //25580774744,
    $phoneNumber='0249577997';

    $email=$email;
    $name=$app_name;

    $ref= bin2hex(random_bytes(5));
    // $amount=$amount;

    // Create a new customization object.
    $customization = new Customization();
    $customization->editAmount(true)            // The payment amount can be edited by the user
        ->minimumAmount($amount)                    // Enforce the minimum amount to pay
        ->maximumAmount(30.0)                   // Enforce the maximum amount to pay
        ->borderTheme("#a3ffee")                // Set a color for the page
        ->receiptMessage("Thank you for your purchase")    // Override the message sent in receipt
        ->receiptFeedbackPhone($phoneNumber)               // Override the phone number that gets the receipt
        ->receiptFeedbackEmail($email)          // Override the email that receives the receipt
        ->daysUntilLinkExpires(1)                          // Determine how long the payment link should be valid for
        ->canPayMultipleTimes(true)                        // Payment links are one time. This will make the link reusable
        ->displayPicture("http://localhost:8080/images/upsa4.jpg");  // Set your own image to be displayed on the payment page.
        
    // You can take your customization further.
    // PayFluid gives you the flexibility to even ask for more information on the
    // payment page. You do this by creating input fields. The fields will be
    // rendered on the payment page for the customer to provide answers to.
    // To achieve this you need to create CustomerInput objects and add
    // them to your customization object.
    
    // Create your first input. This will be a text input.
    $textInput = new CustomerInput();
    $textInput->label("Church Membership ID") // The label for the input
        ->placeholder("Membership ID #")      // The placeholder for the input
        ->type(CustomerInput::TYPE_TEXT)      // The type of input
        ->required(true);                     // Indicate whether the input is required or not.
        
    // Create another input but this time it will be a select dropdown.
    $selectInput = new CustomerInput();
    $selectInput->label("Offering Type")      // Label for the input field
        ->placeholder("Offering Type 2")      // Placeholder value for the field
        ->type(CustomerInput::TYPE_SELECT)    // Set the input as a select dropdown
        ->setOption("key", "value")           // Set the options that will be in the dropdown               
        ->setOption("key2", "value2");        // You can set more options for the dropdown
      
    // Add your inputs to your customization object
    $customization
        ->withCustomerInput($textInput)
        ->withCustomerInput($selectInput);
     
    // Now create a payment object and customize it with the customization.
    $payment = new Payment();
    $payment->amount(1.0)
        ->email($email)
        ->phone($phoneNumber)
        ->name($name)
        ->reference(bin2hex(random_bytes(5)))
        ->description("Application Fee")
        ->redirectUrl("http://localhost:8080/index.php?r=site/about")
        ->callbackUrl("https://webhook.site/13facaad-189b-4570-ae18-44894665691e")
        ->otherInfo("Any extra information")
        ->customize($customization);    // Add the customization you created
    
    // Create the PayFluid client instance.
     $payfluid = new PayFluid($clientId, $encryptionKey, $apiKey, $testOrLiveMode);
    
    // Generate credentials.
    // Remember the returned $credentials object here has your session value.
    // It is a good idea to store this value because you will need it to verify payments later.
    $credentials = $payfluid->getSecureCredentials($phoneNumber);

    // Get payment link.
    // Again the $paymentLink also has both your 'session' and 'payReference' values.
    // You will need them later for verification.
    $paymentLink = $payfluid->getPaymentLink($credentials, $payment);

   
    
    // Redirect the user to your customized payment page.
  return  $paymentLink->webUrl;die;
} catch (\Throwable $e) {
    // Handle error
    echo "Generating payment url failed: " . $e->getMessage();
}

}




  public function payment($user_id,$amount, $phoneNumber, $email,$app_name){

    /////////////////////////////////////////
    try {

    $testOrLiveMode='live';
    // $encryptionKey='MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAI8LN/AC3XOz23O7v/de/jbYFQYrbeFqQVaIYpFRIR+YSCWfHlcl3PNKy7Vniq+rWG8KPN8uw2RUU/1qvoZP3xsCAwEAAQ==';
    $encryptionKey='MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCKavSyT3xaESTqCAL8KP5OpmzkItn57bkyF5HzjFLE3WjY7VP4yziUDkQe9IjrUxx0iz59aBaGsfNPvsO8OdUSu16n4yCuOmDHH3Zx1Pz6jvLY9qgnKPpeigI41C8PtGwZX0a8j5dZ+jx3zVIRk+4JOULnh+cv2ovUGb+u2pYc5QIDAQAB';

    // $apiKey='781e5e245d69b566979b86e28d23f2c7';
    $apiKey='c5de8002e98dbe80aede95ec565680f2';

    // $clientId='04040405';
    $clientId='55760953';
    // '04040405';

    //25580774744,
    $phoneNumber=$phoneNumber;

    $email=$email;
    $name=$app_name;

    $ref= bin2hex(random_bytes(5));
    // $amount=$amount;

        // Create a new PayFluid client instance. The fourth(4th) parameter is
        // a boolean that indicates whether you are in live or test mode.
        // 'TRUE' for live mode, 'FALSE' for test mode.
    $payfluid = new PayFluid($clientId, $encryptionKey, $apiKey, $testOrLiveMode);
        
        // Get secure credentials to authenticate with the server.
        // The returned $credentials object here has your 'session' value.
        // It is a good idea to store it for later. You will need it to verify payments.
    $credentials = $payfluid->getSecureCredentials($phoneNumber);

    $customization = new Customization();
    $customization
        ->editAmount(true)            // The payment amount can be edited by the user
        ->minimumAmount($amount)                    // Enforce the minimum amount to pay
        ->maximumAmount(300.0)                   // Enforce the maximum amount to pay
        ->borderTheme("#a3ffee")                // Set a color for the page
        ->receiptMessage("Thank you for your purchase")    // Override the message sent in receipt
        ->receiptFeedbackPhone($phoneNumber)               // Override the phone number that gets the receipt
        ->receiptFeedbackEmail($email)          // Override the email that receives the receipt
        ->daysUntilLinkExpires(1)                          // Determine how long the payment link should be valid for
        ->canPayMultipleTimes(true)                        // Payment links are one time. This will make the link reusable
        ->displayPicture("https://uips.upsasys.com/applications/images/upsa4.jpg"); 

        //  ->displayPicture("http://localhost:8888/applications/images/upsa4.jpg"); 
           // Create your first input. This will be a text input.
    $textInput = new CustomerInput();
    $textInput->label("Church Membership ID") // The label for the input
        ->placeholder("Membership ID #")      // The placeholder for the input
        ->type(CustomerInput::TYPE_TEXT)      // The type of input
        ->required(true);                     // Indicate whether the input is required or not.
        
    // Create another input but this time it will be a select dropdown.
    $selectInput = new CustomerInput();
    $selectInput->label("Offering Type")      // Label for the input field
        ->placeholder("Offering Type 2")      // Placeholder value for the field
        ->type(CustomerInput::TYPE_SELECT)    // Set the input as a select dropdown
        ->setOption("key", "value")           // Set the options that will be in the dropdown               
        ->setOption("key2", "value2");        // You can set more options for the dropdown
      
    // Add your inputs to your customization object
    $customization
        ->withCustomerInput($textInput)
        ->withCustomerInput($selectInput);



        // Create a new payment object and set the required and any optional fields.
        // You can chain the methods.
        $payment = new Payment();
        $payment->amount($amount)                          // (Required) The amount to charge.
            ->email($email)                                 // (Required) Customer's email address.
            ->phone($phoneNumber)                           // (Required) Customer's phone number.
            ->name($name)                                   // (Required) Customer's name.
            ->reference($ref)           // (Required) A unique alphanumeric string; 10 characters max.
            ->redirectUrl("https://app.upsasys.com/index.php?r=site/status")
            ->currency("GHS")                               // (Required but ignorable) Currency for the payment. Defaults to "GHS".
            ->language("en")                                // (Required but ignorable) Language for payment page. Defaults to "en". Other values: "fr"
            ->description("Application Fee")      // (Optional) A description for the transaction; 40 characters max.
            ->callbackUrl('https://webhook.site/a030802c-6b58-4704-96c0-64abe19a2923')   // (Optional) This is your webhook.
            ->otherInfo("Any extra information");
            // ->customize($customization);


        $paymentLink = $payfluid->getPaymentLink($credentials,$payment);   

        if(!empty($paymentLink->webUrl)){

            $trans= $this->transaction($user_id, $ref, $amount,$phoneNumber,$paymentLink->payReference ,$credentials->session);

           if(!empty($trans)){

              return  $paymentLink->webUrl; 

           }
           return null;

        }

        return  null;
        
        // You can then retrieve the web url and redirect your user to that location.
        
        // NOTE:
        // The $paymentLink object will also have your 'session' and 'payReference' values.
        // It is a good idea to store these values for later. You will need them to
        // verify payments or to retrieve the status of a particular payment later.

    } catch (\Throwable $e) {
        // Handle error
        echo  $e->getMessage();
        // echo "Generating payment url failed: ";
    }
    ////////////////////////////////////////
}

public function paymentLink($paymentDetails){
    $payload = null;
    switch (true) {
        case is_string($paymentDetails):
            $payload = json_decode(urldecode($paymentDetails), true, 512, JSON_BIGINT_AS_STRING);
            if ($payload === null) {
                throw new Exception("verify transaction: error json decoding transaction details: " . json_last_error_msg());
            }
            break;

        case is_array($paymentDetails):
            $payload = $paymentDetails;
            break;

        default:
            throw new InvalidArgumentException("verify transaction: argument 1 must be either a valid JSON string or an array, you passed: " . gettype($paymentDetails));
    }

    if (!array_key_exists("aapf_txn_signature", $payload)) {
        throw new Exception("verify transaction: no signature found");
    }
    if (empty($payload["aapf_txn_signature"])) {
        throw new Exception("verify transaction: signature exists but it is an empty string");
    }

    $signatureFromRequest = $payload["aapf_txn_signature"];
    unset($payload["aapf_txn_signature"]);

    // $queryParams = join("", array_values($payload));
    // $calculatedSignature = hash_hmac("sha256", $queryParams, md5($session));
    // if (!hash_equals(strtoupper($calculatedSignature), strtoupper($signatureFromRequest))) {
    //     throw new Exception("verify transaction: signature is not valid");
    // }

     return $payload["aapf_txn_payLink"]; 




    //     $status = new PaymentStatus();
    //     $status->amount = $payload["aapf_txn_amt"];
    //     $status->redirectUrl = $payload["aapf_txn_clientRspRedirectURL"];
    //     $status->callbackUrl = $payload["aapf_txn_clientTxnWH"];
    //     $status->clientReference = $payload["aapf_txn_cref"];
    //     $status->currency = $payload["aapf_txn_currency"];
    //     $status->dateTime = $payload["aapf_txn_datetime"];
    //     $status->upStreamReference = $payload["aapf_txn_gw_ref"];
    //     $status->upStreamDebitStatus = $payload["aapf_txn_gw_sc"];
    //     $status->maskedInstrument = $payload["aapf_txn_maskedInstr"];
    //   return  $status->payReference = $payload["aapf_txn_payLink"];
    //     $status->payScheme = $payload["aapf_txn_payScheme"];
    //     $status->payFluidReference = $payload["aapf_txn_ref"];
    //     $status->statusCode = $payload["aapf_txn_sc"];
    //     $status->statusString = $payload["aapf_txn_sc_msg"];
    //     $status->signature = $signatureFromRequest;
    //     return $status;

        
}


//verifying transaction
public function signature($paymentDetails,$session){
    
    $payload = null;
    switch (true) {
        case is_string($paymentDetails):
            $payload = json_decode(urldecode($paymentDetails), true, 512, JSON_BIGINT_AS_STRING);
            if ($payload === null) {
                throw new Exception("verify transaction: error json decoding transaction details: " . json_last_error_msg());
            }
            break;

        case is_array($paymentDetails):
            $payload = $paymentDetails;
            break;

        default:
            throw new InvalidArgumentException("verify transaction: argument 1 must be either a valid JSON string or an array, you passed: " . gettype($paymentDetails));
    }

    if (!array_key_exists("aapf_txn_signature", $payload)) {
        throw new Exception("verify transaction: no signature found");
    }
    if (empty($payload["aapf_txn_signature"])) {
        throw new Exception("verify transaction: signature exists but it is an empty string");
    }

    $signatureFromRequest = $payload["aapf_txn_signature"];
    unset($payload["aapf_txn_signature"]);

      $queryParams = join("", array_values($payload));
    $calculatedSignature = hash_hmac("sha256", $queryParams, md5($session));
    if (!hash_equals(strtoupper($calculatedSignature), strtoupper($signatureFromRequest))) {
        throw new Exception("verify transaction: signature is not valid");
    }


}

  
  
  
    
 
  }
?>