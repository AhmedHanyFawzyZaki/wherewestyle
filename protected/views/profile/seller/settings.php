<?php

$this->pageTitle=Yii::app()->name . ' -'. $pages->Profile;
?>


<div class="row-fluid">
<div class="container body-cont">
<div class="item-page">  
<h3 class="contitle lspace">Welcome <span class="site capitalize"><?= Yii::app()->user->username; ?></span></h3>
<div class="row-fluid">

            <div class="span3 user_controls">
                <ul class="nav nav-list">
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerProfile">Profile</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellermessages">Messages</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellerorders">My Purchases</a></li>
                        <li  class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellersettings">Account Setting</a></li>
                        
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/sellershops">Shops</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                    <div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="profile_img"/>
                    <input type="file" class="inputf"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Full Name : </label>
                    <input type="text" placeholder="full name ..."/>
                    </div>
					<div class="profile_img_div social">
                    <label class="site site_bold">E-Mail : </label>
                    <input type="text" placeholder="e-mail ..."/>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site site_bold">Username : </label>
                    <input type="text" placeholder="username ..."/>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site site_bold">Account Type : </label>
                    <label class="radio">
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="" checked>
                    Seller
                    </label>
                    <label class="radio">
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="">
                    Buyer
                    </label>
                    </div>
                    
                    <div class="profile_img_div social">
                    <label class="site site_bold">Social Media : </label>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                    <input type="text" placeholder="facebook url ..."/></div>
                    
                    <div class="profile_img_div social">
                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                    <input type="text" placeholder="twitter url ..."/></div>
                    
                    <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                    <input type="text" placeholder="google+ url ..."/></div>
                    
                    <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                    <input type="text" placeholder="youtube url ..."/></div>
                    
                    
                    <div class="profile_img_div social">
                    <button type="submit" class="btn btn-large btn-follow floatright">save</button>
                    </div>
                    
                    
            </div>

</div>		     
</div>
</div>