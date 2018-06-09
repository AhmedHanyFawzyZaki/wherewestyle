<?php
$this->pageTitle=Yii::app()->name . ' -'. $pages->Message;
?>

<div class="row-fluid">
<div class="container body-cont">
<div class="item-page">  
<h3 class="contitle lspace">Welcome <span class="site capitalize"><?= Yii::app()->user->username; ?></span></h3>
<div class="row-fluid">

            <div class="span3 user_controls">
                <ul class="nav nav-list">
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/BuyerProfile">Profile</a></li>
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyermessages">Messages</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyerorders">My Purchases</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Buyersettings">Account Setting</a></li>
                </ul>
            </div>
            
            <div class="span9">
                <h4>Sender : <span class="site">Sender Name</span></h4>
                <h4>Date : <span class="site">22 JUN 2013 22:45</span></h4>
                
                                      <table class="table">
                                        <thead>
                                        </thead>
                                        <tbody>                                     
                                        <tr>
                                            <td><img src='<?= Yii::app()->request->baseUrl; ?>/img/user.png' class="msg_user"/></td>
                                            <td>
                                            <span class="msg_txt">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                                                the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                                                galley of type and scrambled it to make a type specimen book. It has survived not only five 
                                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            </span>
                                            </td>
                                        </tr>
                                                                                <tr>
                                            <td><img src='<?= Yii::app()->request->baseUrl; ?>/img/user.png' class="msg_user"/></td>
                                            <td>
                                            <span class="msg_txt">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                                                the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                                                galley of type and scrambled it to make a type specimen book. It has survived not only five 
                                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            </span>
                                            </td>
                                        </tr>                        
                                        </tbody>
                                        </table>  
                                                
                                                <div class="profile_img_div">
                                                <form class="form-vertical">
                                                    <div class="control-group">
                                                        <div class="controls">
                                                        <textarea id="inputmsg" name="" cols="50" role="20" class="width300px"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <div class="controls">
                                                        <button class="btn btn-follow" ><i class="icon-white icon-comment"></i> Reply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                                
                                                
                                                
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