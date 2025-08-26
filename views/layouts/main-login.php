 <?php
use app\models\LoginForm;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
use yii2mod\alert\Alert;

$model = new LoginForm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?> | IPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="IPS Login Portal">
    <link rel="shortcut icon" href="frontend/web/images/logo.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --error: #dc3545;
            --success: #28a745;
            --border-radius: 8px;
            --shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            overflow: auto;
        }

        .login-app {
            display: flex;
            min-height: 100vh;
            width: 100vw;
        }

        /* Hero Section */
        .login-hero {
            flex: 1;
            background: linear-gradient(rgba(67, 97, 238, 0.85), rgba(67, 97, 238, 0.85)), 
                        url('images/upsa4.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: white;
            position: relative;
        }

        .hero-content {
            max-width: 600px;
            text-align: center;
            z-index: 2;
            padding: 2rem;
        }

        .hero-content h1 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            margin-bottom: 1rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .hero-content p {
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .security-badge {
            margin-top: 2rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Form Section */
        .login-form-container {
            width: 100%;
            max-width: 480px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            height: 100vh;
        }

            /* Form Section */
            .signup-form-container {
            width: 100%;
            max-width: 680px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            height: 100vh;
        }

        .form-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
            min-height: min-content; /* Ensure content can grow */
        }

        .signup-form-content {
            max-width: 100%;
            /* margin: 0 auto; */
            margin-top: 90px;
            /* padding-top: 30px; */
            width: 100%;
            min-height: min-content; /* Ensure content can grow */
        }
        

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .signup-form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-logo {
            height: auto;
            width: 180px;
            max-width: 100%;
            margin-bottom: 1.5rem;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--gray);
            font-size: 0.95rem;
        }

        /* Form Elements */
        .auth-form {
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-wrapper {
            position: relative;
        }

        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            z-index: 2;
            transition: var(--transition);
        }

        .form-control {
            height: 50px;
            padding: 0 15px 0 45px;
            border-radius: var(--border-radius);
            border: 1px solid var(--light-gray);
            width: 100%;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.2);
            outline: none;
        }

        .form-control:focus + .form-icon {
            color: var(--accent);
        }

        .password-field {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            z-index: 2;
            padding: 5px;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--dark);
        }

        /* Error Styling */
        .has-error .form-control {
            border-color: var(--error);
        }

        .has-error .form-icon {
            color: var(--error);
        }

        .invalid-feedback {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            margin-bottom: 1.5rem;
            display: none;
        }

        .progress-bar {
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 3px;
            transition: width 0.4s ease;
        }

        .progress-text {
            font-size: 0.85rem;
            color: var(--gray);
            text-align: center;
            margin-top: 0.5rem;
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-link {
            color: var(--gray);
            font-size: 0.875rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-link:hover {
            color: var(--primary);
        }

        .submit-btn {
            height: 50px;
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Footer Section */
        .auth-footer {
            margin-top: 2rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--gray);
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--light-gray);
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-auth {
            margin: 1.5rem 0;
        }

        .social-title {
            text-align: center;
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: var(--transition);
            border: 1px solid var(--light-gray);
            color: var(--dark);
            text-decoration: none;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: var(--accent);
            color: var(--primary);
        }

        .auth-switch {
            text-align: center;
            color: var(--gray);
            font-size: 0.95rem;
        }

        .register-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-10px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-fade {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .animate-input {
            animation: slideIn 0.4s ease-out forwards;
        }

        .animate-pulse {
            animation: pulse 1.5s infinite;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .login-app {
                flex-direction: column;
            }

            .login-hero {
                min-height: 200px;
                padding: 1.5rem;
                
            }

            .login-form-container {
                max-width: 100%;
                /* padding: 2rem 1.5rem; */
                height: auto;
                min-height: calc(100vh - 200px); /* Full height minus hero */

            }

            .hero-content h1 {
                font-size: 1.5rem;
            }
        }


            /* Responsive Adjustments */
            @media (max-width: 992px) {
            .login-app {
                flex-direction: column;
            }
            
            .login-hero {
                min-height: 200px;
                height: auto;
                padding: 1.5rem;
            }
            
          
        }

        
        @media (max-width: 576px) {
            .login-form-container {
                padding: 1.5rem;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .forgot-link {
                align-self: flex-end;
            }
        }


    </style>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
<div class="login-app">
    <!-- Hero Section -->
    <div class="login-hero">
        <div class="hero-content animate-fade">
                <?= Html::img('@web/images/download.png', [
                    'alt' => 'Application Portal Logo',
                    'class' => 'portal-logo'
                ]) ?>

            <h1>Application Portal</h1>
            <div class="">
                    <div class="">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Track application status</span>
                    </div>
                    <div class="">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Submit documents securely</span>
                    </div>
                    <div class="">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Receive updates in real-time</span>
                    </div>
                </div>
        </div>
    </div>
    
    <!-- Form Section -->
   <?= $content; ?>
</div>

<?php
$js = <<<JS
// Password visibility toggle
$(document).on('click', '.password-toggle', function() {
    const icon = $(this).find('i');
    const input = $(this).siblings('input');
    
    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        input.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
});

// Form submission with progress bar
$('#login-form').on('beforeSubmit', function(e) {
    const form = $(this);
    const btn = form.find('[type="submit"]');
    const progressContainer = $('#login-progress');
    const progressFill = $('#progress-fill');
    const progressText = $('#progress-text');
    
    // Show progress bar
    progressContainer.fadeIn(200);
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Signing in...');
    
    // Simulate progress (in a real app, you'd update this based on actual progress)
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressFill.css('width', progress + '%');
        
        if (progress >= 90) {
            clearInterval(interval);
            progressText.text('Finalizing...');
        } else if (progress >= 60) {
            progressText.text('Verifying credentials...');
        } else if (progress >= 30) {
            progressText.text('Authenticating...');
        }
    }, 300);
    
    // Continue with normal form submission
    return true;
});

// Input animations on focus
$('.form-control').on('focus', function() {
    $(this).parent().find('.form-icon').css({
        'transform': 'translateY(-50%) scale(1.1)',
        'color': 'var(--accent)'
    });
}).on('blur', function() {
    $(this).parent().find('.form-icon').css({
        'transform': 'translateY(-50%)',
        'color': 'var(--gray)'
    });
});

// Error styling
$('#login-form').on('afterValidate', function(event, messages, errors) {
    if (errors.length > 0) {
        $('.form-group').removeClass('has-error');
        $.each(errors, function(index, error) {
            $('#' + error.id).closest('.form-group').addClass('has-error');
        });
    }
});
JS;

$this->registerJs($js);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
