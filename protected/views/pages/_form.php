<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pages-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php // echo $form->textAreaRow($model, 'intro', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>



<?php
echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 255));

if (!$model->isNewRecord and $model->image) {
    echo "<p>" . Chtml::image(Yii::app()->baseUrl . '/media/' . $model->image, 'image', array('width' => 200)) . "</p>";
}
?>
<div style="margin-top: 15px;">
<?php
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'details',
));
?>
</div>
<?php // echo $form->textFieldRow($model, 'video', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php // echo $form->checkboxRow($model, 'publish'); ?>

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
