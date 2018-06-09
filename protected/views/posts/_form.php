<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'posts-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 300)); ?>

<div style="margin-bottom: 15px;"> 
    <div class='controls'>
        <?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 300)); ?>
    </div>
</div>

<?php
if (!$model->isNewRecord && $model->image) {
    echo "<div class='control-group' style='margin-bottom: 15px;'> <div class='controls'>";
    echo CHtml::image(Yii::app()->request->baseUrl . '/media/posts/' . $model->image, 'image', array('width' => 200));
    echo "</div></div>";
}
?>

<div style="margin-bottom: 15px;"> 
    <div class='controls'>
        <?php echo $form->checkBoxRow($model, 'status'); ?>
    </div>
</div>

<?php
$this->widget('application.extensions.eckeditor.ECKEditor', array(
    'model' => $model,
    'attribute' => 'content',
));
?>

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
