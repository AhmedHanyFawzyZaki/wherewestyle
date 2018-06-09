<?php
$this->pageTitle = Yii::app()->name . ' - Reset password';
?>



<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page user_prof" style="padding-bottom: 15px;">  
            <h3 class="contitle lspace"><span class="site capitalize">Reset Password</span></h3>
            <div class="row-fluid">
                <div class="span12">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'reset',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(
                            'class' => 'loginsys top10px',
                            'style' => $lg,
                        ),
                    ));
                    ?>

                    <?php if ($form->errorSummary($model)) { ?>
                        <div class="myrow" style="font-size: 16px;margin-top: 10px;margin-bottom: 20px;color: red;">
                            Enter correct data
                        </div>
                    <?php } ?>

                    <?php if (Yii::app()->user->hasFlash("status")) { ?>
                        <div class="myrow" style="font-size: 16px;margin-top: 10px;margin-bottom: 20px;color: red;">
                            <?php echo Yii::app()->user->getFlash("status"); ?>
                        </div>
                    <?php } ?>

                    <div class="myrow">
                        <label>New Password</label>
                        <?php echo $form->passwordField($model, 'newpassword'); ?>
                    </div>

                    <div class="myrow">
                        <label>Repeat New Password</label>
                        <?php echo $form->passwordField($model, 'newpassword_repeat'); ?>
                    </div>

                    <div class="myrow">
                        <label></label>
                        <button type="submit" class="btn btn-site">Save New Password</button>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>

            </div>         
        </div>
    </div>
</div>

