

<div class="log-form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    	'id'=>'user-register-form',
    	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form-horizontal'),
    )); ?>


            <div class="control-group">                
                <?php echo $form->labelEx($model,'username' ,array('class'=>'control-label')); ?>
                <div class="controls">
    	           <?php echo $form->textField($model,'username',array('class'=>'span5')); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model,'email' ,array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model,'email',array('class'=>'span5')); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model,'password' ,array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($model,'password',array('class'=>'span5')); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model,'password_repeat' ,array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($model,'password_repeat',array('class'=>'span5')); ?>
                </div>
            </div>
            
            <div class="control-group">
                <?php echo $form->labelEx($model,'groups_id' ,array('class'=>'control-label')); ?>
                <div class="controls">                   
                    <?php
                     echo $form->radioButtonList($model, 'groups_id',
                                        array(  1 => 'Buyer',
                                                2 => 'Seller' ),
                                      
                                       array(
                        'labelOptions'=>array('style'=>'display:inline'), // add this code
                        'separator'=>'  ',
                    ) );


                    ?>

                </div>
            </div>

            <div class="control-group">                
                <div class="controls">
                    <?php echo CHtml::submitButton('Register' ,array('class'=>'btn')); ?>
                </div>
            </div>


    <?php $this->endWidget(); ?>
</div>