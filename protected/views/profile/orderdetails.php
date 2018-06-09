<?php
$this->pageTitle = Yii::app()->name . ' - Order Details';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <h4>Order number : <span class="site"><?php echo $parent_order->id; ?></span></h4>
                    <h4>Order Date : <span class="site"><?php echo $parent_order->order_date; ?></span></h4>
                    <?php if (Yii::app()->user->id != $order_details[0]->product->shopName->seller->id) { ?>
                        <div class="profile_img_div">
                            <!--<a class="btn btn-follow" href=""><i class="icon-white icon-eye-close"></i> Refund</a>-->
                            <a href="#contactSeller" role="button"  data-toggle="modal" class="btn btn-follow">
                                <i class="icon-white icon-comment"></i> Contact seller</a>
                            <!--<a class="btn btn-follow" href=""><i class="icon-white icon-print"></i> Print invoice</a>-->
                        </div>
                    <?php } ?>
                    <?php
                    $curr_symbol = Yii::app()->params['dc_symbol'];
                    $rate = '1';
                    if (!Yii::app()->user->isGuest) {
                        $curr_symbol = Yii::app()->user->getState('currency_symbol');
                        $rate = Yii::app()->user->getState('currency_rate');
                    }
                    ?>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>ITEM</th>
                                <th>NAME</th>
                                <th>SHOP</th>
                                <th>PRICE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($order_details) { ?>
                                <?php foreach ($order_details as $order) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $order->product->main_image; ?>" class="" width="70px" height="100px" alt="" title=""/>
                                        </td>
                                        <td><?php echo $order->product->title; ?></td>
                                        <td><?php echo $order->product->shopName->title; ?></td>
                                        <td>
                                            <?php echo $curr_symbol . "  " . $order->cost * $rate; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>  
                    <h3 style="float:right;">TOTAL: <span class="site"><?php echo $curr_symbol . "  " . $parent_order->total * $rate; ?></span></h3>
                    <div class="profile_img_div">
                        <a class="btn btn-follow" style="float:right;" href="<?= Yii::app()->request->baseUrl; ?>/profile/orders">
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
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'send-form',
            'action' => Yii::app()->createUrl('/profile/createmessage'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'validateOnChange' => true,
                'validateOnType' => false,
            ),
            'htmlOptions' => array(
                'class' => 'form-vertical',
            ),
        ));
        ?>
        <div class="modal-body login_sys">
            <div class="control-group">
                <label class="control-label" for="inputtxt">Subject</label>
                <div class="controls">
                    <?php echo $form->textField($message, 'subject', array('id' => "inputtxt")); ?>
                </div>
                <?php if ($order_details) { ?>
                    <?php echo $form->hiddenField($message, 'reciever_id', array('value' => $order_details[0]->product->shopName->seller->id)); ?>
                <?php } ?>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputmsg">Message</label>
                <div class="controls">
                    <?php echo $form->textArea($message, 'content', array('id' => "inputmsg", 'cols' => '50', 'role' => '20')); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            echo CHtml::ajaxSubmitButton(
                    'Send', array('/profile/createmessage'), array(
                'beforeSend' => 'function(){ 
                            	$("#send").attr("disabled",true);
            				}',
                'complete' => 'function(){ 
                            	$("#send-form").each(function(){ this.reset();});
                            	$("#send").attr("disabled",false);
                            }',
                'success' => 'function(data){  
								//var obj = jQuery.parseJSON(data);
								if(data == "wrong"){
									$("#send-error-div").show();
									$("#send-error-div").html("<h4>an error occured , please try again</h4>");
									$("#send-error-div").append("");
								}else{
									$("#send-form").html("<h4 style=\"margin-left:10px;\">the message was sent successfully ! Please Wait...</h4>");
                                                                        parent.location.href = "' . Yii::app()->request->baseUrl . '/profile/orderDetails/' . $parent_order->id . '";
									
								}
                            }'), array("id" => "send", "class" => "btn btn-primary btn-follow")
            );
            ?>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>