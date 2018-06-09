

<?php
if(Yii::app()->user->hasFlash('ErrorMsg') )
{
	?>

	  <div class="alert alert-error">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error !</strong> <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
    </div>

	<?
}

?>


	<div class="log-form">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,		
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
			'htmlOptions' => array('class'=>'form-horizontal'),
			)); 
		?>

			<?php //echo $form->errorSummary($model); ?>

			<div class="control-group">
	            <label class="control-label" for="LoginForm_username">Email</label>
	            <div class="controls">
					<?php echo $form->textField($model,'username' ,array('id'=>'LoginForm_username','placeholder'=>'Email')  ); ?>	
                    <?php echo $form->error($model,'username' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float:right;margin-right: 10px;')); ?>				
				</div>
				
			</div>

			<div class="control-group">
	            <label class="control-label" for="LoginForm_password">Password</label>
	            <div class="controls">
					<?php echo $form->passwordField($model,'password' ,array('placeholder'=>'Password')  ); ?>					
                    <?php echo $form->error($model,'password' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float:right;margin-right: 10px;')); ?>
				</div>
				
			</div>

			<div class="control-group">
	            <div class="controls">
	            	<label class="checkbox">
						<?php echo $form->checkBox($model,'rememberMe' ,array('class'=>'span1')  ); ?>Remember me
					</label>
			    	<!--<a href="<?= Yii::app()->baseurl?>/home/forgotpass" class="forgt">Forgot your password?</a>-->					
					<?php echo CHtml::submitButton('Sign in' ,array('class'=>'btn')); ?>
				</div>
			</div>
			<span class="required">&nbsp;</span>
		<?php $this->endWidget(); ?>
	</div>

