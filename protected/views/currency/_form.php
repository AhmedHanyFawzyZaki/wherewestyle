<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'currency-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'rate', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'iso_code', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'symbol', array('class' => 'span5')); ?>

<?php echo $form->fileFieldRow($model, 'icon', array('class' => 'span5')); ?>

<?php if (!$model->isNewrecord && $model->icon) { ?>
    <div style="">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?php echo $model->icon; ?>" style="width: 50px;max-height: 50px;" />
    </div>
<?php } ?>

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
