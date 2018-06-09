<?php
$this->pageTitle = Yii::app()->name . ' - Account Settings';
?>

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
    function invite_fb_frs()
    {
      // assume we are already logged in
      FB.init({appId: '409482105858611', xfbml: true, cookie: true});

      FB.ui({
          method: 'send',
          name: 'Where we style',
          link: 'http://wherewestyle.ukprosoltest.com',
          });
    }
</script>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page span8">  
          <?php if (Yii::app()->user->hasFlash('tw_status')) { ?>
                <div class="alert alert-success" style="margin: 20px 0;color: #F62A64 !important">
    
                    <?php echo Yii::app()->user->getFlash('tw_status'); ?>
                </div>
            <?php } ?>
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12" style="margin-left: 25px;">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'settings-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                  
                    <div class="row-fluid">
                    <div class="span12 inbut-setting">
                    
                    <?php echo $form->errorSummary($model); ?>
                    <div class="profile_img_div">
                        <?php if (!$model->image) { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="profile_img"/>
                        <?php } else { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $model->image; ?>" class="profile_img"/>
                        <?php } ?>
                        <?php echo $form->fileField($model, 'image', array('class' => 'inputf')); ?>
                    
                    </div>
                       
                    <div class="profile_img_div">
                     <hr />
                        <label class="site2" style="font-weight: normal !important;">Username  </label>
                        <?php echo $form->textField($model, 'username'); ?>
                       <hr />
                    </div>
                     
                    <div class="profile_img_div">
                        <label class="site2" style="font-weight: normal !important;">First Name  </label>
                        <?php echo $form->textField($model, 'fname'); ?>
               
                             <hr />
                    </div>
               
                    <div class="profile_img_div">
                        <label class="site2" style="font-weight: normal !important;">Last Name  </label>
                        <?php echo $form->textField($model, 'lname'); ?>
                        
                           <hr />
                    </div>
                    
                    
                    <div class="profile_img_div social">
                        <label class="site2" style="font-weight: normal !important;">Email  </label>
                        <?php echo $form->textField($model, 'email'); ?>
                        
                             <hr />
                    </div>
                    <div class="profile_img_div social">
                        <label class="site2" style="font-weight: normal !important;">Password  </label>
                        <?php echo $form->passwordField($model, 'password'); ?>
                        
                             <hr />
                    </div>
                    <div class="profile_img_div social">
                        <label class="site2" style="font-weight: normal !important;">Confirm password  </label>
                        <?php echo $form->passwordField($model, 'password_repeat'); ?>
                        
                             <hr />
                    </div>
                    <div class="profile_img_div social">
                        <label class="site2" style="font-weight: normal !important;">Currency  </label>
                        <?php echo $form->dropDownList($model, 'currency', CHtml::listData(Currency::model()->findAll(), 'id', 'title'), array('prompt' => 'SGD (Default)')); ?>
                         <hr />
                    </div>

                    <div class="profile_img_div social">
                        <label class="site" style="font-weight: normal !important;">Allowed notifications : </label>

                        <table>
                            <tr>
                                <th>On Site</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            <?php
                            $allsite = explode(',', $model->allowed_notifs);
                            $allemail = explode(',', $model->allowed_email_notifs);
                            $nts = NotificationType::model()->findAll();
                            ?>
                            <?php if ($nts) { ?>
                                <?php foreach ($nts as $nn) { ?>
                                    <?php
                                    $site_ch = "";
                                    if (in_array($nn->id, $allsite)) {
                                        $site_ch = "checked";
                                    }

                                    $email_ch = "";
                                    if (in_array($nn->id, $allemail)) {
                                        $email_ch = "checked";
                                    }
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="allowed[site][]" value="<?php echo $nn->id; ?>" <?php echo $site_ch; ?> /> </td>
                                        <td><input type="checkbox" name="allowed[email][]" value="<?php echo $nn->id; ?>" <?php echo $email_ch; ?> /> </td>
                                        <td><label style="font-weight: 100 !important;color:#000;"> <?php echo $nn->title; ?> </label> </td>
                                    </tr>
                                    <!--<label style="font-weight: bold !important;"><input type="checkbox" name="allowed[]" value="<?php echo $nn->id; ?>" <?php echo $ch; ?> /> <?php echo $nn->title; ?></label>-->
                                <?php } ?>
                            <?php } ?>
                        </table>

                    </div>
                    </div><!--end inbut-settin-->
              
                     </div><!--end clas 7-->

                    <div class="profile_img_div social">
                        <button type="submit" class="btn btn-large btn-prim">Save</button>
                    </div>
                    <?php $this->endWidget(); ?>

                </div>

            </div>         
        </div>
        <div class="span4 widget">
          <div class="frist-block">
            <h4>Find Friends</h4>
          
        <?php /*if ($model->facebook || $model->twitter || $model->googleplus || $model->youtube) { ?>
                    <div class="profile_img_div social">
                        <label class="site" style="font-weight: normal !important;">Social Media: </label>
                        <?php if ($model->facebook) { ?>
                            <a href="<?php echo $model->facebook; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                        <?php } ?>
                        <?php if ($model->twitter) { ?>
                            <a href="<?php echo $model->twitter; ?>"> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                        <?php } ?>
                        <?php if ($model->googleplus) { ?>
                            <a href="<?php echo $model->googleplus; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                        <?php } ?>
                        <?php if ($model->youtube) { ?>
                            <a href="<?php echo $model->youtube; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                        <?php } ?>
                    </div>
                <?php }*/ ?>

                    <?php if ($user && $model->facebook_id) {
                /*$user_profile = "";
                $user_profile = Yii::app()->facebook->api('/me/friends');
				  UserFacebookFriends::model()->deleteAll(array('condition'=>'user_id='.Yii::app()->user->id));
				  if($user_profile['data'])
				  {
					  foreach($user_profile['data'] as $fb_us)
					  {
						  $fb_fr=new UserFacebookFriends;
						  $fb_fr->user_id=Yii::app()->user->id;
						  $fb_fr->facebook_fr_id=$fb_us['id'];
						  $fb_fr->save(false);
					  }
				  }*/
          ?>
                <div class="profile_img_div" style="margin-top: 10px;">
                    <table class="table table-striped" style="width:400px; margin:0;">
                        <tbody>
                            <tr>
                                <td style="border-top:none;padding:0;"></td>
                                <td style="border-top:none;padding:0;"></td>
                                <td style="border-top:none;padding:0;"></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top:none;padding:0;">
                                    <!--<a class="btn btn-fac" id="fb_auto" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/inviteFB"><i class="icon-facebook"></i>Invite my Facebook Friends to enjoy WWS <b class="right-caret">〉</b></a>-->
                                    <a class="btn btn-fac" id="fb_auto" onclick="invite_fb_frs()"><i class="icon-facebook"></i>Invite my Facebook Friends to enjoy WWS <b class="right-caret">〉</b></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    <?php
            }else { ?>
                        <div class="profile_img_div" style="margin-top: 10px;">
                            <table class="table table-striped" style="width:400px; margin:0;">
                                <tbody>
                                    <tr>
                                        <td style="border-top:none;padding:0;"></td>
                                        <td style="border-top:none;padding:0;"></td>
                                        <td style="border-top:none;padding:0;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border-top:none;padding:0;">
                                            <a class="btn btn-fac" id="fb_auto" href="<?php echo Yii::app()->facebook->getLoginUrl(array('scope' => 'publish_stream,user_friends')); ?>"><i class="icon-facebook"></i>Invite my Facebook Friends to enjoy WWS <b class="right-caret">〉</b></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php }
          ?>
                    <?php if (Yii::app()->user->getState('fb_find')=='1') {
						Yii::app()->user->setState('fb_find','0');//reset
              				$user_profile = "";
                  			$user_profile = Yii::app()->facebook->api('/me/friends');
          ?>
          			<script>
                            $(document).ready(function(e) {
                            $('#trigger_fb_modal').click(); 
                        });
					</script>
          			<!-- Button trigger modal -->
                    <button id="trigger_fb_modal" style="display:none;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#fbModal">
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="fbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="fbModalLabel">Find Your Facebook Friends</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                                $all_FB_users=User::model()->findAll(array('condition'=>'facebook_id != ""'));
                                foreach($all_FB_users as $fb_user){
                                        $arr[]=$fb_user->facebook_id;
                                }
                                $flag_n=0;
                                foreach($user_profile['data'] as $u_p){
                                    if(in_array($u_p['id'],$arr))
                                    {
                                        $flag_n=1;
                                        $us_friend=User::model()->find(array('condition'=>'facebook_id = "'.$u_p['id'].'"'));
                                        $shop = Shop::model()->findByAttributes(array("seller_id" => $us_friend->id));
                                        if($shop)
                                        {
                                            $foll='follow';
                                            if(Helper::check_follow_shop($shop->id))
                                            {
                                                    $foll='unfollow';
                                            }
                                            echo '<div class="find_prof">
                                                    <img src="'.Yii::app()->request->baseUrl.'/media/members/thumbs_266X300/'.$us_friend->image.'" class="find_prof_img">
                                                    <span class="find_prof_name">'.$us_friend->username.'</span>
                                                    <a class="follow find_prof_follow btn_pink_f" href="javascript:void(0)" onclick="FollowShop('.$shop->id.')" id="fb_fr_'.$shop->id.'">'.$foll.'</a>
                                            </div>';
                                        }
                                    }
                                }
                                if(!$flag_n){
                                    echo '<p class="text-center">Sorry you have no friends on Where We Style. Invite some friends who enjoy shopping to have fun here too!</p><br><br>'
                                    . '<a class="btn btn-fac" onclick="document.getElementById(\'fb_auto\').click();"><i class="icon-facebook"></i>Invite your Facebook Friends to enjoy WWS <b class="right-caret">〉</b></a>';
                                }
                            ?>
                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="profile_img_div" style="margin-top: 10px;">
                      <table class="table table-striped" style="width:400px; margin:0;">
                        <tbody>
                          <tr>
                            <td style="border-top:none;padding:0;"></td>
                            <td style="border-top:none;padding:0;"></td>
                            <td style="border-top:none;padding:0;"></td>
                          </tr>
                          <tr>
                            <td colspan="3" style="border-top:none;padding:0;">
                              <a class="btn btn-fac" href="javascript:void(0)" onclick="SetFind()"><i class="icon-facebook"></i>Find My Facebook Friends on WWS <b class="right-caret">〉</b></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php
            }else { ?>
                        <div class="profile_img_div" style="margin-top: 10px;">
                            <table class="table table-striped" style="width:400px; margin:0;">
                                <tbody>
                                    <tr>
                                        <td style="border-top:none;padding:0;"></td>
                                        <td style="border-top:none;padding:0;"></td>
                                        <td style="border-top:none;padding:0;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="border-top:none;padding:0;">
                                          <a class="btn btn-fac" href="javascript:void(0)" onclick="SetFind()"><i class="icon-facebook"></i>Find My Facebook Friends on WWS <b class="right-caret">〉</b></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php }
          ?>
                    
                    <?php
                    /*if ($user && $user_profile) {
                        ?>
                        <div class="profile_img_div" style=" height:500px; overflow:scroll;width: 280px !important;">

                            <table class="table table-striped" style="width:280px;">
                                <tbody>
                                    <?php foreach ($user_profile['data'] as $t) { ?>
                                        <tr>
                                            <td style="border-top:none;width: 50px; padding:0;">
                                                <img class="coment" src="https://graph.facebook.com/<?php echo $t['id']; ?>/picture">
                                            </td>
                                            <td style="border-top:none;">
                                                <b class="site"><?php echo $t['name']; ?></b>
                                            </td>
                                            <td style="border-top:none;">
                                                <input type="checkbox" id="<?php echo $t['id']; ?>" class="inv_fr"/>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    <?php }*/ ?>
                    
                    <?php ?>
                    
                    <div class="profile_img_div" style="margin-top: 10px;">
                        <table class="table table-striped" style="width:400px; margin:0;">
                            <tbody>
                                <tr>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border-top:none;padding:0;">
                                        <a class="btn btn-fac" href="<?php echo Yii::app()->createUrl("profile/twi"); ?>"><i class="icon-twitter"></i>Invite Twitter Friends <b class="right-caret">〉</b></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="profile_img_div" style="margin-top: 10px;">
                        <table class="table table-striped" style="width:400px; margin:0;">
                            <tbody>
                                <tr>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border-top:none;padding:0;">
                                        <a class="btn btn-fac" href="<?php echo Yii::app()->createUrl("profile/gmail"); ?>"><i class="icon-google-plus"></i>Invite Gmail Contacts <b class="right-caret">〉</b></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                   
            </div><!--end first-block-->
                    
            <div class="second-block">
                <h4>Link Accounts</h4>
                <?php if ($model->facebook_id) {
          //$info = file_get_contents("https://graph.facebook.com/v2.0/" . $model->facebook_id . "?fields=name");
          //$res = json_decode($info);
          //if ($res->name) {
        ?>
                        <div class="profile_img_div" style="margin-top: 10px;">
                            <span class="login-span" style="font-size:12px; line-height:14px;color:#000;">
                            <i class="icon-facebook line-h"></i>
                            <img src="https://graph.facebook.com/<?php echo $model->facebook_id; ?>/picture" class="img-user" />
                                Logged in as: <?php echo $model->facebook; ?>
                            </span>
                            <a class="link-remove" style="width:200px;" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/unconnect_facebook">Unconnect with facebook</a>
                        </div>
                <?php
         // }
        }
        else{
        ?>
            <div class="profile_img_div" style="margin-top: 10px;">
                <table class="table table-striped" style="width:400px; margin:0;">
                    <tbody>
                        <tr>
                            <td style="border-top:none;padding:0;"></td>
                            <td style="border-top:none;padding:0;"></td>
                            <td style="border-top:none;padding:0;"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border-top:none;padding:0;">
                                <a class="btn btn-fac" href="<?php echo Yii::app()->facebook->getLoginUrl(array('scope' => 'publish_stream')); ?>"><i class="icon-facebook"></i>Facebook<b class="right-caret">〉</b></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
                <?php if ($model->twitter_token && $model->twitter_token_secret) {
            if ($twuser) {
        ?>
                    <div class="profile_img_div" style="margin-top: 10px;">
                            <span class="login-span" style="font-size:12px; line-height:14px;color:#000;">
                            <i class="icon-twitter line-h"></i>
                            <img src="<?php echo $twuser->profile_image_url; ?>" class="img-user" />
                            Logged in as: <?php echo $twuser->name . " (@".$twuser->screen_name.")";?>
                            </span>
                            <a class="link-remove" style="width:200px;" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/unconnect_twitter">Unconnect with twitter</a>
                        </div>
                <?php
          }
        }
        else{
        ?>
                    <div class="profile_img_div" style="margin-top: 10px;">
                        <table class="table table-striped" style="width:400px; margin:0;">
                            <tbody>
                                <tr>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border-top:none;padding:0;">
                                        <a class="btn btn-fac" href="<?php echo Yii::app()->request->baseUrl; ?>/profile/tw"><i class="icon-twitter"></i>Twitter<b class="right-caret">〉</b></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
        }
        ?>
            </div><!--end second-block-->
                    
            <div class="theard-block">
            	<div class="dropdown">
  <a class="dropdown-toggle pull-right q_mark" data-toggle="dropdown" href="#">
  <img src="<?=Yii::app()->request->baseUrl?>/img/q_mark.png" />
  </a>
  <div class="dropdown-menu q_mark_dd"  aria-labelledby="dLabel">
    Hi lovelies! Check out our new function: You can now share your style by sharing your saved items with your facebook friends. Do not worry, we will only share all your cool items once a day maximum, with all your saved items shown together in one post neatly. <br /><br />
This is completely spam free, and is made to be a fun function of style sharing with your friends. You can always switch this off in your account settings) <br /><br />
Love, WWS team. <br /> <br />

<a href="javascript:void(0);" onclick="ShareToFBNew(1)" class="btn btn-follow setting_btn">Yes! It’ll be fun!</a>
<a href="javascript:void(0);" onclick="ShareToFBNew(0)" class="btn btn-follow setting_btn">No, I don’t want to have fun</a>
  </div>
</div>
                
                <h4 style="padding:10px 0px;">Sharing Settings</h4>
                <div style="color:#000;">
                  <?php
            $fb=0;
            $fb_sh_img='icon-check.png';
            if(Yii::app()->user->getState('fb_sharing')){
              $fb=Yii::app()->user->getState('fb_sharing');
              if($fb!=0)
                $fb_sh_img='f-icon-check.png';
            }
                    ?>
                    
                  <input type="hidden" name="fb_sharing" value="<?=$fb;?>" id="fb_sharing">
                  <a href="javascript:void(0);" onclick="ShareToFB()" id="fb_share_img"><img src="<?=Yii::app()->request->baseUrl?>/img/<?=$fb_sh_img?>" /></a>  
                   <span>Share to Facebook Timeline</span>
                </div>
            </div><!--end theard-block-->                
        </div>
    </div>
</div>

<script>
  function ShareToFB()
  {
    var val=$('#fb_sharing').val();
    if(val==1)
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/icon-check.png" />');
      $('#fb_sharing').val(0);
    }
    else
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/f-icon-check.png" />');
      $('#fb_sharing').val(1);
    }
    $.ajax({
      url:"<?=Yii::app()->request->baseUrl?>/home/updateUserSharing/"+val,
    });
  }
  
  function ShareToFBNew(flag)
  {
    var val=$('#fb_sharing').val();
    if(val==1 & flag == 1)
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/f-icon-check.png" />');
      $('#fb_sharing').val(0);
    }
    if(val==1 & flag == 0)
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/icon-check.png" />');
      $('#fb_sharing').val(1);
    }
    if(val== 0 & flag == 0)
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/icon-check.png" />');
      $('#fb_sharing').val(1);
    }
    if(val== 0 & flag == 1)
    {
      $('#fb_share_img').html('<img src="<?=Yii::app()->request->baseUrl?>/img/f-icon-check.png" />');
      $('#fb_sharing').val(0);
    }
    $.ajax({
      url:"<?=Yii::app()->request->baseUrl?>/home/updateUserSharing/"+val,
    });
  }
  
  function SetFind(){
    $.ajax({
      url:"<?=Yii::app()->request->baseUrl?>/home/SetFind/",
      success: function(data){
        window.location="<?php echo Yii::app()->facebook->getLoginUrl(array('scope' => 'publish_stream,user_friends')); ?>";
      }
    });
  }
  
  function FollowShop(id)
  {
	  $.ajax({
			url : '<?=Yii::app()->request->baseUrl?>/home/followshop/'+id,
            dataType : 'json',
			success : function(data){
				$('#fb_fr_'+id).html(data.result);
			}
		});
  }
  
  
</script>
