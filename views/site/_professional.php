<?php 
use yii\helpers\Html;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/images/logo.png" type="image/png">
</head>
<body>
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
<p style="margin-bottom: 0px; font-size:12px;"><strong>My Ref. No:</strong> FQ/VJ/UPSA/PA25</p>
<p style="font-size:12px; margin-left:600px; margin-bottom:0px; margin-top:0px; "><?= date('jS F Y'); ?></p>
<p style="margin-bottom: 20px; font-size:12px;">
    <?= ucwords($admission->application->personalDetails->first_name . ' ' . ($admission->application->personalDetails->middle_name ?? '') . ' ' . ($admission->application->personalDetails->last_name ?? '')) ?><br>
    <!-- POST OFFICE BOX  rtrim($validate->check_only_int($admission->application->personalAddress->address ?? ''), ".") ?><br> -->
    <?= ucwords($admission->application->personalAddress->city ?? '') ?>
</p>
<p style="font-size:12px; ">Dear <?= ucwords($admission->application->personalDetails->title0->name ?? '') ?>. <?= ucwords($admission->application->personalDetails->first_name ?? '') ?>,</p>
<!-- TITLE -->
<p style="font-size: 12pt; font-weight: bold; text-decoration: underline; color: #002147;">
    <?= ucwords($admission->application->program->program->programCategory->name ?? '') ?> ADMISSION – <?= $admission->accadaminYear->academic_year ?> ACADEMIC YEAR
</p>
<!-- MAIN BODY -->
<p style="font-size:12px;"> 
 We have the pleasure to offer you admission to the University of Professional Studies, Accra to pursue a two-year
  <b><?= ucwords(strtolower($admission->application->program->program->program_name)); ?>(<?= strtoupper($admission->application->program->program->program_code??''); ?>)</b>
   <?= ucfirst(strtolower($admission->application->program->program->programCategory->name ?? '')); ?> with effect from the <?= $admission->accadaminYear->academic_year??'' ; ?> academic year as follows:
</p>
<ol style="font-size:12px;">
    <li>
        Your student Index number is : <b><?= strtoupper($admission->admission_id ?? '') ?></b>.
    </li>
    <li>
        Your admission commences in <?= $validate->formatDate($admission->accadaminYear->registration_of_courses) ?>. and ends in <?= $validate->formatDate($admission->accadaminYear->registration_of_courses_end); ?>.
    </li>
    <li>
        You will be affiliated to Liberty Hall.
    </li>
    <li>
        The commencement of the <?= $admission->accadaminYear->academic_year ?? '' ?> academic year for the <?= $validate->formateprograme($admission->application->program->program->programCategory->name) ?> students and related activities are stated in paragraph 5.
    </li>
    <li>
        You are expected to report on campus for registration from 
        <b><?= $validate->formatDate($admission->accadaminYear->registration_of_courses) ?></b> – <b><?= $validate->formatDate($admission->accadaminYear->registration_of_courses_end) ?></b>. 
        You must also participate in a compulsory programme of orientation for fresh <?= $validate->formateprograme($admission->application->program->program->programCategory->name) ?>
        students on <b><?= $validate->formatDate($admission->accadaminYear->orientation_start) ?></b>.  
        Teaching will begin on <b><?= $validate->formatDate($admission->accadaminYear->teaching_begins); ?></b>.
    </li>
    <li>
        You will be required to pay a non-refundable Academic Facility user fee of One thousand, eight hundred Ghana cedis
         (GH¢1,800.00) for the first semester. Fee for the second semester will be based on number of papers to be taken. 
         The fees must be paid in full into the University’s account below before the commencement of the programme. 
         The deadline for payment is <b><?= $validate->formatDate($admission->accadaminYear->orientation_end); ?></b>.
         <br><br>
        <p>
            Account Name		 : 	University of Professional Studies, Accra<br>
            Account Number	  	 : 	030110 - 0000001824888<br>
            Bank / Branch		 : 	Absa - Legon Main<br><br>
       </p>
    </li>
    <li>
        It is your responsibility to register with the professional body of your choice and pay for your external examination.
    </li>
    <li>
        Complete pass of the <b>Level One / Two Professional papers</b> in addition to the required 
        <b>WASSCE qualification</b> may enable you gain admission to 
        <b>Level 200/300 respectively</b> of a relevant <b>first-degree</b>
         programme in UPSA or you may continue with the remaining levels under the Professional Programme.
    </li>
    <li>
        All correspondence in relation to your admission should be addressed to:<br><br>
       <p> Assistant Registrar, Professional Programmes<br>
        University of Professional Studies, Accra (UPSA)<br>
        P.O. Box LG 149<br>
        Accra</p>
    </li>
</ol>
<!-- SIGNATURE -->
<table width="100%" style="margin-top: 30px;">
    <tr>
        <td style="vertical-align: top;">
            Yours faithfully,<br><br>
            <?= Html::img($signature, ['height' => '50', 'width' => '100', 'style' => 'margin-top:-10px;']) ?>
            <br><br>
            <strong>Prof. Fidelis Quansah<br>Director, IPSD<br>For: REGISTRAR</strong>
        </td>
        <td style="text-align: right;">
            <?= Html::img($image, ['height' => '100', 'width' => '100', 'style' => 'margin-top:-10px;']) ?>
        </td>
    </tr>
</table>

<!-- OPTIONAL FOOTER OR WATERMARK -->
</body>
</html>
