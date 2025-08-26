<?php
use yii\bootstrap5\Html;
$this->title = 'Application Declaration';

// Register custom CSS
$this->registerCss(<<<CSS
    .declaration-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    .header-section {
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
    .applicant-photo {
        border: 3px solid #f0f0f0;
        border-radius: 4px;
        object-fit: cover;
    }
    .info-table {
        width: 100%;
        margin-bottom: 30px;
    }
    .info-table td {
        padding: 12px 15px;
        vertical-align: top;
    }
    .info-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .declaration-text {
        line-height: 1.8;
        margin-bottom: 25px;
        text-align: justify;
    }
    .signature-line {
        border-top: 1px dashed #ccc;
        margin: 40px 0 20px;
        padding-top: 15px;
    }
    .witness-section {
        background-color: #f8f9fa;
        padding: 25px;
        border-radius: 6px;
        margin-top: 30px;
    }
    .note-box {
        background-color: #fff8e1;
        border-left: 4px solid #ffc107;
        padding: 15px;
        margin: 25px 0;
    }
    .action-buttons {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    @media print {
        .declaration-container {
            box-shadow: none;
            padding: 0;
            margin-top: 40px;
        }
        .action-buttons {
            display: none;
        }
    }
CSS);
?>

<div class="declaration-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?= Html::img(Yii::$app->params['logo'], ['width' => 220, 'alt' => 'Institution Logo']) ?>
            </div>
            <div class="text-center">
                <h2 class="mb-1" style="color: #2c3e50;">APPLICANT DECLARATION</h2>
                <h5 class="text-muted">Summary of Applicant Information</h5>
                <h6 class="text-muted">Application For Admission Form</h6>
            </div>
            <div>
                <?= Html::img(
                    Yii::$app->params['userLogo'].'/'.($personal->personalDetails->photo??''),
                    [
                        'width' => 100,
                        'height' => 120,
                        'class' => 'applicant-photo',
                        'alt' => 'Applicant Photo'
                    ]
                ) ?> 
            </div>
        </div>
    </div>

    <!-- Applicant Information -->
    <table class="info-table">
        <tr>
            <td width="50%"><strong>Full Name:</strong> <?= Html::encode(strtoupper(($personal->personalDetails->first_name??'') . ' ' . ($personal->personalDetails->middle_name??'') .'  ' . ($personal->personalDetails->last_name??''))) ?></td>
            <td width="50%"><strong>Gender:</strong> <?= Html::encode(strtoupper($personal->personalDetails->gender??'')) ?></td>
        </tr>
        <tr>
            <td><strong>Date of Birth:</strong> <?= Html::encode(strtoupper($personal->personalDetails->date_of_birth??'')) ?></td>
            <td><strong>Nationality:</strong> <?= Html::encode(strtoupper($personal->personalDetails->nationality??'')) ?></td>
        </tr>
        <tr>
            <td><strong>Emergency Contact Person:</strong> <?= Html::encode(strtoupper($personal->personalDetails->contact_person??'')) ?></td>
            <td><strong>Emergency Contact Number:</strong> <?= Html::encode(strtoupper($personal->personalDetails->contact_number??'')) ?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Program Applied For:</strong> <?= Html::encode(strtoupper($personal->program->program->program_name??'')) ?></td>
        </tr>
    </table>

    <!-- Declaration Section -->
    <div class="declaration-text">
        <p>
            I hereby declare that the information provided by me online regarding the summary of my bio-data and entry
            qualification(s) as reproduced above are authentic and reflect my true records. I further declare that I
            will bear any consequences for any invalid information provided.
        </p>
    </div>

    <div class="signature-line">
        <div class="d-flex justify-content-between">
            <div>
                <strong>Applicant's Signature</strong>
                <div style="height: 30px; width: 250px; border-bottom: 1px solid #333;"></div>
            </div>
            <div>
                <strong>Date Printed:</strong> <?= date('d F Y') ?>
            </div>
        </div>
    </div>

    <!-- Witness Section -->
    <div class="witness-section">
        <h4 class="mb-4">WITNESS DECLARATION</h4>
        <p class="text-muted mb-4">To be completed by witness:</p>
        
        <div class="declaration-text">
            <p>
                I certify that the photograph as captured on the front page of this declaration is the true likeness of the applicant,
                Mr/Ms/Mrs ............................................................................................................ who is personally known by me.
            </p>
            <p>
                I have inspected the certificate(s) submitted by the applicant and to the best of my knowledge are
                genuine. The grades provided above are also exact replication of the grades indicated on the certificate(s).
            </p>
            <p>
                The witness must be someone of high repute (Chartered member of any recognised Professional Body, Senior Public Servant or
                Head of last Education Institution attended by the applicant).
            </p>
        </div>

        <table class="info-table">
            <tr>
                <td width="50%">
                    <strong>Name:</strong>
                    <div style="height: 20px; border-bottom: 1px dashed #999; margin-top: 5px;"></div>
                </td>
                <td width="50%">
                    <strong>Status/Position:</strong>
                    <div style="height: 20px; border-bottom: 1px dashed #999; margin-top: 5px;"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Signature/Stamp:</strong>
                    <div style="height: 20px; border-bottom: 1px dashed #999; margin-top: 5px;"></div>
                </td>
                <td>
                    <strong>Date:</strong>
                    <div style="height: 20px; border-bottom: 1px dashed #999; margin-top: 5px;"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Address:</strong>
                    <div style="height: 20px; border-bottom: 1px dashed #999; margin-top: 5px;"></div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Important Note -->
    <div class="note-box">
        <p class="mb-0">
            <strong>NB:</strong> The endorsed copy of this applicant's declaration slip must be submitted at the point of registration
            together with all related documents such as certified copies of certificate(s), transcript, birth certificate, etc.
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <div class="d-flex justify-content-between">
            <?= Html::a('<i class="fas fa-arrow-left"></i> Back', ['document'], [
                'class' => 'btn btn-outline-secondary',
                'data-method' => 'post'
            ]) ?>
            
            <?= Html::button('<i class="fas fa-print"></i> Print', [
                'class' => 'btn btn-primary',
                'onclick' => 'window.print()'
            ]) ?>
        </div>
    </div>
</div>