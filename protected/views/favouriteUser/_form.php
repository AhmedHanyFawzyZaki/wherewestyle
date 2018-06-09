<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'favourite-user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">User *</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'user_id',CHtml::listData(User::model()->findAll('groups_id<>6'),'id','username'),array('prompt'=>'Select User','class'=>'span5'));
		echo "</div> </div>";
	?>

	<?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Favourite Member *</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'member_id',CHtml::listData(User::model()->findAll('groups_id<>6'),'id','username'),array('prompt'=>'Select Member','class'=>'span5'));
		echo "</div> </div>";
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
