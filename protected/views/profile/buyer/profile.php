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
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/BuyerProfile">Profile</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyermessages">Messages</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyerorders">My Purchases</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyersettings">Account Setting</a></li>
                </ul>
            </div>
            
            <div class="span9">
            		<div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="profile_img"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site">Full Name: </label>
                    <label>Lorem Ipsum Lorem</label>
                    </div>
					<div class="profile_img_div social">
                    <label class="site">E-Mail: </label>
                    <label>Lorem@Ipsum.com</label>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site">Username: </label>
                    <label>Lorem</label>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site">Account Type: </label>
                    <label>Buyer</label>
                    </div>
                    
                    <div class="profile_img_div social">
                    <label class="site">Social Media: </label>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                    
                    </div>
                    
            </div>

</div>		     
</div>
</div>