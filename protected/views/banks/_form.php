<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'banks-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'account_type', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'account_name', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'account_number', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'bank_code', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->textFieldRow($model, 'branch_code', array('class' => 'span5', 'maxlength' => 300)); ?>

<?php echo $form->dropDownListRow($model, 'status',  array('1' => 'Active','0' => 'Not active'),  array('class' => 'span5')); ?>

<?php echo $form->fileFieldRow($model, 'icon', array('class' => 'span5')); ?>

<?php if (!$model->isNewrecord && $model->icon) { ?>
    <div style="">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?php echo $model->icon; ?>" style="max-width: 200px;max-height: 300px;" />
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
