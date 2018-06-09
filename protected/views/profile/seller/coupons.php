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
                        
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellershopdetails">Shops</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li  class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                                                <div class="profile_img_div">
                                                <h3>No Copons Created Yet</h3>
                                                    <a href="#createcopon" role="button"  data-toggle="modal" class="btn btn-follow btn-large">
                                                    Create Copon</a>
                                                </div>
                                      <table class="table">
                                                <thead>
                                                    <tr>
                                                      <th>NUMBER</th>
                                                      <th>SHOP NAME</th>
                                                      <th>PRICE</th>
                                                      <th>STATUS</th>
                                                      <th>USERS</th>
                                                      <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
                                                     5458944
                                                    </td>
                                                    <td>shop A</td>
                                                    <td>150 $</td>
                                                    <td>
                                                    activated
                                                    </td>
                                                    <td>5 users</td>
                                                    <td class="margin10px">
                                                    <a class="btn btn-follow" role="button"  data-toggle="modal"
                                                     href="#editcopon">
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
        <div id="editcopon" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Copon</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                    <div class="profile_img_div">
                    <label class="site site_bold">Copon Number : </label>
                    <label>1254532</label>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Shop Name : </label>
                    <select>
                    <option> select shop</option>
                    </select>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Copon Price : </label>
                    <input type="text" placeholder="Copon Number ..."/> $
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Copon Users : </label>
                    <input type="text" placeholder="Copon users ..."/> (i.e. 5 users)
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Save</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>
        <!--============================================ modal===================================================-->
        <!-- Modal -->
        <div id="createcopon" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Create Copon</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                     <div class="profile_img_div">
                    <label class="site site_bold">Copon Number : </label>
                    <button class="btn btn-follow">Generate</button>
                    <input type="text" style="margin-bottom:0;" placeholder="Copon Number ..."/>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Shop Name : </label>
                    <select>
                    <option>select shop</option>
                    </select>
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Copon Price : </label>
                    <input type="text" placeholder="Copon Number ..."/> $
                    </div>
                    <div class="profile_img_div">
                    <label class="site site_bold">Copon Users : </label>
                    <input type="text" placeholder="Copon users ..."/> (i.e. 5 users)
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Create</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>

