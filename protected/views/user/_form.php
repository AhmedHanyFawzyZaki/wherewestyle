<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>



<div class="control-group ">
    <label for="UserDetails_city" class="control-label">User Group</label>
    <div class="controls">
        <?php echo $form->dropDownList($model, 'groups_id', Groups::model()->getGroups(), array('class' => 'span5')); ?>
    </div> 
</div>



<?php
echo $form->fileFieldRow($model, 'image', array('class' => 'span5'));

if (!$model->isNewRecord && $model->image) {
    echo " <div class=\"control-group \"> <div class=\"controls\">";
    echo CHtml::image(Yii::app()->request->baseUrl . '/media/members/thumbs_266X300/' . $model->image, 'image', array('width' => 200));
    echo "</div></div>";
}
?>


<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 90)); ?>

<?php echo $form->passwordFieldRow($model, 'password_repeat', array('class' => 'span5', 'maxlength' => 90)); ?>

<?php echo $form->textFieldRow($model, 'fname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'lname', array('class' => 'span5', 'maxlength' => 255)); ?>

<div class="control-group ">
    <label for="UserDetails_city" class="control-label">User Currency</label>
    <div class="controls">
        <?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(), 'id', 'title'), array('class' => 'span5', 'prompt' => 'SGD (Default)')); ?>
    </div> 
</div>

<div class="control-group ">
    <label for="UserDetails_city" class="control-label">User Status</label>
    <div class="controls">
        <?php echo $form->dropDownList($model, 'active', array('1' => 'Active', '0' => 'Not active'), array('class' => 'span5')); ?>
    </div> 
</div>

<div class="control-group ">
    <label class="control-label">Allowed notifications : </label>
    <div class="controls" style="text-align: left;">
        <?php
        $all = explode(',', $model->allowed_notifs);
        $nts = NotificationType::model()->findAll();
        ?>
        <?php if ($nts) { ?>
            <?php foreach ($nts as $nn) { ?>
                <?php
                $ch = "";
                if (in_array($nn->id, $all)) {
                    $ch = "checked";
                }
                ?>
                <label style="width: 100%;text-align: left !important;"><input type="checkbox" name="allowed[]" value="<?php echo $nn->id; ?>" <?php echo $ch; ?> /> <?php echo $nn->title; ?></label>
            <?php } ?>
        <?php } ?>
    </div>
</div>






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

