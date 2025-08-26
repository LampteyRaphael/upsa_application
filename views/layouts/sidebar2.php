<?php
use app\models\TblApp;
use app\models\Validate2;
use hail812\adminlte\widgets\Menu;
use yii\bootstrap5\Html;
$apps = new Validate2();
if(isset($apps->personalDetails()->id)){
    $logo= TblApp::find()->where(['personal_details_id'=>$apps->personalDetails()->id])->one()->personalDetails->photo??'';
}else{
    $logo= null;
}

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-decoration-none" style="background-color: #3498db;">
        <span class="brand-text font-weight-light d-flex justify-content-center align-items-center">
            <b class="text-center text-uppercase" style="font-size: 1.4rem; letter-spacing: 1.5px; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                IPMS
            </b>
        </span>
    </a>
        <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel d-flex flex-column align-items-center mt-3 pb-3">
            <div class="image" style="width: 150px; height: 150px;">
                <?php if(!empty($logo)): ?> 
                    <?= Html::img(Yii::$app->params['userLogo'].'/'.$logo, [
                        'class' => "img-circle elevation-2",
                        'style' => 'width: 80%; height: 80%; object-fit: cover; border: 3px solid #3498db; box-shadow: 0 4px 8px rgba(0,0,0,0.2);'
                    ])?> 
                <?php else:?>
                    <img src="<?= Yii::$app->params['logo2'];?>"  
                         class="img-circle elevation-2" 
                         style="width: 80%; height: 80%; object-fit: cover; border: 3px solid #3498db; box-shadow: 0 4px 8px rgba(0,0,0,0.2);"  
                         alt="User Image">
                <?php endif; ?> 
            </div>
            <div class="info ">
                <a href="#" class="d-block text-center text-white" style="font-weight: 500; font-size: 1.1rem;">User Profile</a>
            </div>
        </div>
        <nav class="mt-2">
            <?=
             Menu::widget([
                'items' => 
                [
                    ['label' => 'Biodata', 'url'=>['/site/application'], 'icon' => 'fas fa-user'],
                    ['label' => 'Programme Applying For', 'url'=>['/site/program'], 'icon' => 'fas fa-tasks'],
                    ['label' => 'Educational Background', 'url' => ['/site/education'], 'icon' => 'fas fa-university'],
                    ['label' => 'Current Employment',  'icon' => 'fas fa-briefcase', 'url' => ['/site/employment']],
                    ['label' => 'Supporting Documents',  'icon' => 'fas fa-file-alt', 'url' => ['/site/document']],
                    ['label' => 'Application Summary',  'icon' => 'fas fa-file-pdf', 'url' => ['/site/declaration']],
                    [
                        'label' => 'Application Status', 
                        'header' => true,
                        'options' => [
                            'class' => 'menu-header',
                            'style' => 'color:#e74c3c; font-size: 1rem; letter-spacing: 1px;'
                        ]
                    ],
                                        [
                        'label' => 'Application Progress', 
                        'url' => ['/site/stages'], 
                        'icon' => 'fas fa-chart-line',
                        'iconColor' => '#e74c3c',
                        'badge' => '<span class="right badge badge-danger"><i class="fas fa-spinner fa-pulse"></i></span>',
                    ],                      
                ],
            ]);
            ?>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>