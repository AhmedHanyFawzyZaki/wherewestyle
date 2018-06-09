<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'products-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php 
		echo " <div class=\"control-group \">
				<label for=\"UserDetails_city\" class=\"control-label\">Description</label>
			 <div class=\"controls\">";
	 $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model'=>$model,
                'attribute'=>'desc',
                ));
		 echo "</div> </div>";

	?>

	<?php echo $form->textAreaRow($model,'meta',array('rows'=>6, 'cols'=>50, 'class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','append'=>' &pound')); ?>
    
   <?php if($model->isNewRecord  != 1){?>
	<div class="container">
	    <div class="row">
	        <div class="span<?php echo(isset($_GET['w']) ? $_GET['w'] : '12')?>" style="width:950px;">
	            <?php
	            $this->widget('GalleryManager', array(
	                'gallery' => $gallery,
	            ));
	            ?>

	        </div>
	    </div>
	</div>

<? }?>
    
    <!--<div class="control-group">
		<?php echo $form->labelEx($model,'start_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'start_date',
			'options' => array(
				'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
				'changeYear' => true,           // can change year
				'changeMonth' => true,          // can change month
				'yearRange' => '2000:2099',     // range of year
				'minDate' => '2000-01-01',      // minimum date
				'maxDate' => '2099-12-31',      // maximum date
				'showButtonPanel' => true,      // show button panel
			),
            'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
            ),
        ));
        ?>
        <?php echo $form->error($model,'date_from'); ?>
    </div>-->
    
    <?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Category</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'cat_id',Category::model()->getCategories(),array('empty'=>'Select Category'));
		echo "</div> </div>";

  	?>
    
    <?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Shop</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'shop_id',Shop::model()->getShops(),array('empty'=>'Select Shop'));
		echo "</div> </div>";

  	?>

	<?php echo $form->textFieldRow($model,'stock',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sold',array('class'=>'span5')); ?>

	<?php echo $form->checkboxRow($model,'auto_delete'); ?>

	<?php echo $form->checkboxRow($model,'active'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
