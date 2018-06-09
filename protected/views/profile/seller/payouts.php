<?php

$this->pageTitle=Yii::app()->name . ' -'. $pages->Details;
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
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellersettings">Account Setting</a></li>
                        
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/sellershops">Shops</a></li>
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                <h4>Shop : <span class="site">Shop A</span></h4>
                <h4>Category : <span class="site">Category A</span></h4>
                            					 <table class="table">
                                                <thead>
                                                    <tr>
                                                      <th>ITEM</th>
                                                      <th>NAME</th>
                                                      <th>PRICE</th>
                                                      <th>SALE</th>
                                                      <th></th>
                                                      <th>
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Delete All</a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>$ 125</td>
                                                    <td>50%</td>
                                                    
                                                     <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td>
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    </td>
                                                </tr>
                                                
                                                
                                                
                                               
 
                                                   
                                                </tbody>
                                                </table>  
                                                <h3 style="float:right;">TOTAL: <span class="site">$ 1252</span></h3>
                                                
                                        
            </div>

</div>		     
</div>
</div>