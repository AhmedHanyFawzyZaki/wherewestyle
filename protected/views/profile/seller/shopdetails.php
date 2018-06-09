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
                        
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/sellershops">Shops</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                <h4>Shop : <span class="site">Shop A</span></h4>
                <h4>Category : <span class="site">Category A</span></h4>
                                                <div class="profile_img_div">
                                                <h3>No Products in these shop Yet</h3>
                                                    <a href="#addproduct" role="button"  data-toggle="modal" class="btn btn-follow btn-large">
                                                    Add product</a>
                                                </div>
                            					 <table class="table">
                                                <thead>
                                                    <tr>
                                                      <th>ITEM</th>
                                                      <th>NAME</th>
                                                      <th>PRICE</th>
                                                      <th>SALE</th>
                                                      <th></th>
                                                      <th></th>
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
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
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editproduct">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                     <a class="btn btn-follow"
                                                     href="">
                                                     Deactivate</a>
                                                     
                                                    </td>
                                                </tr>
                                               
 
                                                   
                                                </tbody>
                                                </table>  
                                        
            </div>

</div>		     
</div>
</div>
        <!--============================================ modal===================================================-->
        <!-- Modal -->
        <div id="addproduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Add Product</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                 <div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Product Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                    </div>
                    
					<div class="profile_img_div social">
                    <label class="site site_bold">Price : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
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

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Add</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>
        <!--============================================ modal===================================================-->
        <!-- Modal -->
        <div id="editproduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Product</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                 <div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Product Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                    </div>
                    
					<div class="profile_img_div social">
                    <label class="site site_bold">Price : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
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

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Save</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>
