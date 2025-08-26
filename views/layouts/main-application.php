<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii2mod\alert\Alert;
use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/images/logo.png" type="image/png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?php $this->head() ?>
    <style>
        [class*=sidebar-dark-] {
             background-color: rgb(17, 25, 42);

        }

     

 .sub-header{
    background-color:rgba(247, 141, 45,1)
 }

        @media screen and (max-width: 600px) {
            
            #ips-title{
                font-size: 12px;
            }

            .nav-header-title{
                display: none;
            }
        }

        .breadcrumb-item.active {
             color: #e7f1fb;
         }

         .content-header{
            background-color:#fdf8f4;
            height: 170px;
             z-index:7; 
             color:#FFFFFF;
             font-size: smaller; 
         }
          .nav-pills .nav-link {
           color: #FFFFFF;
           font-weight: 500;
           font-family:sans-serif,
        }

        #global-loader {
    position: fixed;
    z-index: 50000;
    background: white;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    margin: 0 auto;
    text-align: center;
   }
 
img {
    max-width: 100%;
}

.loader-img {
    position: absolute;
    right: 0;
    bottom: 0;
    top: 43%;
    left: 0;
    margin: 0 auto;
    text-align: center;
}

.login-img {
    height: 100%;
    width: 100%;
    /* background-position: center; */
    background-repeat: no-repeat;
    background-size: cover;
    display: inline-table;
}

.modal-dialog {
  /* position: absolute; */
  top: 0px;
  /* right: 100px;
  bottom: 0;
  right: 0;
  height: 100%; */
  /* margin: auto; */
  /* z-index: 10040;
   overflow: auto;
  overflow-y: auto;  */
} 

@media screen and (max-width: 600px) {   
    .modal-dialog {
    position: relative;
    bottom: 0;
    right: 0;
    height: 100%;
    margin: auto;
    z-index: 10040;
    overflow: auto;
    overflow-y: auto;
    }
}
.modal {
     -webkit-transition: all 0.75s ease;
    transition: all 0.75s ease; 
}

/* .modal-content{
     background-color: lightblue;
} */


.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('image/loading5.gif') 50% 50% no-repeat;
}

body{
    /*font-family:'Open Sans',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;
    font-size: 1rem;
    font-weight: 400; */
    /*line-height: 1.45; */

    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
}


    </style>

</head>
<body class="hold-transition sidebar-mini">

<?php $this->beginBody() ?>
    <div id="global-loader">
        <img src="css/images/loader.svg" class="loader-img" alt="Loader">
    </div>

<div class="wrapper">

    <!-- Navbar -->
    <?= $this->render('navbar2', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar2', ['assetDir' => $assetDir]) ?>
    <!-- < Alert::widget(); ?> -->
    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content2', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->
    

    <!-- Main Footer -->
    <?= $this->render('footer') ?>

    <script src="css/js/jquery.min.js"></script>


<script src="css/js/custom.js"></script>
<!-- <script src="//code.tidio.co/qpa5p2flf07199dv09gjzyotq4cryhzd.js" async></script> -->


</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
