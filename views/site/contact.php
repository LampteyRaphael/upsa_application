<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap4\Html;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <!-- <div class="text-center">
     <=Html::a('<u>Back To Signup</u>',['site/signup'],['class'=>'btn-link']) ?><h3>Make Payment To Continue</h3>
</div> -->
    <div class="text-center">
        <iframe class="responsive-iframe" height="500" width="400" src="<?= $link??'' ; ?>" style="border:none; background-color:inherit" title="Application"></iframe>        
    </div>




</div>
