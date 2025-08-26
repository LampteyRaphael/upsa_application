<?php
use yii\bootstrap5\Breadcrumbs;
use app\models\TblAcademicYear;
use dmstr\adminlte\widgets\Alert;
use yii\bootstrap4\Html;

$this->registerCss(<<<CSS
    :root {
        --primary-color: #3498db;
        --secondary-color: #2c3e50;
        --accent-color: #e74c3c;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --success-color: #2ecc71;
    }
    
    .content-wrapper {
        background-color: #f5f7fa;
        min-height: 100vh;
    }
    
    .content-header {
        padding: 15px 0;
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }
    
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .breadcrumb-item a:hover {
        color: white;
        text-decoration: underline;
    }
    
    .breadcrumb-item.active {
        color: white;
        font-weight: 500;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }
    
    .content {
        padding: 2rem 0;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card:hover {
        /* transform: translateY(-5px); */
        /* box-shadow: 0 10px 25px rgba(0,0,0,0.1); */
    }
    
    .sub-header {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 1.25rem 1.5rem;
    }
    
    .card-header h5 {
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .card-header i {
        color: rgba(255,255,255,0.9);
    }
    
    .card-body {
        padding: 2rem;
        background-color: white;
    }
    
    .card-footer {
        background-color: var(--dark-color);
        color: white;
        font-weight: 500;
        text-align: center;
        padding: 1rem;
    }
    
    .alert {
        border-left: 4px solid;
        border-radius: 0;
    }
    
    @media (max-width: 768px) {
        .content-header {
            padding: 10px 0;
        }
        
        .breadcrumb {
            justify-content: flex-start !important;
            margin-top: 10px;
        }
        
        .card-body {
            padding: 1.5rem;
        }
    }
    
    /* Animation for page load */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .card {
        /* animation: fadeIn 0.5s ease-out forwards; */
    }

    .program-selection-container {
        /* max-width: 100%; */
        /* margin: 30px auto; */
        background: white;
        border-radius: 10px;
        /* box-shadow: 0 5px 25px rgba(0,0,0,0.08); */
        overflow: hidden;
        /* padding:20px; */
    }
    
    .selection-header {
        background: linear-gradient(135deg, var(--primary-color), #2980b9);
        color: white;
        padding: 25px 30px;
        text-align: center;
    }
    
    .selection-header h3 {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .selection-header p {
        opacity: 0.9;
        margin-bottom: 0;
    }
    
    .selection-body {
        padding: 30px;
    }

CSS);
?>

<div class="content-wrapper">
    <!-- Gradient Header with Breadcrumbs -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    
                    <!-- Optional: Add page title here -->
                </div>
                <div class="col-sm-6">
                    <?= Breadcrumbs::widget([
                        'links' => $this->params['breadcrumbs'] ?? [],
                        'options' => [
                            'class' => 'breadcrumb justify-content-end',
                        ],
                        'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                        'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="content" style="margin-top: -120px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-10">
                    <!-- Main Card Container -->
                    <div class="card">
                        <!-- Gradient Card Header -->
                        <div class="card-header sub-header">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <b>Academic Year: <?= Html::encode(TblAcademicYear::find()->where(['status' => 1])->one()->academic_year) ?></b>
                            </h5>
                        </div>
                        
                        <!-- Card Body with Content -->
                        <div class="card-body">
                            <?= Alert::widget() ?>
                            <?= $content ?>
                        </div>
                        
                        <!-- Card Footer -->
                        <div class="card-footer sub-header">
                            <h6 class="mb-0">
                                <i class="fas fa-university mr-2"></i>
                                Institute Of Professional Management System
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
JS);
?>