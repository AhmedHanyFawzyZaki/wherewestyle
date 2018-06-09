<?php
$this->pageTitle = Yii::app()->name . ' - Bank Transfer';
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="javascript:void(0)">
                            <h4>MAKE PAYMENT & PROVIDE TRANSACTION DETAILS</h4>
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse in">

                        <div style="width: 475px;float: left;">
                            <h4 class="accordion-inner" style="font-size: 17px;color: #F62A64;padding-left: 10px;">Step 1: Select Bank To Pay To :</h4>
                            <div class="accordion-inner" style="padding-left: 10px;padding-right: 10px;">
                                <?php if ($banks) { ?>
                                    <?php foreach ($banks as $bank) { ?>
                                        <label for="bank_<?php echo $bank->id; ?>" style="cursor: pointer;text-align: center;width: 126px;border-radius: 4px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;background-color: #F5F5F5;border: 1px solid #E3E3E3;padding: 5px;float: left !important;margin-right: 10px;margin-bottom: 10px;">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?php echo $bank->icon; ?>" style="width: 115px;height: 60px;" /><br />
                                            <input type="radio" bid="<?php echo $bank->id; ?>" name="bname" id="bank_<?php echo $bank->id; ?>" class="bn_ch" bnfo="#bnf_<?php echo $bank->id; ?>" />
                                        </label>
                                    <?php } ?>
                                <?php } ?>
                                <div style="clear: both;"></div>
                            </div>

                            <div style="position: relative;margin-top: 30px;">
                                <?php if ($banks) { ?>
                                    <?php foreach ($banks as $bank) { ?>
                                        <div style="max-width: 420px;min-width: 420px;position: absolute;left: 10px;top: 10px;display: none;border-radius: 4px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;background-color: #F5F5F5;border: 1px solid #E3E3E3;padding: 10px;" class="banks_info" id="bnf_<?php echo $bank->id; ?>">
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Bank Name : </span>
                                                <span><?php echo $bank->name; ?></span>
                                            </div>
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Bank Code : </span>
                                                <span><?php echo $bank->bank_code; ?></span>
                                            </div>
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Account Name : </span>
                                                <span><?php echo $bank->account_name; ?></span>
                                            </div>
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Account Number : </span>
                                                <span><?php echo $bank->account_number; ?></span>
                                            </div>
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Account Type : </span>
                                                <span><?php echo $bank->account_type; ?></span>
                                            </div>
                                            <div style="line-height: 30px;">
                                                <span style="font-weight: bold;font-size: 16px;">Branch Code : </span>
                                                <span><?php echo $bank->branch_code; ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="accordion-inner" style="width: 475px;float: right;overflow: hidden;padding: 0;">

                            <h4 class="accordion-inner" style="font-size: 17px;color: #F62A64;padding-left: 0;">Step 2: Select Bank To Pay From :</h4>
                            <div class="accordion-inner" style="padding-left: 0px;padding-right: 0px;">
                                <?php if ($from_banks) { ?>
                                    <?php foreach ($from_banks as $bank) { ?>
                                        <label for="from_bank_<?php echo $bank->id; ?>" style="cursor: pointer;text-align: center;width: 126px;border-radius: 4px;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;background-color: #F5F5F5;border: 1px solid #E3E3E3;padding: 5px;float: left !important;margin-right: 10px;margin-bottom: 10px;">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/<?php echo $bank->image; ?>" style="width: 115px;height: 60px;" /><br />
                                            <input type="radio" bn="<?php echo $bank->bank_name; ?>" bnk="<?php echo $bank->internet_banking_nickname; ?>" name="fbname" id="from_bank_<?php echo $bank->id; ?>" class="frb_ch" />
                                        </label>
                                    <?php } ?>
                                <?php } ?>
                                <div style="clear: both;"></div>
                            </div>

                            <h4 class="accordion-inner" style="font-size: 17px;color: #F62A64;padding-left: 0;">Step 3:  After Making Payment, Submit Transaction Details :</h4>
                            <div class="well" style="position: relative;">

                                <div>
                                    <?php
                                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                        'id' => 'orders-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                                    ));
                                    ?>
                                    <div style="margin-top: 15px;">
                                        <?php echo $form->errorSummary($model); ?>
                                    </div>
                                    <input type="hidden" name="BankTransfers[bank_account_id]" id="acc_id2" value="" />
                                    <label>Internet Banking Nickname</label>
                                    <?php echo $form->textField($model, 'internet_banking_nickname', array('class' => 'input-xlarge', 'id' => 'ibn_tf')); ?>
                                    <label style="margin-top: 15px;">Bank Name</label>
                                    <?php echo $form->textField($model, 'bank_name', array('class' => 'input-xlarge', 'id' => 'bn_tf')); ?>
                                    <label style="margin-top: 15px;">Transaction Date</label>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'attribute' => 'transaction_date',
                                        'model' => $model,
                                        'options' => array(
                                            'showAnim' => 'fold',
                                            'dateFormat' => 'yy-mm-dd',
                                        ),
                                        'htmlOptions' => array(
                                            'readonly' => true,
                                            'id' => 'cin',
                                            'class' => 'input-xlarge',
                                        ),
                                    ));
                                    ?>
                                    <label style="margin-top: 15px;">Transaction Time</label>
                                    <div>
                                        <select name="BankTransfers[transaction_hour]" style="width: 80px;float: left;">
                                            <option value="">hh</option>
                                            <?php for ($i = 0; $i < 24; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style="float: left;margin: 8px 10px;"> : </span>
                                        <select name="BankTransfers[transaction_minute]" style="width: 80px;float: left;">
                                            <option value="">mm</option>
                                            <?php for ($i = 1; $i < 60; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <label style="margin-top: 15px;">Transaction Reference No.</label>
                                    <?php echo $form->textField($model, 'transaction_reference_no', array('class' => 'input-xlarge')); ?>
                                    <label style="margin-top: 15px;">Amount Transfered ( SGD )</label>
                                    <?php echo $form->textField($model, 'amount_transfered', array('class' => 'input-xlarge')); ?>
                                    <label style="margin-top: 15px;">Upload Receipt</label>
                                    <?php echo $form->fileField($model, 'receipt'); ?>
                                    <div style="color: red;margin-top: 4px;">(image type: jpg/png/gif/bmp)</div>
                                    <label style="margin-top: 15px;">Other Info</label>
                                    <?php echo $form->textArea($model, 'other_info', array('class' => 'input-xlarge', 'style' => 'height:100px;')); ?>
                                    <input type="hidden" name="type" value="" id="pm_type" />
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary btn-follow pmt" pm_type="paypal">Submit Details</button>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                </div>

                            </div>
                        </div>
                        <div style="clear: both;"></div>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<?php
Yii::app()->clientScript->registerScript('bnfo', '
    $(".bn_ch").change(function(){
        ch($(this));
    });
    
    function ch(ths){
        if(ths.is(":checked")){
            $("#acc_id2").val(ths.attr("bid"));
            $(".banks_info").hide();
            $(ths.attr("bnfo")).show();
        }
    }
    
    $(".frb_ch").change(function(){
        var ths = $(this);
        $("#ibn_tf").val(ths.attr("bnk"));
        $("#bn_tf").val(ths.attr("bn"));
    });
    
    
');
?>