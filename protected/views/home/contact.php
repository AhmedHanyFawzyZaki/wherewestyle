<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
?>




<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <div class="map">
                    <h3 class="contitle">Contact Map</h3>
                    <?php
                    $lat = Helper::yiiparam('long');
                    $lng = Helper::yiiparam('lat');

                    $gMap = new EGMap();
                    $gMap->setJsName('test_map');
                    $gMap->width = 980;
                    $gMap->height = 350;
                    $gMap->zoom = 13;
                    $gMap->setCenter($lng, $lat);


                    $circle = new EGMapCircle(new EGMapCoord($lng, $lat));
                    $circle->radius = $radious;
                    $circle->addHtmlInfoWindow(new EGMapInfoWindow('Hey! I am a circle!'));
                    $gMap->addCircle($circle);

                    $gMap->renderMap();
                    ?>
                </div>
                <div class="row-fluid cform">
                    <h3 class="contitle">Contact Form</h3>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'contact-form',
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('class' => 'well span12'),
                    ));
                    ?>
                    <div class="row">
                        <?php
                        if (Yii::app()->user->hasFlash('contact')) {
                            ?>
                            <div class="alert-success alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::app()->user->getFlash('contact'); ?>.
                            </div>

                            <?
                        }
                        ?>
                        <div class="span6">

                            <?php echo $form->labelEx($model, 'first_name'); ?>
                            <?php echo $form->textField($model, 'first_name', array('class' => 'span8', 'maxlength' => 120, 'placeholder' => 'Your First name')); ?>
                            <?php echo $form->error($model, 'first_name', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>

                            <?php echo $form->labelEx($model, 'last_name'); ?>
                            <?php echo $form->textField($model, 'last_name', array('class' => 'span8', 'maxlength' => 120, 'placeholder' => 'Your Last name')); ?>
                            <?php echo $form->error($model, 'last_name', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>

                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('class' => 'span8', 'maxlength' => 120, 'placeholder' => 'Your Email')); ?> 
                            <?php echo $form->error($model, 'email', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>       

                            <?php echo $form->labelEx($model, 'subject'); ?>
                            <?php echo $form->textField($model, 'subject', array('class' => 'span8', 'maxlength' => 128, 'placeholder' => 'Your Subject')); ?>
                            <?php echo $form->error($model, 'subject', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>         

                        </div>
                        <div class="span6">
                            <?php echo $form->labelEx($model, 'message'); ?>
                            <?php echo $form->textArea($model, 'message', array('rows' => 10, 'class' => 'input-xlarge span12', 'placeholder' => 'Your Message')); ?>
                            <?php echo $form->error($model, 'message', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>        
                        </div>
                        <?php //if(CCaptcha::checkRequirements()): ?>

                        <?php //$this->widget('CCaptcha'); ?>
                        <?php //echo $form->textFieldRow($model,'verifyCode',array('maxlength'=>100,'class'=>'span5'));  ?>        
                        <!--<div class="hint">Please enter the letters as they are shown in the image above.
                        <br/>Letters are not case-sensitive.</div>-->
                        <?php //endif;  ?>


                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Send')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>



                <div class="row-fluid cinfo">
                    <h3 class="contitle">Contact Info</h3>
                    <address><?php echo Yii::app()->params['contact_info']; ?></address>
                </div>


            </div>

        </div>

    </div>





    <!-- <form class="well span12">
     <div class="row">
     <div class="span6">
     <label>First Name</label>
     <input type="text" class="span8" placeholder="Your First Name">
     <label>Last Name</label>
     <input type="text" class="span8" placeholder="Your Last Name">
     <label>Email Address</label>
     <input type="text" class="span8" placeholder="Your email address">
     <label>Subject</label>
     <input type="text" class="span8" placeholder="Your email address">
     </div>
     <div class="span6">
     <label>Message</label>
     <textarea name="message" id="message" class="input-xlarge span12" rows="10"></textarea>
     </div>
     <button type="submit" class="btn btn-primary ">Send</button>
     </div>
     </form>
 </div>-->


