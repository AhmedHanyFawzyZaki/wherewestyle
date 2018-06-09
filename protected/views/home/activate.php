<?php
$this->pageTitle = Yii::app()->name . ' - Activate Account';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <div class="map" style="height: 100px;">
                    <h3 style="text-align: center;margin-top: 50px;"> Your account has been activated successfully. </h3>
                    
                    <div class="profile_img_div" style="margin-top: 20%;clear:both;width:35%;margin-left:30%;margin-bottom: 15%;">
                        <table class="table table-striped" style="width:400px; margin:0;">
                            <tbody>
                                <tr>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                    <td style="border-top:none;padding:0;"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border-top:none;padding:0;">
                                        <a class="btn btn-fac" href="<?php echo Yii::app()->facebook->getLoginUrl(array('scope' => 'publish_stream,user_friends')); ?>"><i class="icon-facebook"></i>Link Your Facebook Account To <strong>Where we style.com</strong><b class="right-caret">〉</b></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

