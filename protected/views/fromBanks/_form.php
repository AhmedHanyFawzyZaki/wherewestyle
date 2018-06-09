<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'from-banks-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'bank_name', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->textFieldRow($model, 'internet_banking_nickname', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->fileFieldRow($model, 'image', array('class' => 'span5')); ?>

<?php if (!$model->isNewrecord && $model->image) { ?>
    <div style="">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?php echo $model->image; ?>" style="max-width: 200px;max-height: 250px;" />
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
