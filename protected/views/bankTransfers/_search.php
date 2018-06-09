<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'internet_banking_nickname',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'transaction_date',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'transaction_hour',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'transaction_minute',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'transaction_reference_no',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'amount_transfered',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'receipt',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'other_info',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'order_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
