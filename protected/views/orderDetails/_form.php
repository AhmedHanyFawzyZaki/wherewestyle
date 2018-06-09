<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'order-details-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'order_id', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'user_id', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'product_id', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'create_time', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'qty', array('class' => 'span5')); ?>


<?php
$cst = "";
if (!$model->isNewRecord) {
    if ($model->order->currency_rate) {
        $cst = $model->cost / $model->order->currency_rate;
    }
}
?>

<?php echo $form->textFieldRow($model, 'cost', array('class' => 'span5', 'maxlength' => 10, 'value' => $cst)); ?>

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
