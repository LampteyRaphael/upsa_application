<?php

namespace app\models;

use CURLFile;
use Exception;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class Validate
{
    
    public function check($data)
     {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return  ucwords(strtolower($data));
     }

     public function check2($data)
     {
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return  $data;
     }

     
    public function replace($string)
    {  
      $str = preg_replace('/[^a-zA-Z0-9-_\.]/','', trim($string));
      return trim($str);
    }

    public function replace2($string)
    {  
      $str = preg_replace('/[^a-zA-Z0-9-_\.]/','', $string);
      return ucwords($str);
    }


   public function filter_mail($string) 
   {
      return preg_replace('/[^A-Za-z0-9.@\-]/', '', $string); // We remove special chars and accept only Alphs&Nums&.&@
   }

    public function check_only_int($data)
    {
        $str= preg_replace('/[^0-9\.]/','', trim($data));
       return $str;
    }


    public function check_only_int2($data)
    {
        $str= preg_replace('/[^0-9]/','', trim($data));
       return $str;
    }

public function formatDate($date)
{
    if (!empty($date)) {
        return date("l, jS F Y", strtotime($date));
    }

    return '';
}

public function formateprograme($programm){
  return  ucwords(trim(preg_replace('/\s*PROGRAMME\s*$/i', '', $programm ?? '')));
}
    

    public function user_admission_migrate($password,$email,$role,$status,$fileName,$sid)
    {
      
      if(!empty($user1=User::find()->where(['email'=>$email])->one())){
        $user=$user1;
    }else{
        $user = new User();
    }

      $auth=new AuthAssignment();

      $password=$this->check_only_int($password);
      $SID=$sid;
      $user->photo = $fileName;
      $user->username=$SID;
      $user->email= $email;
      $user->role_id=$role;
      $user->password_hash = $user->setPasswords($this->check_only_int($password));
      $user->status = $status;
      $user->save();

      $auth['item_name']='student';
      $auth['user_id']=$user->id;
      if($auth->save())
      {
        Yii::$app->mailer->compose()
        ->setFrom(['ips.admin@upsamail.edu.gh'=>'UPSA'])
        ->setTo($email)
        ->setSubject('Congratulation! You have been  Admitted. Your Credentials For IPS Portal is below')
          ->setHtmlBody('Password:'.$password.' And Index Number is :'.$SID)
        ->send();
      }

      return $user->id;      
    }

    public function userAdmins($password,$email,$role,$status,$first_name)
    {
   
      $user = new User();
      $imageFile = UploadedFile::getInstance($user, 'photo');
      if(isset($imageFile->size))
      {
      if(!file_exists(Url::to('@webfront/application/images/'))){
          mkdir(Url::to('@webfront/application/images/'),0777,true);
      }
      $fileName=time().''.$imageFile->baseName.'.'.$imageFile->extension;
      $imageName=Url::to('@webfront/application/images/').$fileName;
      $imageFile->saveAs($imageName);
      }
      $SID=$first_name?? date('Y').rand(0001,9999);
      $user->photo = $fileName??'';
      $user->username=$SID;
      $user->email= $email;
      $user->role_id=$role;
      $user->password_hash = $user->setPasswords($password);
      $user->status = $status;
      $user->auth_key=$user->generateAuthKey();
      $user->save();

      Yii::$app->mailer->compose()
      ->setFrom(['ips.admin@upsamail.edu.gh'=>'UPSA'])
      ->setTo($email)
      ->setSubject('Credentials for IPS Portal')
        ->setHtmlBody('Password:'.$password.' And Index Number is :'.$SID)
      ->send();

      return $user->id;
    }


public function professionalMail($admission){

    Yii::$app->mailer->compose(['html' => 'register'],[
    'modelp' => $admission,
    'logo' => Yii::getAlias('@app/web/images/mail/images/logo.png'),
    ])
    
  ->setFrom(['ips.admin@upsamail.edu.gh'=>'UPSA'])
      ->setTo($admission->application->personalAddress->email)
      ->setSubject('UPSA ADMISSION')
      ->setTextBody("")
      ->send();
}


public function accessMail($admission)
{

  Yii::$app->mailer->compose(['html' => 'register'],[
    'modelp' => $admission
    ])
  ->setFrom(['ips.admin@upsamail.edu.gh'=>'UPSA'])
      ->setTo($admission->application->personalAddress->email)
      ->setSubject('UPSA ADMISSION')
      ->setTextBody("")
      ->send();
}


// $key='d9bc69602d9c7ef588d7f23a0fbac62b9506b0a1c60a38945ba091d53063e215'
//Encryption of result
public function encrypt($data, $key){

 $keys='c6775e353ae3e55e369f1aa5cbc9987055b1aee05b7b8a16494b59dd17fa7694'.$key;

  $data = Yii::$app->getSecurity()->hashData($data, $keys);

  return  $data;

}


//Encryption of result
public function decrypt($hash,$key){

$keys='c6775e353ae3e55e369f1aa5cbc9987055b1aee05b7b8a16494b59dd17fa7694'.$key;

$data = Yii::$app->getSecurity()->validateData($hash, $keys);

return  $data;

}


public function sms($name,$to,$sn){
    try{
        $name= $name;
        $serial_no=$sn;
        $key = "aaf80d3ed9206bf83435";
        $to  = $to;
        $msg = "Dear  $name, You have started your IPS"."\n".
        "application with SNo: $serial_no" . "\n".
        "Ensure you complete"."\n".
        "all stages of the application"."\n";
        $sender_id = "UPSA";
        $msg = urlencode($msg);
        $url = "https://apps.mnotify.net/smsapi?key=$key&to=$to&msg=$msg&sender_id=$sender_id";
        $response = file_get_contents($url);

    }catch(Exception $e){
    }

}

public function sms2($name,$to){
    try{
    $name= $name;
    $key = "aaf80d3ed9206bf83435";
    $to  = $to;
    $msg = "Dear  $name, thank you for submitting."."\n".
    "your IPS application. You may still make" . "\n".
    "a change to your submitted information". "\n".
    "until the application is processed"."\n";
    $sender_id = "UPSA";
    $msg = urlencode($msg);
    $url = "https://apps.mnotify.net/smsapi?key=$key&to=$to&msg=$msg&sender_id=$sender_id";
    $response = file_get_contents($url);
        }catch(Exception $e){
    }
}

public function  usis_student($student_id)
{
        $ch = curl_init();
        $url = "https://uapi.upsasys.com/index.php";
        $dataArray = ['r' => 'api/ips/student_details',
                          'client_id'=>"dSy2pa84ef",
                          'student_id'=>$student_id];
        $data = http_build_query($dataArray);
        $getUrl = $url."?".$data;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return  json_decode($response,true);
  }



################################################################################################################################

    private $baseUrl = "http://appdoc.upsahostels.com/alfresco/api/-default-/public/";
    private $username = 'istd_user';
    private $password = 'R5gLdljagRQMzw6';
    private $authToken = null;
    private $timeout = 30; // seconds
    private $connectTimeout = 10; // seconds
    private $maxRetries = 3;

    /**
     * Authenticate with Alfresco and get a ticket
     * @return string Base64 encoded authentication ticket
     * @throws Exception If authentication fails
     */
    private function authenticate()
    {
        if ($this->authToken) {
            return $this->authToken;
        }

        $url = $this->baseUrl . "authentication/versions/1/tickets";
        $data = json_encode([
            'userId' => $this->username,
            'password' => $this->password,
        ]);

        $response = $this->makeRequest($url, 'POST', [
            'Content-Type: application/json'
        ], $data);

        if (!isset($response['entry']['id'])) {
            throw new Exception('Authentication failed: ' . json_encode($response));
        }

        $this->authToken = base64_encode($response['entry']['id']);
        return $this->authToken;
    }

    /**
     * Main function to upload a file to Alfresco
     * @param string $academicYear
     * @param string $studentCategory
     * @param string $folderName
     * @param string $fileName
     * @param string $fileType
     * @param string $fileData Path to the file
     * @return array ['status' => bool, 'message' => string, 'fileId' => string|null]
     */
    public function uploadFile($academicYear, $studentCategory, $folderName, $fileName, $fileType, $fileData)
    {
        try {
            // Validate input parameters
            if (!file_exists($fileData)) {
                throw new Exception("Source file not found");
            }

            if (!is_readable($fileData)) {
                throw new Exception("Source file not readable");
            }

            $authToken = $this->authenticate();
            $authHeader = "Authorization: Basic " . $authToken;
            
            $folderId = $this->createFolderStructure($academicYear, $studentCategory, $folderName, $authHeader);
            $result = $this->uploadOrUpdateFile($folderId, $fileData, $fileType, $fileName, $authHeader);
            
            if ($result['status']) {
                return [
                    'status' => true,
                    'message' => 'File uploaded successfully',
                    'fileId' => $result['fileId']
                ];
            }
            
            throw new Exception($result['message'] ?? 'Unknown error uploading file');
            
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'fileId' => null
            ];
        }
    }

    /**
     * Create or find the folder structure
     */
    private function createFolderStructure($academicYear, $studentCategory, $folderName, $authHeader)
    {
        // First try to find the student folder
        $studentFolderId = $this->findNodeByName($folderName, 'cm:folder', $authHeader);
        
        if ($studentFolderId === null) {
            // If not found, find/create academic folder first
            $academicFolderId = $this->findNodeByName($studentCategory, 'cm:folder', $authHeader);
            
            if ($academicFolderId === null) {
                throw new Exception("Academic folder not found");
            }
            
            // Create the student folder
            $studentFolderId = $this->createFolder($academicFolderId, $folderName, $authHeader);
            
            if ($studentFolderId === null) {
                throw new Exception("Failed to create student folder");
            }
        }
        
        return $studentFolderId;
    }

    /**
     * Find a node by name
     */
    private function findNodeByName($name, $nodeType, $authHeader)
    {
        $url = $this->baseUrl . "alfresco/versions/1/queries/nodes?term=" . urlencode($name) . 
               ($nodeType ? "&nodeType=" . urlencode($nodeType) : "");
        
        $response = $this->makeRequest($url, 'GET', [$authHeader]);
        
        return $response['list']['entries'][0]['entry']['id'] ?? null;
    }

    /**
     * Create a new folder
     */
    private function createFolder($parentId, $folderName, $authHeader)
    {
        $url = $this->baseUrl . "alfresco/versions/1/nodes/" . $parentId . "/children";
        $data = json_encode([
            "name" => $folderName,
            "nodeType" => "cm:folder",
        ]);

        $response = $this->makeRequest($url, 'POST', [
            'Content-Type: application/json',
            $authHeader
        ], $data);

        return $response['entry']['id'] ?? null;
    }

    /**
     * Upload or update a file with retry logic
     */
    private function uploadOrUpdateFile($folderId, $filePath, $fileType, $fileName, $authHeader)
    {
        $retryCount = 0;
        $lastError = null;
        
        while ($retryCount < $this->maxRetries) {
            try {
                // First try to find the file
                $fileId = $this->findFileInFolder($folderId, $fileName, $authHeader);
                
                if ($fileId) {
                    // File exists - update it
                    return $this->updateFileContent($fileId, $filePath, $fileType, $fileName, $authHeader);
                } else {
                    // File doesn't exist - create new
                    return $this->createNewFile($folderId, $filePath, $fileType, $fileName, $authHeader);
                }
                
            } catch (Exception $e) {
                $lastError = $e->getMessage();
                $retryCount++;
                sleep(1); // Wait before retry
                continue;
            }
        }
        
        throw new Exception("Failed after {$this->maxRetries} attempts. Last error: {$lastError}");
    }

    /**
     * Update existing file content
     */
    private function updateFileContent($fileId, $filePath, $fileType, $fileName, $authHeader)
    {
        $cfile = new CURLFile($filePath, $fileType, $fileName);
        $url = $this->baseUrl . "alfresco/versions/1/nodes/" . $fileId . "/content?majorVersion=true";
        
        $response = $this->makeRequest($url, 'PUT', [
            'Content-Type: application/octet-stream',
            $authHeader
        ], ['filedata' => $cfile], false);
        
        if (!isset($response['entry']['id'])) {
            throw new Exception("Failed to update file content");
        }
        
        return [
            'status' => true,
            'message' => 'File updated successfully',
            'fileId' => $response['entry']['id']
        ];
    }

    /**
     * Create new file
     */
    private function createNewFile($folderId, $filePath, $fileType, $fileName, $authHeader)
    {
        $cfile = new CURLFile($filePath, $fileType, $fileName);
        $url = $this->baseUrl . "alfresco/versions/1/nodes/" . $folderId . "/children";
        
        $response = $this->makeRequest($url, 'POST', [
            $authHeader
        ], [
            'filedata' => $cfile,
            'name' => $fileName,
            'overwrite' => 'true'
        ], false);
        
        if (!isset($response['entry']['id'])) {
            throw new Exception("Failed to create new file");
        }
        
        return [
            'status' => true,
            'message' => 'File created successfully',
            'fileId' => $response['entry']['id']
        ];
    }

    /**
     * Find a file in a folder by name
     */
    private function findFileInFolder($folderId, $fileName, $authHeader)
    {
        $url = $this->baseUrl . "alfresco/versions/1/nodes/" . $folderId . "/children";
        $response = $this->makeRequest($url, 'GET', [$authHeader]);
        
        foreach ($response['list']['entries'] as $entry) {
            if ($entry['entry']['name'] === $fileName) {
                return $entry['entry']['id'];
            }
        }
        
        return null;
    }

    /**
     * Make a CURL request with proper error handling
     */
    private function makeRequest($url, $method, $headers = [], $data = null, $jsonResponse = true)
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        
        if ($data !== null) {
            if (is_array($data) && $this->isAssoc($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? http_build_query($data) : $data);
            }
        }
        
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($error) {
            curl_close($ch);
            throw new Exception("CURL error: " . $error);
        }
        
        curl_close($ch);
        
        if ($jsonResponse) {
            $decoded = json_decode($response, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON response: " . $response);
            }
            
            if ($httpCode >= 400) {
                throw new Exception("API error {$httpCode}: " . ($decoded['error']['briefSummary'] ?? $response));
            }
            
            return $decoded;
        }
        
        return $response;
    }

    /**
     * Check if array is associative
     */
    private function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * Check if file exists in Alfresco
     */
    public function fileExists($folderName, $fileName)
    {
        try {
            $authToken = $this->authenticate();
            $authHeader = "Authorization: Basic " . $authToken;
            
            $folderId = $this->findNodeByName($folderName, 'cm:folder', $authHeader);
            
            if (!$folderId) {
                return [
                    'status' => false,
                    'exists' => false,
                    'message' => 'Folder not found'
                ];
            }
            
            $fileId = $this->findFileInFolder($folderId, $fileName, $authHeader);
            
            return [
                'status' => true,
                'exists' => $fileId !== null,
                'fileId' => $fileId,
                'message' => $fileId ? 'File exists' : 'File not found'
            ];
            
        } catch (Exception $e) {
            return [
                'status' => false,
                'exists' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get file content URL
     */
    public function getFileUrl($folderName, $fileName)
    {
        try {
            $authToken = $this->authenticate();
            $authHeader = "Authorization: Basic " . $authToken;
            
            $folderId = $this->findNodeByName($folderName, 'cm:folder', $authHeader);
            if (!$folderId) {
                throw new Exception("Folder not found");
            }
            
            $fileId = $this->findFileInFolder($folderId, $fileName, $authHeader);
            if (!$fileId) {
                throw new Exception("File not found");
            }
            
            return [
                'status' => true,
                'url' => $this->baseUrl . "alfresco/versions/1/nodes/" . $fileId . "/content",
                'ticket' => base64_decode($authToken)
            ];
            
        } catch (Exception $e) {
            return [
                'status' => false,
                'url' => null,
                'message' => $e->getMessage()
            ];
        }
    }
}

//   private $url="http://appdoc.upsahostels.com/alfresco/api/-default-/public/";
//   private $username='istd_user';
//   private $password='R5gLdljagRQMzw6';

//     /********************************************
//      * Alfresco Functions begins
//      *******************************************/

//     // Authenticating the user at all stages
//     private function  actionAuthentication()
//     {
//         //The JSON data.
//         $jsonData = array(
//             'userId' => $this->username,
//             'password' => $this->password,
//         );
//         //Encode the array into JSON.
//         $jsonDataEncoded = json_encode($jsonData);

//         $curl = curl_init();
//         curl_setopt_array($curl,
//             array(
//                 CURLOPT_URL => "".$this->url."authentication/versions/1/tickets",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "POST",
//                 CURLOPT_POSTFIELDS => $jsonDataEncoded,
//                 CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
//             )
//         );

//         $response = curl_exec($curl);
//         $err = curl_error($curl);
//         curl_close($curl);
//         $jsondecoded = json_decode($response,true);
//         return  base64_encode($jsondecoded["entry"]["id"]) ;
//     }

//     //Main function

//     public function actionAlfrescoMain($accademic_year,$student_category,$foldername,$filename,$filetype,$filedata)
//     {
//         //Get Authentication
//         $auth_string = "Authorization: Basic " . $this->actionAuthentication() . "";
//         $ch = curl_init();
//         $cfile = new \CURLFile($filedata,$filetype, $filename);
//         // check iof file exist else create it
        
//         $folder_id = $this->actionCreate_folder_file($accademic_year,$student_category,$foldername,$filename,$filetype,$filedata,$auth_string);

//         if ($folder_id == 1)
//         {
//             // file exist but updated
//             return 1 ;

//         }else if ($folder_id == 2){


//         }else{
//             // error creating the folder and file
//             return "Error Creating Uploading Document";
//         }
//     }


//     //Searches for Academic Folders of Applicant (eg. Bachelors,PHD,etc)
//     private function  actionStudentfoldersearch($foldername,$auth_string)
//     {
//         $curl = curl_init();
//         curl_setopt_array($curl,
//             array(
//                 CURLOPT_URL => $this->url."alfresco/versions/1/queries/nodes?term=".$foldername."&orderBy=name%20desc",
// //                  CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $id ."/children?relativePath=".$accademic_year."%20Applicant%20Documents&orderBy=name%20desc",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "GET",
//                 CURLOPT_HTTPHEADER => array("Accept: application/json",$auth_string),
//             )
//         );

//         $response = curl_exec($curl);
//         $err = curl_error($curl);
//         curl_close($curl);
//         $jsondecoded = json_decode($response,true);

//         if(!empty($jsondecoded["list"]["entries"][0]['entry']['id']))
//         {
//             return $jsondecoded["list"]["entries"][0]['entry']['id'];

//         }else{

//             return "File Not Found" ;
//         }

//         return "File Not Found" ;
//     }



//     // create folder in Alfresco site
//     private function  actionCreate_folder_file($accademic_year,$student_category,$foldername,$filename,$filetype,$filedata,$auth_string)
//     {
//         $stu_folder = $this->actionStudentfoldersearch($foldername,$auth_string);

//         if ($stu_folder == 'File Not Found')
//         {
//             // Create student folder
//             $accfolder = $this->actionAcademicfoldersearch($accademic_year,$student_category,$auth_string);
//             $jsonData = array(
//                 "name" => $foldername,
//                 "nodeType"=> "cm:folder",
//             );
//             //Encode the array into JSON.
//             $jsonDataEncoded = json_encode($jsonData);
//             $curl = curl_init();
//             curl_setopt_array($curl,
//                 array(
//                     CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $accfolder ."/children",
//                     CURLOPT_RETURNTRANSFER => true,
//                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                     CURLOPT_CUSTOMREQUEST => "POST",
//                     CURLOPT_POSTFIELDS => $jsonDataEncoded,
//                     CURLOPT_HTTPHEADER => array("Content-Type: application/json",$auth_string),
//                 )
//             );

//             $response = curl_exec($curl);
//             $err = curl_error($curl);
//             curl_close($curl);
//             $jsondecoded = json_decode($response,true);

//             return $this->actionCreate_update_file($jsondecoded['entry']['id'],$filedata,$filetype, $filename,$foldername,$auth_string);

//         }else{
// //         return student folder id
//             return $this->actionCreate_update_file($stu_folder,$filedata,$filetype, $filename,$foldername,$auth_string);
//         }

//     }

//     //Searches for Accademic Folders of Applicant (eg. Bachelors,PHD,etc)
//     private function  actionAcademicfoldersearch($accademic_year,$student_category,$auth_string)
//     {
//         $curl = curl_init();
//         curl_setopt_array($curl,
//             array(
//                 CURLOPT_URL => $this->url."alfresco/versions/1/queries/nodes?term=".$student_category."&nodeType=cm:folder",
// //                  CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $id ."/children?relativePath=".$accademic_year."%20Applicant%20Documents&orderBy=name%20desc",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "GET",
//                 CURLOPT_HTTPHEADER => array("Accept: application/json",$auth_string),
//             )
//         );

//         $response = curl_exec($curl);
//         $err = curl_error($curl);
//         curl_close($curl);

//         $jsondecoded = json_decode($response,true);
//         if($jsondecoded["list"]["entries"][0]['entry']['id'])
//         {
//             return $jsondecoded["list"]["entries"][0]['entry']['id'];
//         }else{

//             return "File Not Found" ;
//         }

//         return "File Not Found" ;
//     }




//     // Create if not exists or update file if exists
//     private function  actionCreate_update_file($id,$filedata,$filetype, $filename,$foldername,$auth_string)
//     {
//         $ch = curl_init();
//         $cfile = new \CURLFile($filedata,$filetype, $filename);
//         curl_setopt_array ( $ch, array (
//             CURLOPT_USERPWD => $this->username.":".$this->password,
//             CURLOPT_POST => 1,
//             CURLOPT_POSTFIELDS => array (
//                 'filedata' => $cfile,
//                 'name' => $filename,
//             ),
//             CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $id ."/children",
//             CURLOPT_RETURNTRANSFER => true,
//         ) );
//         $result = curl_exec ( $ch );
//         curl_close ( $ch );
//         $jsondecoded = json_decode($result,true);

//         // $jsondecoded["error"]["statusCode"]=="409"
//         if(!empty($jsondecoded["error"]["statusCode"]))
//         {
//             //     Error, File Exist so update with new version
//             $curl = curl_init();
//             curl_setopt_array($curl,

//                 array(
//                     CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $id ."/children",
//                     CURLOPT_RETURNTRANSFER => true,
//                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                     CURLOPT_CUSTOMREQUEST => "GET",
//                     CURLOPT_HTTPHEADER => array("Accept: application/json",$auth_string),
//                 )
//             );
//             // execute post
//             $result = curl_exec ( $curl );

//             // close curl handle
//             curl_close ( $curl  );
//             $jsondecoded = json_decode($result,true);
//             foreach($jsondecoded['list']['entries'] as $entry)
//             {
//                 if($entry['entry']['name'] == $filename)
//                 {
// //          Perform update
//                     $curl = curl_init();
//                     curl_setopt_array($curl,
//                         array(
//                             CURLOPT_URL => $this->url."alfresco/versions/1/nodes/".$entry['entry']['id'] ."/content?majorVersion=true",
//                             CURLOPT_RETURNTRANSFER => true,
//                             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                             CURLOPT_CUSTOMREQUEST => "PUT",
//                             CURLOPT_POSTFIELDS => array ( 'filedata' => $cfile,
//                             ),
//                             CURLOPT_HTTPHEADER => array("Content-Type: application/json",$auth_string),
//                         )
//                     );

//                     $response = curl_exec($curl);
//                     $err = curl_error($curl);
//                     curl_close($curl);
//                     $jsondecoded = json_decode($response,true);

//                     return 1;
//                 }
//             }
//         }elseif (!empty($jsondecoded['entry']['id']))
//         {
//             return 1;
//         }else
//         {
//             return 0;
//         }
//     }


//     private function  actionExistfile($foldername,$filename)
//     {
//         //Get Authentication
//         $auth_string = "Authorization: Basic " . $this->actionAuthentication() . "";
//         $curl = curl_init();
//         curl_setopt_array($curl,
//             array(
//                 CURLOPT_URL => $this->url."alfresco/versions/1/queries/nodes?term=".$foldername."&nodeType=cm:folder",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_USERPWD => $this->username.":".$this->password,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "GET",
//                 CURLOPT_HTTPHEADER => array("Accept: application/json"),
//             )
//         );
// // execute post
//         $result = curl_exec ( $curl );
// // close curl handle
//         curl_close ( $curl  );
//         $jsondecoded = json_decode($result,true);

//         if ($jsondecoded['error'])
//         {
//             // Student folder was not found
//             return 2;
//         }

//         $curl = curl_init();
//         curl_setopt_array($curl,
//             array(
//                 CURLOPT_URL => $this->url."alfresco/versions/1/nodes/". $jsondecoded["list"]["entries"][0]['entry']['id']."/children",
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_USERPWD => $this->username.":".$this->password,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => "GET",
//                 CURLOPT_HTTPHEADER => array("Accept: application/json"),
//             )
//         );
//         // execute post
//         $result = curl_exec ( $curl );
//         // close curl handle
//         curl_close ( $curl  );
//         $jsondecoded = json_decode($result,true);

//         foreach ($jsondecoded["list"]["entries"] as $entry) {
//             if ($entry["entry"]["name"]==$filename) {
//                 // uploaded file found
//                 return 1;
//             }
//         }
//         // uploaded file not found
//         return 0;
//     }

//     /********************************************
//      * Alfresco Functions ends
//      *******************************************/

  
?>