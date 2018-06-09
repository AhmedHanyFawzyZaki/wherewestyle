<?php
$this->pageTitle = Yii::app()->name . ' - Checkout';
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="javascript:void(0)">
                            <h4>Add Shipping Address</h4>
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse in">
                        <div class="accordion-inner">
                            <div class="well">
                                <?php
                                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                    'id' => 'orders-form',
                                    'enableAjaxValidation' => false,
                                    'htmlOptions' => array('class' => 'form-horizontal'),
                                ));
                                ?>

                                <div style="margin-top: 15px;">
                                    <?php echo $form->errorSummary($model); ?>
                                </div>

                                <div style="margin-top: 15px;">
                                    <label>First Name</label>
                                    <?php echo $form->textField($model, 'first_name', array('class' => 'input-xlarge', 'value' => Yii::app()->user->getState('fname'))); ?>
                                </div>
                                <div style="margin-top: 15px;">
                                    <label>Last Name</label>
                                    <?php echo $form->textField($model, 'last_name', array('class' => 'input-xlarge', 'value' => Yii::app()->user->getState('lname'))); ?>
                                </div>
                                <div style="margin-top: 15px;">
                                    <label>Email</label>
                                    <?php echo $form->textField($model, 'email', array('class' => 'input-xlarge', 'value' => Yii::app()->user->getState('email'))); ?>
                                </div>
                                <div style="margin-top: 15px;">
                                    <label>Address</label>
                                    <?php echo $form->textField($model, 'address', array('class' => 'input-xlarge')); ?>
                                </div>
                                <div style="margin-top: 15px;">
                                    <label>Phone</label>
                                    <?php echo $form->textField($model, 'phone', array('class' => 'input-xlarge')); ?>
                                </div>
                                <div style="margin-top: 15px;">
                                    <label>Select your Country</label>
                                    <?php echo $form->dropDownList($model, 'country_id', AllCountries::model()->getCountries(), array('class' => 'input-xlarge','onchange'=>'ToggleSin(this.value)')); ?>
                                    <input type="hidden" name="type" value="" id="pm_type" />
                                </div>
                                <!--<div style="margin-top: 15px;">
                                    <label style="line-height: 30px;"><input checked name="save_shipping_data" type="checkbox" style="margin-top: -2px;margin-right: 8px;" />Save this data as my shipping details.</label>
                                </div>-->
                                <div style="margin-top: 20px;" id="append_save">
                                	<button type="button" onclick="SaveShipping()" class="btn btn-primary btn-follow pmt" style="top: 0;float: right;margin-right: 10px;">Save this data as my shipping details</button>

                                    <button type="submit" class="btn btn-primary btn-follow pmt" pm_type="paypal" style="top: 0;float: left;margin-right: 10px;">Pay with Paypal/ Credit Card</button>

                                    <?php if ($country_flag==false || $model->country_id=='189') { ?>
                                        <div style="float: left;width: 180px;" id="sin">
                                            <input type="submit" class="btn btn-primary btn-follow pmt" pm_type="bank_transfer" value="Pay With Bank Transfer"><span style="margin-left: 8px;">(Recommended: Only for Singapore users)</span>
                                        </div>
                                    <?php }else{
                                            ?>
                                            <div style="float: left;width: 180px; display:none;" id="sin">
                                            <input type="submit" class="btn btn-primary btn-follow pmt" pm_type="bank_transfer" value="Pay With Bank Transfer"><span style="margin-left: 8px;">(Recommended: Only for Singapore users)</span>
                                        </div>
                                        <?
					}?>
                                    <div style="clear: both;"></div>
                                </div>
                                <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<script>
	function ToggleSin(val)
	{
            if(val==189)
            {
                $('#sin').css('display','block');
            }
            else
            {
                $('#sin').css('display','none');
            }
	}
	
	function SaveShipping(){
		var phone=$('#Orders_phone').val();
		var address=$('#Orders_address').val();
		var country=$('#Orders_country_id').val();
		if(phone!='' && address !='' && country!='')
		{
			$.ajax({
				url:"<?=Yii::app()->request->baseUrl?>/home/saveShipping?address="+address+"&phone="+phone+"&country="+country,
				success: function(data){
					if(data=='1'){
						$('#append_save').append('<div id="app_sh" class="alert-success well TopMargin20">Your shipping details have been saved successfully</div>');
						setTimeout(function(){$('#app_sh').remove();},1500);
					}
				}
			});
		}
		else
		{
			alert("Please enter your shipping info then press save!");
		}
	}
	
</script>
<?php
Yii::app()->clientScript->registerScript('pm_type', '
    $(".pmt").click(function(){
        $("#pm_type").val($(this).attr("pm_type"));
    });
');
?>