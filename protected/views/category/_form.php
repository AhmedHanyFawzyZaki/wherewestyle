<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php // echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>
    
    <?php /*echo $form->dropDownListRow($model,'parent_id',$model->getCatlist(), array('class'=>'span5',
																					  'prompt'=>'Main Category	' ,
																				     ));*/
			echo $form->hiddenField($model,'parent_id',array('value'=>'0'));
	?>
                 
                 

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
