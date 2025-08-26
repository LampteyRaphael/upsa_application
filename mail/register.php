<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<div class="row">
            <table>
                <tr>
                    <td>
                        <img src="<?= yii\helpers\Url::base().'/images/download.png/' ?>"/>

                        <!-- <img src="backend/web/images/download.png" alt="" height="60" width="100"> -->
                    </td>
                    <td class="text-right" style="padding-left: 150px" colspan="5">
                          POST OFFICE BOX LG149, Accra, Ghana<br>
                        <b>Tel:</b> 0303-937542/44<br>
                        <b>Email:</b> admissions@upsamail.edu.gh
                        <b>Website:</b> www.upsa.edu.gh

                        <br>
                        <br>
                        <br>
                        <?= date('jS F, Y'); ?>.

                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td><b>My Ref. No:</b>AA/VJ/UPSA/520</td>
                </tr>
                <br>
                <br>

                <tr>
                    <td colspan="8">
                        <?= strtoupper(($admission->application->personalDetails->first_name ). ' ' .( $admission->application->personalDetails->middle_name??'') . ' ' . ($admission->application->personalDetails->last_name??'')); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                       POST OFFICE BOX  <?= strtoupper($validate->check_only_int ($admission->application->personalAddress->address??''));?>
                    </td>

                   <tr>
                       <td colspan="8">
                           <?= strtoupper($admission->application->personalAddress->city??'');?>
                       </td>
                   </tr>
                <tr>
                    <td colspan="8">
                    Dear <?= strtoupper($admission->application->personalDetails->first_name??'').',';?>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td class="text-left" colspan="8">
                        <b><u><?= strtoupper($admission->application->program->program->programCategory->name??'')?> ADMISSIONS- <?= $admission->accadaminYear->academic_year ; ?> ACADEMIC YEAR</u></b>
                    </td>
                </tr>
                <br>
                <br>

                <tr>
                    <td colspan="12">
                       I have the pleasure to offer you admission into the one-year 
                       <b><?= strtoupper($admission->application->program->program->program_name);?> . <?= $admission->application->program->program->programCategory->name??''?> </b> intake 2021/2022 acadamic year being delivered by the University of Professional Studies,Accra as follows:
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td colspan="8">
                        1. You are admitted to <b><?= strtoupper($admission->application->program->program->level->level_name)?> </b> and your session is <b><?= strtoupper($admission->application->program->program->session??'')?></b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td colspan="12">
                        1. Your Index Number is :  <b><?= strtoupper($personal->user->username??'');?></b> and your email address is <b><?= strtoupper($admission->application->personalAddress->email??'');?></b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td colspan="12">
                        2. The Program Start on <b> <?= Yii::$app->formatter->asDate($admission->accadaminYear->doa, "php:jS F, Y"); ?></b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td colspan="12">
                       3.  You will be requred to pay a non-refundable programme fee of <b><?= $admission->application->program->program->programCategory->figure  ?> (<?= $admission->application->program->program->programCategory->amount; ?>).
                        The fees must be paid in full into University's account below the commencement of the programme.</b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td>
                       <b> Account Name : </b>
                    </td>
                    <td>
                       <b> University Of Professional Studies, Accra </b>
                    </td>
                </tr>

                <tr>
                    <td>
                       <b> Account Number : </b>
                    </td>
                    <td>
                       <b> 030110-0000001824888</b>
                    </td>
                </tr>
                <tr>
                    <td>
                       <b> Bank/Branch : </b>
                    </td>
                    <td>
                       <b> Absa - Legon Main </b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td colspan="12">
                        4. It is your responsibility to register with the professional body of your choice and pay for your external examination.
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="12">
                        5. All correspondence in relation to your admission should be address to:
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="12">
                       <b>
                           The Head, Programmes Unit <br>
                           University Of Professional Studies, Accra(UPSA)
                           <br>
                           P . O . Box LG 149
                           <br>
                           Accra
                       </b>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td>
                        <br>
                        Yours faithfully,
                        <br>
                        <br>
                    
                        <br>
                        <b>
                            Anthony Afeadie
                            <br>
                         (Ag. Director Of Academic Affairs)
                        <br>
                        for: REGISTRAR</b>
                    </td>
                    <td colspan="8" class="text-right">
                    <img src="../../application/images/<?=$admission->application->personalDetails->photo;?>" alt="" height="70" width="100">
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>
