<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'all-countries-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'country_code',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'country_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php //echo $form->textFieldRow($model,'cost_country',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
