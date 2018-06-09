<?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'create-form',
               'action' => Yii::app()->createUrl('/profile/test'),
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'validateOnType' => false,
                ),
             'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            ?>
            <div >wwwwwwwwwwwwwwwwwwwww
            	<div id="create-error-div"></div>
                <div class="profile_img_div">
                    <label class="site site_bold">Shop Name : </label>
                    <?php echo $form->textField($new,'title',array('placeholder'=>"Shop name ...")); ?>
                </div>
                <div class="profile_img_div">
        <?php echo $form->fileField($new,'image',array('class'=>'inputf','style'=>"position:relative !important;left:0 !important;bottom:0 !important;")); ?>
                </div>
                <div class="profile_img_div social">
                    <label class="site site_bold">Description : </label>
                    <?php echo $form->textArea($new,'desc',array('cols'=>"50",'role'=>'20')); ?>
                </div>
				<div class="profile_img_div social">
                    <label class="site site_bold">Social Media : </label>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                    <?php echo $form->textField($new,'facebook',array('placeholder'=>"facebook url ...")); ?>
                </div>

                <div class="profile_img_div social">
                    <a href=""> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                    <?php echo $form->textField($new,'twitter',array('placeholder'=>"twitter url ...")); ?>
                </div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                    <?php echo $form->textField($new,'googleplus',array('placeholder'=>"google+ url ...")); ?>
                </div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                    <?php echo $form->textField($new,'youtube',array('placeholder'=>"youtube url ...")); ?>
                </div>
            </div>
            <div class="modal-footer">
        		
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            
            
            <input type="submit" value="dwdwdwd">
        <?php $this->endWidget(); ?>
    </div>

