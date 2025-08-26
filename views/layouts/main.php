<?php
/* @var $this \yii\web\View */
/* @var $content string */

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
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #224abe;
            --sidebar-bg: rgb(17, 25, 42);
            --text-light: rgba(255, 255, 255, 0.8);
        }

        [class*=sidebar-dark-] {
            background-color: var(--sidebar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        @media screen and (max-width: 600px) {
            #ips-title {
                font-size: 12px;
            }
        }

        .breadcrumb-item.active {
            color: #e7f1fb;
        }

        .content-header {
            background-color: #212c4a;
            height: 170px;
            z-index: 7;
            color: #FFFFFF;
            font-size: smaller;
        }

        .nav-pills .nav-link {
            color: #FFFFFF;
            font-weight: 500;
            font-family: sans-serif;
        }

        /* Modern Page Loader Styles */
        #global-loader {
            position: fixed;
            z-index: 9999;
            background: var(--sidebar-bg);
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 1;
            visibility: visible;
        }

        #global-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-container {
            text-align: center;
            color: #fff;
            max-width: 320px;
            width: 90%;
            padding: 2rem;
            background: rgba(33, 44, 74, 0.9);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .loader-spinner {
            margin: 0 auto 1.5rem;
            width: 70px;
            height: 70px;
            position: relative;
        }

        .loader-spinner::before,
        .loader-spinner::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            animation: loaderPulse 1.8s ease-in-out infinite;
            filter: drop-shadow(0 0 8px rgba(78, 115, 223, 0.4));
        }

        .loader-spinner::before {
            width: 100%;
            height: 100%;
            background: rgba(78, 115, 223, 0.2);
            animation-delay: 0s;
        }

        .loader-spinner::after {
            width: 70%;
            height: 70%;
            background: var(--primary-color);
            top: 15%;
            left: 15%;
            animation-delay: -0.5s;
        }

        @keyframes loaderPulse {
            0%, 100% {
                transform: scale(0.8);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        .loader-logo img {
            max-width: 80px;
            margin-bottom: 1.5rem;
            filter: brightness(0) invert(1);
            opacity: 0.9;
            transition: transform 0.3s ease;
        }

        .loader-logo:hover img {
            transform: scale(1.05);
        }

        .loader-text {
            margin: 1rem 0;
            font-size: 1.1rem;
            color: var(--text-light);
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .loader-progress {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            margin-top: 1.5rem;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 2px;
            position: relative;
            transition: width 0.3s ease;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                            rgba(255,255,255,0) 0%, 
                            rgba(255,255,255,0.6) 50%, 
                            rgba(255,255,255,0) 100%);
            animation: progressShine 2s infinite;
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .loader-container {
                padding: 1.5rem;
                max-width: 280px;
            }
            
            .loader-spinner {
                width: 60px;
                height: 60px;
            }
            
            .loader-logo img {
                max-width: 70px;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">

<?php $this->beginBody() ?>
<!-- Professional Page Loader -->
<div id="global-loader">
    <div class="loader-container">
        <div class="loader-spinner"></div>
        <div class="loader-logo">
            <img src="<?= Yii::$app->request->baseUrl.Yii::$app->params['loading']; ?>" alt="Logo">
        </div>
        <div class="loader-text">Loading Application</div>
        <div class="loader-progress">
            <div class="progress-bar"></div>
        </div>
    </div>
</div>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
    
    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simulate progress for demo purposes
    const progressBar = document.querySelector('.progress-bar');
    let progress = 0;
    const progressInterval = setInterval(function() {
        progress += Math.random() * 10;
        if (progress >= 100) {
            progress = 100;
            clearInterval(progressInterval);
        }
        progressBar.style.width = progress + '%';
    }, 300);

    // Hide loader when page is fully loaded
    window.addEventListener('load', function() {
        // Ensure progress reaches 100%
        progressBar.style.width = '100%';
        
        // Add small delay for smooth transition
        setTimeout(function() {
            const loader = document.getElementById('global-loader');
            loader.classList.add('hidden');
            
            // Remove loader from DOM after animation completes
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500);
        }, 500);
    });
    
    // Fallback in case load event doesn't fire
    setTimeout(function() {
        const loader = document.getElementById('global-loader');
        if (loader && !loader.classList.contains('hidden')) {
            loader.classList.add('hidden');
            setTimeout(function() {
                loader.style.display = 'none';
            }, 500);
        }
    }, 10000); // 10 second timeout as fallback
});
</script>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>