
<?php 
    if($users){ 
        foreach($users as $user){ ?>
            
                <div class="row-fluid shops-banners shops">
	                    		<div class="span12 shop-list">
						    	 <div class="span4">
						 <a href="#"><img src='<?php echo Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $user->image; ?>'></a>
						        	 <a href="#" class="fav"><img src='<?php echo Yii::app()->request->baseUrl; ?>/img/fav.png'></a>
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
						                <a class="fb" href="#"><img src='<?php echo Yii::app()->request->baseUrl; ?>/img/fb.png'></a>
						                <a class="tw" href="#"><img src='<?php echo Yii::app()->request->baseUrl; ?>/img/tw.png'></a>
						             </div>
						          </div>
						          <div class="span6" style="margin-top:20px;">
						          	  <span class="shops-name"><?php echo $user->username; ?></span>
                                      <a href="#" class="disc"><?= $user->fname.'  '.$user->lname;?></a>
						              <a href="#" class="disc"><?php echo $user->email; ?></a>
						          </div> 
						          <div class="span2" style="float:right">
						                <!--<div class=" btn btn-warning" style="width:100px;">buy now</div>-->
						          </div>   
						          
						      </div></div>  
            
    <? } }
?>