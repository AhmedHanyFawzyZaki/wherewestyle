<?php
Yii::app()->clientScript->registerScript('sale', '
    function upd(){
        if($("#sale_option").is(":checked")){
            $("#new_price").removeAttr("readonly");
        }else{
            $("#new_price").val("");
            $("#new_price").attr("readonly","true");
        }
    }
    $("#sale_option").change(function(){
        upd();
    });
    upd();
');
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5', 'append' => Yii::app()->params['dc_symbol'])); ?>

<?php echo $form->checkBoxRow($model, 'sale', array('id' => 'sale_option')); ?>

<?php echo $form->textFieldRow($model, 'old_price', array('class' => 'span5', 'id' => 'new_price', 'readonly' => 'true', 'append' => Yii::app()->params['dc_symbol'])); ?>

<?php echo $form->textFieldRow($model, 'stock', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'sold', array('class' => 'span5')); ?>

<?php
echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Category</label>
				 <div class=\"controls\">";
echo $form->dropDownList($model, 'cat_id', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array('prompt' => 'Select Category', 'class' => 'span5'));
echo "</div> </div>";
?>

<?php
echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Shop</label>
				 <div class=\"controls\">";
echo $form->dropDownList($model, 'shop_id', CHtml::listData(Shop::model()->findAll(), 'id', 'title'), array('prompt' => 'Select Shop', 'class' => 'span5'));
echo "</div> </div>";
?>

<div class="control-group ">
    <?php echo $form->labelEx($model,'end_date',array('class'=>'control-label'));?>
    <div class="controls">
        <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'end_date',
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'dd/mm/yy',
                ),
                'htmlOptions' => array(
                    'style' => 'cursor:pointer;'
                ),
            ));
        ?>
    </div>
</div>

<?php

//echo CHtml::label('Please split tags with (,) like (tag1, tag2, etc..).', '', array('style' => 'color:red;margin-left:180px;'));
//echo $form->textAreaRow($model, 'meta', array('rows' => 5, 'cols' => 40, 'class' => 'span8'));
?>

<?php
echo '<br>' . $form->fileFieldRow($model, 'main_image', array('class' => 'span5', 'maxlength' => 255));

if ($model->isNewRecord != '1' and $model->main_image != '') {
    echo "<p style=\"margin-left:180px;\">" . Chtml::image(Yii::app()->baseUrl . '/media/products/original/'.$model->main_image, 'main_image', array('width' => 200)) . "</p>";
}
?>

<?php //echo $form->textFieldRow($model,'slug',array('class'=>'span5','maxlength'=>255));  ?>

<?php echo CHtml::activeHiddenField($model, 'gallery_id'); ?>


<?php
echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">More Images</label>
				 <div class=\"controls\" style=\"width:810px;\">";
?>
<div class="container">
    <div class="row">
        <div class="span<?php echo(isset($_GET['w']) ? $_GET['w'] : '12') ?>" style="width:810px;">
            <?php
            $this->widget('GalleryManager', array(
                'gallery' => $gallery,
            ));
            ?>

        </div>
    </div>
</div>
<?php echo "</div> </div>"; ?>

<?php
echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Description</label>
				 <div class=\"controls\" style=\"width:810px;\">";

$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'desc',
    'config' => array(
        'toolbar' => array(
            array('Bold', 'Italic', 'Underline', 'Strike'),
        ),
    ),
));
echo "</div> </div>";
?>

<?php echo $form->checkBoxRow($model, 'auto_delete'); ?>

<?php echo $form->checkBoxRow($model, 'back_order'); ?>

<?php echo $form->checkBoxRow($model, 'active'); ?>

<?php echo $form->checkBoxRow($model, 'featured'); ?>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>

