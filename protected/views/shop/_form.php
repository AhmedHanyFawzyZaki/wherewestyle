<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'shop-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
echo " <div class=\"control-group \">
		<label for=\"UserDetails_city\" class=\"control-label\">Seller Name</label>
				 <div class=\"controls\">";
echo $form->dropDownList($model, 'seller_id', User::model()->getSellers(), array('prompt' => 'Select Seller', 'class' => 'span5'));
echo "</div> </div>";
?>

<?php
echo '<div style="clear:both;"></div>' . $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255));

if ($model->isNewRecord != '1' and $model->image != '') {
    echo "<p style='margin:0 auto;'>" . Chtml::image(Yii::app()->baseUrl . '/media/shops/thumbs_266X300/' . $model->image, 'image', array('width' => 200)) . "</p><br>";
}
?>

<?php
echo '<div style="clear:both;"></div>' . $form->fileFieldRow($model, 'banner', array('class' => 'span5', 'maxlength' => 255));

if ($model->isNewRecord != '1' and $model->banner != '') {
    echo "<p style='margin:0;width: 200px;'>" . Chtml::image(Yii::app()->baseUrl . '/media/shops/banner/' . $model->banner, 'banner', array('width' => 200)) . "</p><br>";
}
?>

<?php
//echo CHtml::label('Description', '');
//$this->widget('application.extensions.eckeditor.ECKEditor', array(
//    'model' => $model,
//    'attribute' => 'desc',
//));
?>
<?php
echo $form->textAreaRow($model, 'desc', array('rows' => 5, 'cols' => 40, 'class' => 'span8'));
?>

<?php
echo CHtml::label('Please split tags with (,) like (tag1, tag2, etc..).', '', array('style' => 'color:red;'));
echo $form->textAreaRow($model, 'tags', array('rows' => 5, 'cols' => 40, 'class' => 'span8'));
?>

<?php
echo CHtml::label('Policy', '');
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'policy',
));
?>

<?php
echo CHtml::label('Sale Description', '');
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'sale_desc',
));
?>

<?php //echo $form->checkboxRow($model, 'sale'); ?>

<div class="control-group" style="margin: 15px 0;">
    <label for="sale_input"  class="site site_bold" style="font-weight: normal !important;"><?php echo CHtml::checkBox('sale_check', $model->store_wide_sale > 0, array('id' => 'sale_input')); ?>&nbsp;&nbsp;Store-wide Sale</label>
</div>

<?php
echo " <div class=\"control-group\" id=\"sale_percentage\" " . ($model->store_wide_sale == 0 ? "style='display:none'" : "") . " >
		<label class=\"control-label\">Sale Percentage :</label>
				 <div class=\"controls\">";
echo $form->textField($model, 'store_wide_sale', array('append' => '%'));
echo "</div> </div>";
?>


<?php echo $form->checkboxRow($model, 'small_featured'); ?>

<?php echo $form->checkboxRow($model, 'big_featured'); ?>

<?php echo $form->checkboxRow($model, 'active'); ?>

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

<script>
    $('#sale_input').click(function() {
        if ($(this).prop('checked'))
        {
            $('#sale_percentage').slideDown(300);
        }
        else
        {
            $('#sale_percentage').slideUp(300);
        }
    });

    $('#shop-form').submit(function() {

        return ($("#Shop_store_wide_sale").val() == '<?= $model->store_wide_sale ?>' || confirm("The Store-wide Sale was changed it will affect on the products in this shop, Are you sure?"));
    });
</script>