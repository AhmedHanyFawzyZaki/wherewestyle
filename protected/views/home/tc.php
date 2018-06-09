<?php
$imageUrl = Yii::app()->request->baseUrl."/media/7899-Koala.jpg"
?>
<?php echo CHtml::errorSummary($form); ?> 
    <?=CHtml::beginForm(null, 'POST')?>
    <? //$form in this example is of type AvatarForm, containing variables for the crop area's x, y, width and height, hence the corresponding widget form element parameters ?>
    <?=CHtml::activeHiddenField($form, 'cropID');?>
    <?=CHtml::activeHiddenField($form, 'cropX', array('value' => '0'));?>
    <?=CHtml::activeHiddenField($form, 'cropY', array('value' => '0'));?>
    <?=CHtml::activeHiddenField($form, 'cropW', array('value' => '100'));?>
    <?=CHtml::activeHiddenField($form, 'cropH', array('value' => '100'));?>
    <?$previewWidth = 100; $previewHeight = 100;?>
    <? $this->widget('ext.yii-jcrop.jCropWidget',array(
        'imageUrl'=>$imageUrl,
        'formElementX'=>'AvatarForm_cropX',
        'formElementY'=>'AvatarForm_cropY',
        'formElementWidth'=>'AvatarForm_cropW',
        'formElementHeight'=>'AvatarForm_cropH',
        'previewId'=>'avatar-preview', //optional preview image ID, see preview div below
        'previewWidth'=>$previewWidth,
        'previewHeight'=>$previewHeight,
        'jCropOptions'=>array(
            'aspectRatio'=>1, 
            'boxWidth'=>400,
            'boxHeight'=>400,
            'setSelect'=>array(0, 0, 100, 100),
        ),
    )
    );
    ?>
 
    <!-- Begin optional preview box -->
    <div style="position:relative; overflow:hidden; width:<?=$previewWidth?>px; height:<?=$previewHeight?>px; margin-top: 10px; margin-bottom: 10px;">
    <img id="avatar-preview" src="<?=$imageUrl?>" style="width: 0px; height: 0px; margin-left: 0px; margin-top: 0px;">
    </div>
    <!-- End optional preview box -->
 
    <?=CHtml::submitButton('Crop Avatar'); ?>
    <?=CHtml::endForm()?>