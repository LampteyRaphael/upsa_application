<?php use kartik\helpers\Html; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.6; color: #000;">

<!-- HEADER -->
<table width="100%" style="border-bottom: 2px solid #002147; padding-bottom: 10px; margin-bottom: 20px;">
    <tr>
        <td style="width: 60%;">
            <?= Html::img($logo, ['height' => '70', 'width' => '220']) ?>
        </td>
        <td style="text-align: right; font-size: 10pt; color: #333;">
            <div style=" padding: 10px; border-radius: 6px;">
                POST OFFICE BOX LG149, Accra, Ghana<br>
                <b>Tel:</b> 0303-937542/44<br>
                <b>Email:</b> admissions@upsamail.edu.gh<br>
                <b>Website:</b> www.upsa.edu.gh<br>
                <b>Date:</b> <?= date('jS F, Y'); ?>
            </div>
        </td>
    </tr>
</table>

<!-- REFERENCE & ADDRESS -->
<p style="margin-bottom: 5px;"><strong>My Ref. No:</strong> AA/VJ/UPSA/520</p>

<p style="margin-bottom: 20px;">
    <strong><?= strtoupper($admission->application->personalDetails->first_name . ' ' . ($admission->application->personalDetails->middle_name ?? '') . ' ' . ($admission->application->personalDetails->last_name ?? '')) ?></strong><br>
    POST OFFICE BOX <?= rtrim($validate->check_only_int($admission->application->personalAddress->address ?? ''), ".") ?><br>
    <?= strtoupper($admission->application->personalAddress->city ?? '') ?>
</p>

<p>Dear <?= strtoupper($admission->application->personalDetails->first_name ?? '') ?>,</p>

<!-- TITLE -->
<p style="font-size: 13pt; font-weight: bold; text-decoration: underline; color: #002147;">
    <?= strtoupper($admission->application->program->program->programCategory->name ?? '') ?> ADMISSION – <?= $admission->accadaminYear->academic_year ?> ACADEMIC YEAR
</p>

<!-- MAIN BODY -->
<p>
    I am pleased to offer you admission into the one-year <strong><?= strtoupper($admission->application->program->program->program_name) ?></strong>
    <?= strtoupper($admission->application->program->program->programCategory->name ?? '') ?> for the
    <?= $admission->accadaminYear->academic_year ?> academic year at the University of Professional Studies, Accra.
</p>

<ol style="padding-left: 20px; margin-top: 10px;">
    <li>
        You are admitted to <strong><?= strtoupper($admission->application->program->program->level->level_name) ?></strong> and your session is
        <strong><?= strtoupper($admission->application->program->program->session->name ?? '') ?></strong>.
    </li>
    <li>
        Your Index Number is <strong><?= strtoupper($admission->admission_id ?? '') ?></strong> and your email address is
        <strong><?= strtolower($admission->application->personalAddress->email ?? '') ?></strong>.
    </li>
    <li>
        The programme starts on <strong><?= Yii::$app->formatter->asDate($admission->accadaminYear->doa, "php:jS F, Y") ?></strong>.
    </li>
    <li>
        You are required to pay a non-refundable programme fee of
        <strong><?= strtoupper($admission->application->program->program->programCategory->figure ?? '') ?></strong>
        (GHS <?= number_format($admission->application->program->program->programCategory->amount ?? 0, 2) ?>) into the University’s account before the programme begins.
    </li>
</ol>

<!-- BANK DETAILS BOX -->
<div style="border: 1px solid #ccc; padding: 10px; margin-top: 10px; background-color: #fdfdfd;">
    <table style="width: 100%; font-size: 11pt;">
        <tr>
            <td style="width: 35%;"><strong>Account Name:</strong></td>
            <td>University Of Professional Studies, Accra</td>
        </tr>
        <tr>
            <td><strong>Account Number:</strong></td>
            <td>030110-0000001824888</td>
        </tr>
        <tr>
            <td><strong>Bank/Branch:</strong></td>
            <td>Absa - Legon Main</td>
        </tr>
    </table>
</div>

<!-- ADDITIONAL INSTRUCTIONS -->
<p style="margin-top: 15px;">
    5. You are responsible for registering with a professional body of your choice and paying for your external examination.<br>
    6. All admission-related correspondence should be addressed to:
</p>

<p style="font-weight: bold; margin-top: 5px;">
    The Head, Programmes Unit<br>
    University Of Professional Studies, Accra (UPSA)<br>
    P.O. Box LG 149<br>
    Accra
</p>

<!-- SIGNATURE -->
<table width="100%" style="margin-top: 30px;">
    <tr>
        <td style="vertical-align: top;">
            Yours faithfully,<br><br><br>
            <strong>Anthony Afeadie<br>(Ag. Director Of Academic Affairs)<br>For: REGISTRAR</strong>
        </td>
        <td style="text-align: right;">
            <?= Html::img($image, ['height' => '100', 'width' => '100', 'style' => 'margin-top:-10px;']) ?>
        </td>
    </tr>
</table>

<!-- OPTIONAL FOOTER OR WATERMARK -->

</body>
</html>
