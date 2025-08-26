<?php

use kartik\helpers\Html;
use dmstr\adminlte\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IPS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/logo.png" type="image/png">

    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <style>
        .bg{
            background:url('images/upsa4.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        }

        .slidebar{
             background-color:#FFFFFF;
             top:0;
             right: 0;
             position: fixed;
             background-size: cover;
             height: 100%;
             min-height: 100%;
             background-attachment: fixed;
             /* padding-top: 30px; */
             opacity: 0.95;

        }
       

        @media screen and (max-width: 600px) {
            .banner{
                display: none;
                top: 0;
            }
            .col-lg-4{
                height: 100vh; 
            }
        }

        .container1{
            width:100vh;
        }
        @media screen and (max-width: 600px) {
            .container1{
                font-size: 8px;
            }
        }
    
        .form {
            position: relative;
            z-index: 1;
            /* background: #FFFFFF; */
            max-width: 460px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            /*box-shadow: 0 0 0px 0 rgba(0, 0, 0, 0.1), 0 1px 1px 0 rgba(0, 0, 0, 0.1);*/
        }
        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            /* background: #f2f2f2; */
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form button {
            font-family: "Roboto", sans-serif;
            /* text-transform: uppercase; */
            outline: 0;
            /* background: #4CAF50; */
            width: 100%;
            border: 0;
            padding: 12px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }
       
        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }
        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }
        .form .register-form {
            display: none;
        }
        .align-items-center{
            margin-top: -90px;
        }


    @media (min-width: 120px) {
        .container{
            max-width: 870px;
            max-height:100vh;
            background-color:rgba(255,255,255,0.88);
            border-radius:10px;
            justify-content:'center';
            align-items: center; 
            padding-top: 60px;
            margin-top: 10px;
        }

        .site-signup{
            padding-bottom: 120px;
        }
    }
    </style>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


</head>
<body class="hold-transition bg">
<?php  $this->beginBody() ?>
<div class="container p-1" style="overflow: scroll;" >



<div class="">
  <div class="">
        <?php  echo Alert::widget();?>
        <?= $content;?>
  </div>
</div>
        
       
   
    
</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>