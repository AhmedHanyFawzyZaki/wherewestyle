<div class="feedback">
    <div class="above">
        <div class="icon-bullhorn"></div>

        <a id="show" href="javascript:void(0)">Feedback</a>
    </div>
    <div class="feedform" style="width: 255px;z-index:10;">

        <div class="form_data" style="padding-left: 70px;margin-left: 28px;margin-top: -11px;">

            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'site-feedback-form',
                'enableAjaxValidation' => false,
                'action' => Yii::app()->createUrl('/home/savefeedbacks'),
                'htmlOptions' => array('class' => 'feedback_form'),
            ));
            ?>

            <?php
            if (Yii::app()->user->hasFlash('success')) {
                ?>
                <div class="alert-success alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Yii::app()->user->getFlash('success'); ?>.
                </div>

                <?
            }
            ?>

            <div class="controls controls-row">          
                <?php echo $form->textField($this->user_feedback, 'full_name', array('id' => 'name', 'class' => '', 'maxlength' => 255, 'placeholder' => 'Name', 'required' => 'required')); ?>
                <?php echo $form->error($this->user_feedback, 'full_name', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;float:right;margin-right: 10px;')); ?>
            </div>

            <div class="controls controls-row">          
                <input type="email" name="SiteFeedback[email]" id="email" placeholder='Email address' required="required" />
            </div>

            <div class="controls">          
                <?php echo $form->textArea($this->user_feedback, 'content', array('id' => 'message', 'class' => '', 'maxlength' => 255, 'placeholder' => 'Your Message', 'required' => 'required')); ?>
            </div>

            <div class="controls">
                <button id="contact-submit" style="margin-right: -42px;" type="submit" class="btn btn-primary input-medium pull-right btn-follow">Send</button>
            </div>

            <?php $this->endWidget(); ?>

        </div>

    </div>

</div>   




<a href="#" class="scrollup">Scroll</a>





<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => '.loginForm',
    'config' => array(
        maxWidth => 800,
        maxHeight => 900,
        fitToView => false,
        width => '46%',
        height => '48%',
        autoSize => false,
        closeClick => false,
        openEffect => 'none',
        closeEffect => 'none',
        type => 'iframe'
    ),
));
?>  

<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => '.signupForm',
    'config' => array(
        maxWidth => 800,
        maxHeight => 900,
        fitToView => false,
        width => '50%',
        height => '70%',
        autoSize => false,
        closeClick => false,
        openEffect => 'none',
        closeEffect => 'none',
        type => 'iframe'
    ),
));
?>   
