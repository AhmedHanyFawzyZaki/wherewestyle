<?php

$this->pageTitle=Yii::app()->name . ' - Messages';
?>


<div class="row-fluid">
<div class="container body-cont">
<div class="item-page">  
<h3 class="contitle lspace">Welcome <span class="site capitalize"><?= Yii::app()->user->username; ?></span></h3>
<div class="row-fluid">

            <div class="span3 user_controls">
                <ul class="nav nav-list">
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerProfile">Profile</a></li>
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellermessages">Messages</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellerorders">My Purchases</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/Sellersettings">Account Setting</a></li>
                        
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/sellershops">Shops</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerPayouts">Payouts</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerCoupons">Copons</a></li>
                </ul>
            </div>
            
            <div class="span9">
                                      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>DATE</th>
                                              <th>SENDER</th>
                                              <th></th>
                                              <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr class="activetr">
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        <tr>
                                            <td> 22 JUN 2013 22:45</td>
                                            <td>Sender name</td>
                                            <td><a class="btn btn-follow"
                                            href="<?= Yii::app()->request->baseUrl; ?>/profile/SellerMessageDetails"><i class="icon-white icon-eye-open"></i> View</a>
                                            </td>
                                            <td><a class="btn btn-follow"
                                            href=""><i class="icon-white icon-remove"></i> Delete</a></td>
                                        </tr>
                                        
                                        
                                        
                                        
                                                                             
                                        </tbody>
                                        </table>  
                                        
                                        
            </div>

</div>		     
</div>
</div>

