<?php
$this->pageTitle = Yii::app()->name . ' - Coupons';
?>

<?php
$curr_symbol = Yii::app()->params['dc_symbol'];
$rate = '1';
if (!Yii::app()->user->isGuest) {
    $curr_symbol = Yii::app()->user->getState('currency_symbol');
    $rate = Yii::app()->user->getState('currency_rate');
}
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <div class="profile_img_div">
                        <?php if (!$coupons) { ?>
                            <h3>No Coupons Created Yet</h3>
                        <?php } ?>
                        <a href="#createcopon" role="button" data-toggle="modal" class="btn btn-follow btn-large">Create Coupon</a>
                    </div>
                    <?php if ($coupons) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NUMBER</th>
                                    <th>DISCOUNT</th>
                                    <th>USERS</th>
                                    <th>USED NUMBER</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coupons as $coupon) { ?>
                                    <tr>
                                        <td><?php echo $coupon->code; ?></td>
                                        <td>
                                            <?php
                                            $sign = "%";
                                            $dis_val = $coupon->discount;
                                            if($coupon->type){
                                                $sign = $curr_symbol;
                                                $dis_val = $coupon->discount * $rate;
                                            }
                                            echo $dis_val." ".$sign; 
                                            ?>
                                        </td>
                                        <td><?php echo $coupon->redem_num; ?> users</td>
                                        <td><?php echo $coupon->used_num; ?> time(s)</td>
                                        <td class="margin10px">
                                            <a class="btn btn-follow" role="button"  data-toggle="modal"
                                               href="#editcopon-<?php echo $coupon->id; ?>">
                                                Edit</a>

                                            <a class="btn btn-follow"
                                               href="<?= Yii::app()->request->baseUrl; ?>/profile/deletecoupon/<?php echo $coupon->id; ?>">
                                                Delete</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>   
                    <?php } ?>

                </div>

            </div>		     
        </div>
    </div>

    <!--============================================ modal===================================================-->
    <!-- Modal -->

    <?php if ($coupons) { ?>
        <?php foreach ($coupons as $cop) { ?>
            <div id="editcopon-<?php echo $cop->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
                 aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Edit Coupon</h3>
                </div>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'edit-form-' . $cop->id,
                    'action' => Yii::app()->createUrl('/profile/editcoupon/' . $cop->id),
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
                    <div class="profile_img_div">
                        <label class="site site_bold">Coupon Number : </label>
                        <?php echo $form->textField($cop, 'code', array('placeholder' => "Coupon Number ...")); ?>
                    </div>
                    <div class="profile_img_div">
                        <label class="site site_bold">Type : </label>
                        <?php echo $form->dropDownList($cop, 'type', array('1' => 'Flat Fee', '0' => 'Percentage')); ?>
                    </div>
                    <div class="profile_img_div">
                        <label class="site site_bold">Coupon Discount : </label>
                        <?php
                        $val = $cop->discount;
                        if($cop->type){
                            $val = $cop->discount * $rate;
                        }
                        ?>
                        <?php echo $form->textField($cop, 'discount', array('placeholder' => "Coupon Discount ...",'value' => $val)); ?>
                    </div>
                    <div class="profile_img_div">
                        <label class="site site_bold">Coupon number of users : </label>
                        <?php echo $form->textField($cop, 'redem_num', array('placeholder' => "Coupon Users ...")); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    echo CHtml::ajaxSubmitButton(
                            'Save', array('/profile/editcoupon/' . $cop->id), array(
                        'beforeSend' => 'function(){ 
                            	$("#edit-' . $cop->id . '").attr("disabled",true);
            				}',
                        'complete' => 'function(){ 
                            	$("#edit-form-' . $cop->id . '").each(function(){ this.reset();});
                            	$("#edit-' . $cop->id . '").attr("disabled",false);
                            }',
                        'success' => 'function(data){  
								if(data == "wrong"){
									$("#edit-error-div").show();
									$("#edit-error-div").html("<h4>an error occured , please try again</h4>");
									$("#edit-error-div").append("");
								}else{
									$("#edit-form-' . $cop->id . '").html("<h4>the coupon was successfully updated ! Please Wait...</h4>");
									parent.location.href = "' . Yii::app()->request->baseUrl . '/profile/coupons";
								}
                            }'), array("id" => "edit-" . $cop->id, "class" => "btn btn-primary btn-follow")
                    );
                    ?>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        <?php } ?>
    <?php } ?>
    <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="createcopon" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="true">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Create Coupon</h3>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'create-form',
            'action' => Yii::app()->createUrl('/profile/createcoupon'),
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
            <div class="profile_img_div">
                <label class="site site_bold">Coupon Number : </label>
                <?php echo $form->textField($new, 'code', array('placeholder' => "Coupon Number ...")); ?>
            </div>
            <div class="profile_img_div">
                <label class="site site_bold">Type : </label>
                <?php echo $form->dropDownList($new, 'type', array('1' => 'Flat Fee', '0' => 'Percentage')); ?>
            </div>
            <div class="profile_img_div">
                <label class="site site_bold">Coupon Discount : </label>
                <?php echo $form->textField($new, 'discount', array('placeholder' => "Coupon Discount ...")); ?>
            </div>
            <div class="profile_img_div">
                <label class="site site_bold">Coupon number of users : </label>
                <?php echo $form->textField($new, 'redem_num', array('placeholder' => "Coupon Users ...")); ?>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            echo CHtml::ajaxSubmitButton(
                    'Create', array('/profile/createcoupon'), array(
                'beforeSend' => 'function(){ 
                            	$("#create").attr("disabled",true);
            				}',
                'complete' => 'function(){ 
                            	$("#create-form").each(function(){ this.reset();});
                            	$("#create").attr("disabled",false);
                            }',
                'success' => 'function(data){  
								//var obj = jQuery.parseJSON(data);
								if(data == "wrong"){
									$("#create-error-div").show();
									$("#create-error-div").html("<h4>an error occured , please try again</h4>");
									$("#create-error-div").append("");
								}else{
									$("#create-form").html("<h4>the coupon was successfully created ! Please Wait...</h4>");
									parent.location.href = "' . Yii::app()->request->baseUrl . '/profile/coupons";
								}
                            }'), array("id" => "create", "class" => "btn btn-primary btn-follow")
            );
            ?>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>

