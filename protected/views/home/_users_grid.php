<div class="row-fluid shops-banners shops ">
    
<?php 
    if($users){ 
        foreach($users as $user){ ?>
            
                <div class="span4">
                    <a href="#">
                        <img src="<?=  Yii::app()->request->baseUrl;?>/media/members/original/<?= $user->image ;?>">
                    </a>
                    <span class="shop-name"><?= $user->username ;?></span>                         
                      <span class="shop-des-quote"><?= $user->fname.'  '.$user->lname;?></span>
                         <div class="shop-share">
                            <span class="followers"><?php echo Helper::getUserFollowers($user->id); ?> followers</span>
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button"  data-toggle="modal" class="follow">follow</a>
                            <?php }else{ ?>
                            	<?php
								$str = "follow";
								if(Helper::check_follow_user($user->id))
									$str = "unfollow";
								?>
                                <a href="javascript:void(0)" uid='<?php echo $user->id; ?>' class="follow follow2"><?php echo $str; ?></a>
                            <?php } ?>
                            <a class="fb" href="#"><img src="<?=  Yii::app()->request->baseUrl;?>/img/fb.png"></a>
                            <a class="tw" href="#"><img src="<?=  Yii::app()->request->baseUrl;?>/img/tw.png"></a>
                            
                            
             </div>
                </div>        
            
    <? } }
?>
</div>