<?php
$this->pageTitle = Yii::app()->name . ' - ';
if ($model->isNewRecord) {
    $this->pageTitle .= "Add Product";
} else {
    $this->pageTitle .= $model->title;
}
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'create-form',
                        'enableClientValidation' => false,
                        'htmlOptions' => array(
                            'class' => 'form-vertical',
                            'enctype' => 'multipart/form-data',
                        ),
                    ));
                    ?>
                    <div class="modal-body login_sys" style="max-height:none !important;">
                        <div id="create-error-div" class="errorMessage profile_img_div" style="display: none;"></div>
                        <div class="profile_img_div">
                            <label class="site" style="font-weight: normal !important;">Shop Name: </label>
                            <?php echo $form->textField($model, 'title', array('placeholder' => "Shop name ...")); ?>
                        </div>
                        <div class="profile_img_div">
                            <label class="site" style="font-weight: normal !important;">Shop Listing Image: </label>
                            <?php echo $form->fileField($model, 'image', array('class' => 'inputf', 'style' => "position:relative !important;left:0 !important;bottom:0 !important;")); ?>
                        </div>

                        <?php if (!$model->isNewRecord) { ?>
                            <?php if ($model->image) { ?>
                                <div class="profile_img_div">
                                    <p id='image-cont'><img src="<?= Yii::app()->request->baseUrl; ?>/media/shops/thumbs_266X300/<?php echo $model->image; ?>" width="200px" height="100px" alt="" title=""/>
                                
                                
                                <?php
            echo CHtml::ajaxLink(
                'Delete Image',
                array('/profile/deleteimage/id/'.$model->id),
                array(
                       'success'=>'function(data){
                        //var obj = jQuery.parseJSON(data);
                        if(data =="done"){
                           document.getElementById("image-cont").innerHTML=" Image Deleted";
                       }
                    }'
                ),
                array('class' =>'left0px')
            );
        ?>
                                    </p>
                                </div>
                        
                            <?php } ?>
                        <?php } ?>

                        <!--<div class="profile_img_div">
                            <label class="site" style="font-weight: normal !important;">Shop Banner Image: </label>
                            <?php //echo $form->fileField($model, 'banner', array('class' => 'inputf', 'style' => "position:relative !important;left:0 !important;bottom:0 !important;")); ?>
                        </div>-->

                        <?php 
                        /*
                        if (!$model->isNewRecord) { ?>
                            <?php if ($model->banner) { ?>
                                <div class="profile_img_div">
                                <p id='banner-cont'><img src="<?= Yii::app()->request->baseUrl; ?>/media/shops/banner/<?php echo $model->banner; ?>" width="200px" height="100px" alt="" title=""/>
            <?php
                echo CHtml::ajaxLink(
                'Delete Banner Image',
                array('/profile/deletebannerimage/id/'.$model->id),
                array(
                       'success'=>'function(data){
                        //var obj = jQuery.parseJSON(data);
                        if(data =="done"){
                           document.getElementById("banner-cont").innerHTML="Banner Image Deleted";
                       }
                    }'
                ),
                array('class' =>'left0px')
            );
            ?>
                                </p>         
                                </div>
                            <?php } ?>
                        <?php } 
                        */
                        ?>

                        <div class="profile_img_div" style="margin: 15px 0;">
                            <label for="act"  class="site" style="font-weight: normal !important;"><?php echo $form->checkBox($model, 'active', array('id' => 'act')); ?>&nbsp;&nbsp;Active Shop</label>
                        </div>

                        <div class="profile_img_div" style="margin: 15px 0;">
                            <label for="sale_input"  class="site" style="font-weight: normal !important;"><?php echo CHtml::checkBox('sale_check', $model->store_wide_sale > 0, array('id' => 'sale_input')); ?>&nbsp;&nbsp;Store-wide Sale</label>
                        </div>

                        <div class="profile_img_div social" id="sale_percentage" <?= $model->store_wide_sale == 0 ? "style='display:none'" : "" ?>>
                            <label  class="site" style="font-weight: normal !important;">Store-wide Sales Percentage: </label>
                            <?php echo $form->textField($model, 'store_wide_sale'); ?>
                            <span class="add-on">%</span>
                            <br/><br/>
                        </div>

                        <div class="profile_img_div social">
                            <label  class="site" style="font-weight: normal !important;">Shop Description: </label>
                            <?php echo $form->textArea($model, 'desc', array('cols' => "50", 'role' => '20')); ?>
                        </div>
                        <!--<div class="profile_img_div social">
                            <label class="site" style="font-weight: normal !important;">Social Media: </label>
                            <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                            <?php //echo $form->textField($model, 'facebook', array('placeholder' => "facebook url ...")); ?>
                        </div>

                        <div class="profile_img_div social">
                            <a href=""> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                            <?php //echo $form->textField($model, 'twitter', array('placeholder' => "twitter url ...")); ?>
                        </div>-->

                        <!--<div class="profile_img_div social">
                            <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                        <?php echo $form->textField($model, 'googleplus', array('placeholder' => "google+ url ...")); ?>
                        </div>

                        <div class="profile_img_div social">
                            <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                        <?php echo $form->textField($model, 'youtube', array('placeholder' => "youtube url ...")); ?>
                        </div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" aria-hidden="true"><?php
                            if ($model->isNewRecord) {
                                echo 'Create';
                            } else {
                                echo 'Save';
                            }
                            ?></button>
                        <a class="btn" href='<?= Yii::app()->request->baseUrl; ?>/profile/index' aria-hidden="true">Close</a>
                        <?php if (!$model->isNewRecord) { ?>
                            <a class="btn btn-follow" href='<?= Yii::app()->request->baseUrl; ?>/profile/delete_shop' aria-hidden="true">Delete Shop</a>
                        <?php } ?>
                    </div>
                    <?php $this->endWidget(); ?>

                </div>

            </div>		     
        </div>
    </div>
</div>

<script>
    $('#sale_input').click(function() {
        if ($(this).prop('checked')) {
            $('#sale_percentage').stop(true, true).slideDown(300);
        } else {
            $('#sale_percentage').stop(true, true).slideUp(300);
        }
    });
    $('#create-form').submit(function() {
        return ($("#Shop_store_wide_sale").val() == '<?= $model->store_wide_sale ?>' || confirm("This Store-Wide Sale will affect all the products in the shop, including current sales items. Are you sure? You can always switch this off."));
    });
</script>