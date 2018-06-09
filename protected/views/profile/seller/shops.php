<?php

$this->pageTitle=Yii::app()->name . ' -'. $pages->Purchases;
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
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">My Purchases</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellersettings">Account Setting</a></li>
                        
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/sellershops">Shops</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                                                <div class="profile_img_div">
                                                <h3>No Shops Created Yet</h3>
                                                    <a href="#createshop" role="button"  data-toggle="modal" class="btn btn-follow btn-large">
                                                    Create Shop</a>
                                                </div>
                                      <table class="table">
                                                <thead>
                                                    <tr>
                                                      <th>IMAGE</th>
                                                      <th>NAME</th>
                                                      <th>DESCRIPTION</th>
                                                      <th>CATEGORY</th>
                                                      <th>SOCIAL</th>
                                                      <th></th>
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
                                                    <td style="width:300px;">
                                                    Product description ... 
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                    Lorem Ipsum has been the industry's
                                                    </td>
                                                    <td>
                                                    Category A
                                                    </td>
                                                    <td style="width:76px;" class="margin10px">
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/facebook.png"></a>
                                                    <a href=""> <img src="<?= Yii::app()->request->baseUrl ;?>/img/twitter.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/google.png"></a>
                                                    <a href=""><img src="<?= Yii::app()->request->baseUrl ;?>/img/youtube.png"></a>
                                                    
                                                    </td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editshop">
                                                     Edit</a>
                                                     
                                                    <a class="btn btn-follow"
                                                     href="">
                                                     Delete</a>
                                                    
                                                    <a class="btn btn-follow"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">
                                                     Details</a>
                                                     
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
        <div id="editshop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Shop</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                    <div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Shop Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                    </div>
                    
					<div class="profile_img_div social">
                    <label class="site site_bold">Description : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site site_bold">Category : </label>
				    <select>
                    <option>Select Category</option>
                    </select>
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
        <!--============================================ modal===================================================-->
        <!-- Modal -->
        <div id="createshop" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Create Shop</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                 <div class="profile_img_div">
                	<img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Shop Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                    </div>
                    
					<div class="profile_img_div social">
                    <label class="site site_bold">Description : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
                    </div>
                    
                    <div class="profile_img_div">
                    <label class="site site_bold">Category : </label>
				    <select>
                    <option>Select Category</option>
                    </select>
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
                <button class="btn btn-primary btn-follow" >Create</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>

