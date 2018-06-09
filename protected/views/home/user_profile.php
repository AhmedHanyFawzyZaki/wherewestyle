<?php
Yii::app()->clientScript->registerScript('follow', "
var flag = true;
$('body').on('click','.follow2',function(){
	if(flag){
		var ths = $(this);
		var x = ths.attr('sid');
		flag = false;
		$.ajax({
			url : '" . Yii::app()->request->baseUrl . "/home/followshop/'+x,
                        dataType : 'json',
			success : function(data){
				if(data.result != 'error'){
					ths.html(data.result);
                                        $('.flshp_'+x).html(data.count);
				}
				flag = true;
			}
		});	
	}
});
");
?>
<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page user_prof">  
            <h3 class="contitle lspace" style="text-align: left;">
                <span class="site capitalize"><?php echo $model->username; ?></span>
                <?php if (!Yii::app()->user->isGuest) { ?>
                    <?php if (Yii::app()->user->id != $model->id) { ?>
                        <a href="#contactSeller" role="button"  data-toggle="modal" style="float: right !important;margin-top: 6px;" class="btn btn-follow contact_user">
                            <i class="icon-white icon-comment"></i> Contact User</a>
                    <?php } ?>
                <?php } ?>
            </h3>
            <div class="row-fluid">
                <div class="span12">
                    <div class="profile_img_div" style="width:230px !important;float: left;">
                        <?php if (!$model->image) { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="profile_img"/>
                        <?php } else { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $model->image; ?>" class="clear_user_image"/>
                        <?php } ?>
                    </div>

                    <div style="width:750px;float: left;">
                        <div class="profile_img_div">
                            <label style="text-align: left;font-weight: normal !important;" class="site">Full Name: </label>
                            <label style="text-align: left;font-weight: normal;"><?php echo $model->fname . " " . $model->lname; ?></label>
                        </div>
                        <!--                        <div class="profile_img_div social">
                                                    <label class="site" style="text-align: left;">E-Mail: </label>
                                                    <label style="text-align: left;font-weight: normal;"><?php // echo $model->email;                 ?></label>
                                                </div>-->

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="text-align: left;font-weight: normal !important;">Username: </label>
                            <label style="text-align: left;font-weight: normal;"><?php echo $model->username; ?></label>
                        </div>

                        <div class="profile_img_div" style="margin-top: 15px;">
                            <label class="site" style="text-align: left;font-weight: normal !important;">Account Type: </label>
                            <label style="text-align: left;font-weight: normal;"><?php echo $model->usergroup->group_title; ?></label>
                        </div>

                        <?php
                        $shop = Shop::model()->findByAttributes(array("seller_id" => $model->id));
                        if ($shop) {
                            $str = "follow";
                            if (Helper::check_follow_shop($shop->id))
                                $str = "unfollow";
                            ?>
                            <div class="profile_img_div" style="margin-top: 15px;">
                                <label class="site" style="text-align: left;font-weight: normal !important;">Shop Name: </label>
                                <div style="text-align: left;font-weight: normal;" class="shp-user"><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $shop->slug; ?>" class="shop-name2"><?= $shop->title; ?></a>
                                    <?php if (Yii::app()->user->isGuest) { ?>
                                        <a href="#login" role="button"  data-toggle="modal" class="follow" style="float: left;margin-left: 50px;">follow</a>
                                    <?php } else { if(Yii::app()->user->id !=$shop->seller_id){?>
                                        <?php
                                        $str = "follow";
                                        if (Helper::check_follow_shop($shop->id))
                                            $str = "unfollow";
                                        ?>
                                        <a href="javascript:void(0)" sid='<?php echo $shop->id; ?>' class="follow follow2" style="float: left;margin-left: 50px;"><?php echo $str; ?></a>
                                    <?php } }?>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($followed_shops) { ?>
                            <div class="profile_img_div" style="margin-top: 15px;">
                                <label class="site" style="text-align: left;font-weight: normal !important;height: 20px;">Followed Shops: </label>
                                <div style="width: 400px;max-height: 300px;overflow-y: scroll;margin-top: 15px; box-shadow:0 0 2px 0 rgba(0,0,0,0.3);padding: 0 10px;">
                                    <?php foreach ($followed_shops as $shp) { ?>
                                        <div style="text-align: left;padding: 10px 0px;border-bottom: 1px solid #eee;">
                                            <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $shp->slug; ?>"><img style="width: 50px;height: 50px;" src="<?= Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $shp->image; ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $shp->title; ?></span></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo Yii::app()->createUrl("home/all_followed", array("id" => $shop->slug)); ?>" style="width: 400px;max-height: 300px;margin-bottom: 30px;box-shadow:0 0 2px 0 rgba(0,0,0,0.3); padding:10px;display: block;cursor: pointer;">
                                    view all followed shops
                                </a>
                            </div>
                        <?php } ?>

                        <?php if ($f_users) { ?>
                            <div class="profile_img_div" style="margin-top: 15px;">
                                <label class="site" style="text-align: left;font-weight: normal !important;">Followers: </label>
                                <div style="width: 400px;max-height: 300px;overflow-y: scroll;margin-top: 15px; box-shadow:0 0 2px 0 rgba(0,0,0,0.3);padding: 0 10px;">
                                    <?php foreach ($f_users as $fu) { ?>
                                        <div style="text-align: left;padding: 10px 0px;border-bottom: 1px solid #eee;">
                                            <?php
                                            if (!$fu->image) {
                                                $bath = Yii::app()->request->baseUrl . "/img/user.png";
                                            } else {
                                                $bath = Yii::app()->request->baseUrl . "/media/members/thumbs_266X300/" . $fu->image;
                                            }
                                            ?>
                                            <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/user/<?php echo $fu->username; ?>"><img style="width: 50px;height: 50px;" src="<?= $bath ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $fu->username; ?></span></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <a href="<?php echo Yii::app()->createUrl("home/all_followers", array("id" => $shop->slug)); ?>" style="width: 400px;max-height: 300px;margin-bottom: 30px;box-shadow:0 0 2px 0 rgba(0,0,0,0.3); padding:10px;display: block;cursor: pointer;">
                                    view all followers
                                </a>
                            </div>
                        <?php } ?>     
                    </div>
                </div>

            </div>         
        </div>
    </div>
</div>

<?php if (!Yii::app()->user->isGuest) { ?>
    <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="contactSeller" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="true">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Contact user</h3>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'send-form',
            'action' => Yii::app()->createUrl('/profile/createmessage'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            ),
            'htmlOptions' => array(
                'class' => 'form-vertical',
            ),
        ));
        ?>
        <div class="modal-body login_sys">
            <div class="control-group">
                <label class="control-label" for="inputtxt">Subject</label>
                <div class="controls">
                    <?php echo $form->textField($message, 'subject', array('id' => "inputtxt")); ?>
                </div>
                <?php echo $form->hiddenField($message, 'reciever_id', array('value' => $model->id)); ?>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputmsg">Message</label>
                <div class="controls">
                    <?php echo $form->textArea($message, 'content', array('id' => "inputmsg", 'cols' => '50', 'role' => '20')); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            echo CHtml::ajaxSubmitButton(
                    'Send', array('/profile/createmessage'), array(
                'beforeSend' => 'function(){ 
                            	$("#send").attr("disabled",true);
            				}',
                'complete' => 'function(){ 
                            	$("#send-form").each(function(){ this.reset();});
                            	$("#send").attr("disabled",false);
                            }',
                'success' => 'function(data){  
								//var obj = jQuery.parseJSON(data);
								if(data == "wrong"){
									$("#send-error-div").show();
									$("#send-error-div").html("<h4>an error occured , please try again</h4>");
									$("#send-error-div").append("");
								}else{
									$("#send-form").html("<h4 style=\"margin-left:10px;\">the message was sent successfully ! Please Wait...</h4>");
									parent.location.href = "' . Yii::app()->request->baseUrl . '/home/user/' . $model->id . '";
								}
                            }'), array("id" => "send", "class" => "btn btn-primary btn-follow")
            );
            ?>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>

<?php } ?>