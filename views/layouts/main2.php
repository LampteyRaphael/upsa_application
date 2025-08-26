<?php

// use yii2mod\alert\Alert;
use yii\bootstrap4\Html;
use dmstr\adminlte\widgets\Alert;

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="frontend/web/images/logo.png" type="image/png">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> 
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <style type="text/css">
              /* .bg{
            background:url('frontend/web/images/upsa3.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
        } */
        
            .container-fluid.bg-dark {
                height:200px;
                padding: 5px;
            }

            .container-fluid.bg-dark {
                background-color: #28304e!important;
            }
          
            @media screen and (max-width: 600px) {
                .container1,.title{
                    font-size: 8px;
                }
            }

            @media screen and (max-width: 600px) {
                #title{
                    font-size: 12px;
                }
            }  

            .progressbar{
                counter-reset: step;
            }

            .progressbar li{
                list-style-type: none;
                float: left;
                width:19.25%;
                position: relative;
                text-align: center;
            }

            .progressbar li:before{
                content: counter(step);
                counter-increment: step;
                width: 40px;
                height: 40px;
                line-height: 40px;
                border: 1px solid #ddd;
                display: block;
                text-align: center;
                margin: 0 auto 10px auto;
                border-radius: 50%;
                background-color: white;
            }

            .progressbar li:after{
                content: '';
                position: absolute;
                width: 100%;
                height: 2px;
                background-color: #ddd;
                top: 17px;
                left: -50%;
                z-index: 1;
            }
            .progressbar li:first-child:after{
                content: none;
            }

            .progressbar li.active{
                color: #e9eee9;
            }
            .progressbar li.active:before{
                background-color: #008034;
                color: white;
            }

            .progressbar li.active+li:after{
                background-color: #007417;
                font-weight: bold;
            }

            .progressbar li.active {
                color: #0c820c;
                font-weight: bold;
            }
        </style>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- Image and text -->
   

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?php echo Html::img('frontend/web/images/logo.png',['width'=>'100','height'=>'50'],['alt' => 'alt image'], ['class' => 'pull-left img-responsive']);?>
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"><b>University Of Professional Studies, Accra</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><b>(UPSA) </b></a>
      </li>
    </ul>
    <span class="navbar-text">
      <?= Html::a('Logout',['/site/exit'],['data-method' => 'post'])?>
    </span>
  </div>
</nav>
    <div class="wrapper bg">
        <div class="container-fluid bg-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-warning text-center"><b>INSTITUE OF PROFESSIONAL STUDIES(IPS)</b></h6>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row pull-up mt-lg-5">
                    <div class=" m-b-30">
                        <div class="card" style="background-color: lightblue">
                            <div class="card-body">
                                <div class="text-center p-t-30 p-b-20">
                                  <?php  echo Alert::widget();?>
                                    <?= $content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>