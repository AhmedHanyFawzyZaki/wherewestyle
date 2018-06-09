<?php
$this->pageTitle = Yii::app()->name . ' -' . $pages->Purchases;
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <span class="site capitalize"><?= Yii::app()->user->username; ?></span></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span9">
                	
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'create-form',
                'enableClientValidation' => false,
                'htmlOptions' => array(
                    'class' => 'form-vertical',
					'enctype'=>'multipart/form-data'
                ),
            ));
            ?>
            <div class="modal-body login_sys" style="max-height:none !important;">
            	<div id="create-error-div" class="errorMessage profile_img_div" style="display: none;"></div>
                <div class="profile_img_div">
                    <label class="site site_bold">Product Name : </label>
                    <?php echo $form->textField($model,'title',array('placeholder'=>"Shop name ...")); ?>
                </div>
                <div class="profile_img_div">
        		<?php echo $form->fileField($model,'image',array('class'=>'inputf','style'=>"position:relative !important;left:0 !important;bottom:0 !important;")); ?>
        		</div>
                
        		<?php if(!$model->isNewRecord){ ?>
                	<?php if($model->image){ ?>
                    <div class="profile_img_div">
                    	<img src="<?= Yii::app()->request->baseUrl; ?>/media/shops/thumbs_266X300/<?php echo $model->image; ?>" width="200px" height="100px" alt="" title=""/>
                    </div>
                    <?php } ?>
                <?php } ?>
                
                <div class="profile_img_div">
                    <label class="site site_bold">Product Price : </label>
                    <?php echo $form->textField($model,'price',array('placeholder'=>"Shop name ...")); ?>
                </div>
                
                <div class="profile_img_div">
                    <label class="site site_bold">Product Quantity : </label>
                    <?php echo $form->textField($model,'stock',array('placeholder'=>"Shop name ...")); ?>
                </div>
                
                <div class="profile_img_div">
                    <label class="site site_bold">Product Category : </label>
                    <?php
						echo   $form->dropDownList($model,'cat_id',CHtml::listData(Category::model()->findAll(),'id','title'),array('prompt'=>'Select Category','class'=>'span5'));
					?>
                </div>
                
                <div class="profile_img_div social">
                    <label class="site site_bold">Product MetaTags <span style="font-size:13px;">( Please split tags with (,) like (tag1, tag2, etc..) )</span> : </label>
                    <?php echo $form->textArea($model,'meta',array('cols'=>"50",'role'=>'20')); ?>
                </div>
                
                <div class="profile_img_div social">
                    <label class="site site_bold">Product Description : </label>
                   	<?php 
						/*$this->widget('application.extensions.eckeditor.ECKEditor', array(
								'model'=>$model,
								'attribute'=>'desc',
								));*/
					?>
                </div>
                
                <?php echo CHtml::activeHiddenField($model,'gallery_id');?>
                <div class="profile_img_div social">
                    <?php
					$this->widget('GalleryManager', array(
						'gallery' => $gallery,
					));
					?>
                </div>
            </div>
            <div class="modal-footer">
            	<button type="submit" class="btn" aria-hidden="true"><?php if($model->isNewRecord){ echo 'Create'; }else{ echo 'Save'; } ?></button>
                <a class="btn" href='<?= Yii::app()->request->baseUrl; ?>/profile/shops' aria-hidden="true">Close</a>
            </div>
        <?php $this->endWidget(); ?>

                </div>

            </div>		     
        </div>
    </div>