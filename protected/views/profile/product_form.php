<?php
$this->pageTitle = Yii::app()->name . ' - ';
if ($model->isNewRecord) {
    $this->pageTitle .= "Add Product";
} else {
    $this->pageTitle .= $model->title;
}
$this->layout = '//layouts/profile_layout';


$rate = Yii::app()->user->getState('currency_rate');
?>

<?php
Yii::app()->clientScript->registerScript('sale2', '
    function upd(){
        if($("#sale_option").is(":checked")){
            $("#new_price").removeAttr("readonly");
        }else{
            $("#new_price").val("");
            $("#new_price").attr("readonly","true");
        }
    }
    $("#sale_option").change(function(){
        upd();
    });
    upd();
');
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
                            'enctype' => 'multipart/form-data'
                        ),
                    ));
                    ?>

                    <div class="modal-body login_sys" style="max-height:none !important;">
                        <div id="create-error-div" class="errorMessage profile_img_div" style="display: none;"></div>
                        <div class="profile_img_div">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Name: </label>
                            <?php echo $form->textField($model, 'title', array('required' => true)); ?>
                            <?php echo $form->error($model, 'title', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?>        
                        </div>
                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Main Product Picture: </label>
                            <?php echo $form->fileField($model, 'main_image', array('class' => 'inputf', 'style' => "position:relative !important;left:0 !important;bottom:0 !important;")); ?>
                            <?php echo $form->error($model, 'main_image', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?> 
                        </div>

                        <?php if (!$model->isNewRecord) { ?>
                            <?php if ($model->main_image) { ?>
                                <div class="profile_img_div">
                                    <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $model->main_image; ?>" width="200px" height="100px" alt="" title=""/>
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <?php
                        $prc = "";
                        $prc2 = "";
                        if (!$model->isNewRecord) {
                            $prc = $model->price * $rate;
                            if ($model->sale) {
                                $prc2 = $model->old_price * $rate;
                            }
                        }
                        ?>

                        <div class="profile_img_div" style="margin-top: 22px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Price (2dp): </label>
                            <?php echo $form->textField($model, 'price', array('value' => $prc, 'required' => true, 'class' => 'price_input', 'id' => 't_price')); ?>
                            <?php echo $form->error($model, 'price', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?> 
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label for="sale_option" class="site" style="margin-bottom: 15px;font-weight: normal !important;"><?php echo $form->checkBox($model, 'sale', array('id' => 'sale_option')); ?>&nbsp;&nbsp;Sale</label>
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Original Price: </label>
                            <?php echo $form->textField($model, 'old_price', array('value' => $prc2, 'id' => 'new_price', 'readonly' => 'true', 'class' => 'price_input')); ?>
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Available Product Quantity: </label>
                            <?php echo $form->textField($model, 'stock'); ?>
                            <?php echo $form->error($model, 'stock', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;display: block;')); ?> 
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Category: </label>
                            <?php
                            echo $form->dropDownList($model, 'cat_id', CHtml::listData(Category::model()->findAll(), 'id', 'title'), array('prompt' => 'Select Category', 'class' => 'span5', 'required' => true));
                            ?>
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Active Until: </label>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'end_date',
                                'options' => array(
                                    'showAnim' => 'fold',
                                    'dateFormat' => 'dd/mm/yy',
                                    'minDate' => date('d/m/Y'),
                                ),
                                'htmlOptions' => array(
                                    'id' => 'vunt',
                                    'style' => 'cursor:pointer;',
                                    'required' => 'required',
                                ),
                            ));
                            ?>
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label for="act" class="site" style="margin-bottom: 15px;font-weight: normal !important;"><?php echo $form->checkBox($model, 'active', array('id' => 'act')); ?>&nbsp;&nbsp;Activate Product Now</label>
                        </div>

                        <!--<div class="profile_img_div social" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product MetaTags <span style="font-size:12px;">( Please split tags with (,) like (tag1, tag2, etc..) )</span>: </label>
                            <?php //echo $form->textArea($model, 'meta', array('cols' => "50", 'role' => '20')); ?>
                        </div>-->

                        <div class="profile_img_div social" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Product Description: </label>
                            <?php
                            $this->widget('application.extensions.eckeditor.ECKEditor', array(
                                'model' => $model,
                                'attribute' => 'desc',
                                /*'config' => array(
                                    'toolbar' => array(
                                        array('Bold', 'Italic', 'Underline', 'Strike'),
                                    ),
                                ),*/
                            ));
                            ?>
                        </div>

                        <?php echo CHtml::activeHiddenField($model, 'gallery_id'); ?>
                        <div class="profile_img_div social" style="margin-top: 15px;">
                            <label class="site" style="margin-bottom: 15px;font-weight: normal !important;">Additional Product Images:</label>
                            <?php
                            $this->widget('GalleryManager', array(
                                'gallery' => $gallery,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" aria-hidden="true"><?php
                            if ($model->isNewRecord) {
                                echo 'Create';
                            } else {
                                echo 'Save';
                            }
                            ?></button>
                        <?php
                        $shid = '';
                        if ($model->isNewRecord) {
                            $shid = $shop_id;
                        } else {
                            $shid = $model->shop_id;
                        }
                        ?>
                        <a class="btn" href='<?= Yii::app()->request->baseUrl; ?>/profile/shopdetails/<?php echo $shid; ?>' aria-hidden="true">Close</a>
                    </div>
                    <?php $this->endWidget(); ?>

                </div>

            </div>		     
        </div>
    </div>
</div>

<script>
  /*  $('.price_input').on('input', function() {
        var ths = $(this);
        var p = ths.val();
        ths.val(p.replace(/[^\d.-]/g, ''));

        var t = parseFloat(ths.val());
        ths.val(t.toFixed(2));
    }); */

<?php if ($store_wide_sale && $model->isNewRecord) { ?>
        $("#create-form").submit(function() {
            if (!confirm("This action will switch off your store-wide sale, are you sure? You can always activate it again in your shop settings.")) {
                return false;
            }
        });
<?php } ?>

<?php if (!$model->isNewRecord && $store_wide_sale) { ?>
        var sale = '<?php echo $model->sale; ?>';
        var t_price = '<?php echo $model->price; ?>';
        var t_old_price = '<?php echo $model->old_price; ?>';
        $("#create-form").submit(function() {
            if (sale != $("#sale_option").val() || t_price != $("#t_price").val() || t_old_price != $("#new_price").val()) {
                if (!confirm("This action will switch off your store-wide sale, are you sure? You can always activate it again in your shop settings.")) {
                    return false;
                }
            }
        }
<?php } ?>
</script>