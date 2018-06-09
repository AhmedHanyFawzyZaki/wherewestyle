<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'notifications-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'user_id',User::model()->getUsers(),array('class'=>'span5','empty'=>'(Select User)')); ?>

	<?php echo $form->dropDownListRow($model,'notif_type',NotificationType::model()->getTypes(),array('class'=>'span5','empty'=>'(Select Type)')); ?>

	<?php //echo $form->textFieldRow($model,'notif_time',array('class'=>'span5','maxlength'=>50)); ?>
    <div class="control-group ">
        <label for="CreditLog_t_date" class="control-label">Tranaction Date</label>
        <div class="controls">
			<?php
                  $form->widget('zii.widgets.jui.CJuiDatePicker', array(
                      'model'=>$model,
                      'attribute' => 'notif_time',
                      'htmlOptions' => array(
                          'size' => '10',         // textField size
                          'maxlength' => '10',    // textField maxlength
                      'class'=>'span5',
                      
        
                      ),
                     'options'=>array(
                          'numberOfMonths'=>2,
                          'showButtonPanel'=>true,
                      ),
        
                  ));
            ?>
        </div>
    </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
