<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'orders-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php
$tot = "";
if (!$model->isNewRecord) {
    if ($model->currency_rate) {
        $tot = $model->total / $model->currency_rate;
    }
}
?>

<?php echo $form->dropDownListRow($model, 'user_id', CHtml::listData(User::model()->findAll(), 'id', 'username'), array('prompt' => 'Select User', 'class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'first_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'last_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'country_id', CHtml::listData(AllCountries::model()->findAll(), 'country_id', 'country_name'), array('prompt' => 'Select country', 'class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'total', array('class' => 'span5', 'maxlength' => 255, 'value' => $tot)); ?>

<label for="cin">Order Date</label>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'attribute' => 'order_date',
    'model' => $model,
    'options' => array(
        'showAnim' => 'fold',
        'dateFormat' => 'yy-mm-dd',
    ),
    'htmlOptions' => array(
        'size' => '16',
        'readonly' => true,
        'id' => 'cin',
        'class' => 'span5',
    ),
));
?>

<?php echo $form->dropDownListRow($model, 'status_id', CHtml::listData(OrderStatus::model()->findAll(), 'id', 'status'), array('prompt' => 'Select status', 'class' => 'span5')); ?>

<?php // echo $form->textFieldRow($model, 'token', array('class' => 'span5', 'maxlength' => 255)); ?>

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
