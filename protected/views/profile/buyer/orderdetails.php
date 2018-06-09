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
                        <li ><a href="<?= Yii::app()->request->baseUrl; ?>/profile/BuyerProfile">Profile</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyermessages">Messages</a></li>
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyerorders">My Purchases</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyersettings">Account Setting</a></li>
                </ul>
            </div>
            
            <div class="span9">
                <h4>Order number : <span class="site">12452</span></h4>
                <h4>Order Date : <span class="site">22 JUN 2013 22:45</span></h4>
                                                <div class="profile_img_div">
													<a class="btn btn-follow" href=""><i class="icon-white icon-eye-close"></i> Refund</a>
                                                    <a href="#contactSeller" role="button"  data-toggle="modal" class="btn btn-follow">
                                                    <i class="icon-white icon-comment"></i> Contact seller</a>
                                                    <a class="btn btn-follow" href=""><i class="icon-white icon-print"></i> Print invoice</a>
                                                </div>
                            					 <table class="table">
                                                <thead>
                                                    <tr>
                                                      <th>ITEM</th>
                                                      <th>NAME</th>
                                                      <th>SHOP</th>
                                                      <th>PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>shop name</td>
                                                    <td>$ 125</td>
                                                </tr>
                                                                                                <tr>
                                                    <td>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" 
                                                        class="" width="70px" height="100px" alt="" title=""/>
                                                    </td>
                                                    <td>product name</td>
                                                    <td>shop name</td>
                                                    <td>$ 125</td>
                                                </tr>
 
                                                   
                                                </tbody>
                                                </table>  
                                                <h3 style="float:right;">TOTAL: <span class="site">$ 1252</span></h3>
                                                <div class="profile_img_div">
													<a class="btn btn-follow" style="float:right;"
                                                     href="<?= Yii::app()->request->baseUrl; ?>/profile/BuyerOrders">
                                                     <i class="icon-white icon-repeat"></i>
                                                     Back</a>
                                                </div>
                                        
            </div>

</div>		     
</div>
</div>

        <!--============================================ modal===================================================-->
        <!-- Modal -->
        <div id="contactSeller" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
                    
                    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Contact seller</h3>
            </div>
            <form class="form-vertical">
            <div class="modal-body login_sys">
                <div class="control-group">
                    <label class="control-label" for="inputtxt">Subject</label>
                    <div class="controls">
					<input id="inputtxt" type="text"  name=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputmsg">Subject</label>
                    <div class="controls">
					<textarea id="inputmsg" name="" cols="50" role="20"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Send</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
            </form>
        </div>