<?php

use yii\bootstrap5\Html as Bootstrap5Html;
use yii\helpers\Html;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body style="background-color: lightblue;">

<div class="row">
    <div class="col">
        <table class="table table-borderless">
            <tr class="text-left">
                <td>
                   <?= Html::img($logo, ['class' => 'img-responsive','height'=>'70px','width'=>'200px','style'=>"margin-right: 30px;"]); ?>                  
                </td>
                <td style="padding: 5px; text-align:center; padding-left:-60px">
                    <h4> <b>Applicant Declaration</b> </h4>
                    <h5 class="text-center"> <b>Summary of Applicant's information from online</b></h5>
                    <h6 class="text-center"> <b>Application For Admission Form</b></h6>
                </td>
                <td>
                <?= Html::img($userLogo, ['height'=>'100px','width'=>'100px']); ?>                  
                </td>
            </tr>
        </table>
    </div>
    </div>
    <div class="col">

    <table class="table table-borderless ml-lg-5">
        <tr>
            <td class="text-left">
                <b>Name :</b>  <?= strtoupper(($personal->personalDetails->first_name??'') . ' ' . ($personal->personalDetails->middle_name??'') .'  ' . ($personal->personalDetails->last_name??''));?></li>
            </td>
            <td class="text-left">
            <b>Gender :</b> <?= strtoupper($personal->personalDetails->gender??'');?>
            </td>
        </tr>

        <tr>
            <td class="text-left"> 
            <b>Date Of Birth :</b> <?= strtoupper($personal->personalDetails->date_of_birth??'');?>
            </td>
            <td class="text-left">
                <b> Nationality :</b> <?= strtoupper($personal->personalDetails->nationality??'');?>
            </td>
        </tr>

        <tr>
            <td class="text-left">
            <b>Emergency Person :</b> <?= strtoupper($personal->personalDetails->contact_person??'');?>
            </td>
            <td class="text-left">
               <b>Emergency Contact : </b> <?= strtoupper($personal->personalDetails->contact_number??'');?>
            </td>
        </tr>
        <tr>
            <td class="text-left">
               <b>Program Applied For: </b> <?= strtoupper($personal->program->program->program_name??'');?>
            </td>
        </tr>
    </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="text-left pl-lg-5">
                I hereby declare that the information provided by me online  regarding the summary of my bio-data and entry
                qualification(s) as reproduced above are authentic <br>and reflect my true records.I further declare that i
                will bear any consequences for any invalid information provided.
            </p>
            <p class="text-left pl-lg-5">
                Applicant's Signature................................................................................................... Date Printed: <?= date('d-F-Y')?>
            </p>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <h4 class="float-left pl-lg-5">WITNESS</h4>
    </div>
        <div class="col-md-12">
            <h5 class="text-left pl-lg-5">To be completed by witness:</h5>
        </div>

        <div class="col-md-12">
            <p class="text-left pl-lg-5 pr-lg-5">
                I certify that the photograph as captured on the front page of this declaration is the true likeness of the applicant,
                Mr/Ms/Mrs............................................................................................................who is personally known by me.
            </p>
            <p class="text-left pl-lg-5 pr-lg-5">
                 I have inspected the certificate(s) submitted by the applicant and to the best of my knowledge are
                genuine. The grades provided above are also exact replication of the grades indicated on the certificate(s).
            </p>

            <p class="text-left pl-lg-5 pr-lg-5">
                The witness must be someone of high repute(Charted member of any recognised Professional Body, Senior Public Servant or
                Head of last Education Institution attended by the applicant).
            </p>

            <p class="text-left pl-lg-5">
                Name:....................................................................................................................................................................
            </p>
            <p class="text-left pl-lg-5">
                Signature/Stamp:...................................................................................................................................................
            </p>
            <p class="text-left pl-lg-5">
                Status/Position:.....................................................................................................................................................
            </p>
            <p class="text-left pl-lg-5">
                Address:................................................................................................................................................................
            </p>
            <p class="text-left pl-lg-5">
                Date:......................................................................................................................................................................
            </p>


            <p class="pl-lg-5 text-left pr-lg-5">
                <b>
                    <i>
                        NB: The endorsed copy of this applicant's declaration slip must be submitted at the point of registration
                       together with all related documents such as certified copies of certificate(s), transcript, birth certificate,etc
                   </i>
               </b>
            </p>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
