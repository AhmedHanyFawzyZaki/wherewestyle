<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'coupon-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Shop *</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'shop_id',CHtml::listData(Shop::model()->findAll(),'id','title'),array('prompt'=>'Select Shop','class'=>'span5'));
		echo "</div> </div>";
	?>
    
    <?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Type *</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'type',array('0'=>'Percentage','1'=>'Flat Fee'),array('prompt'=>'Select Discount Type','class'=>'span5'));
		echo "</div> </div>";
	?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'redem_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'discount',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
