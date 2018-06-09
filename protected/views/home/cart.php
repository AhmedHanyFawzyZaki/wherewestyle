<?php
$this->pageTitle = Yii::app()->name . ' - Shopping Cart';
?>



<?php
if ($action == 1) {/// package added
    $msg = '<div class="alert alert-success">Item has been added successfully</div>';
}
if ($action == 2) {/// package removed
    $msg = '<div id="removed_message" class="alert alert-danger">Item has been removed successfully</div>';
}
if ($action == 4) {
    $msg = 'Invalid Discount code.';
}
if ($action == 5) {
    $msg = 'This Discount code is no longer available';
}
if ($action == 6) {
    $msg = 'You have discount by ' . $discount->percentage . '%';
}
?>


<?php
Yii::app()->clientScript->registerScript('coup', '
    $(".coup").click(function(){
        var sid = $(this).attr("sid");
        var x = $("#coup_code_"+sid).val();
        if(x == ""){
            alert("enter coupon code");
        }else{
            $.ajax({
                url : "' . Yii::app()->createUrl('home/applycoupon/') . '",
                type : "post",
                data : { code:x , shid:sid },
                success : function(data){
                    if(data == "error"){
                        alert("This code does not exist");
                    }else if(data == "error2"){
                        alert("This code already has been used allowed number of times");
                    }else if(data == "error3"){
                        alert("you have already used this coupon for this shop");
                    }else if(data == "done"){
                        parent.location.href = "' . Yii::app()->request->baseUrl . '/home/shoppingCart";
                    }
                }
            });
        }
    });
');
?>



<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid"> 
                <?php $position = Yii::app()->shoppingCart->isEmpty(1); ?>
                <?php if ($position == 1) { ?>
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>No items in your shopping cart</th>
                            </tr>
                        </thead>
                    </table>
                <?php } else { ?>
                    <table class="table table-striped table-condensed cart-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Item price</th>
                                <th>Quantity</th>
                                <th>Delete Item</th>
                            </tr>
                        </thead>
                        <?php foreach ($shops as $shop) { ?>
                            <thead>
                                <tr>
                                    <th colspan="2" style="color: #F62A64;"><h3><?php echo $shop->title; ?></h3></th>
                            <th colspan="2" style="padding-left: 0px !important;">
                            <div class="input-append">                                                                                       
                                <input type="text" class="span10" id="coup_code_<?php echo $shop->id; ?>" name="discount_code" value="<?php echo $_POST['discount_code'] ?>"/>
                                <button type="submit" sid="<?php echo $shop->id; ?>" class="btn coup">APPLY COUPON</button>
                            </div>
                            </th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php
                                $curr_symbol = Yii::app()->params['dc_symbol'];
                                $rate = '1';
                                if (!Yii::app()->user->isGuest) {
                                    $curr_symbol = Yii::app()->user->getState('currency_symbol');
                                    $rate = Yii::app()->user->getState('currency_rate');
                                }
                                ?>
                                <?php foreach ($cart as $item) { ?>
                                    <?php if ($item->shop_id == $shop->id) { ?>
                                        <tr>
                                            <td>
                                                <img class="cart_img" src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?= $item->main_image; ?>"> 
                                                <span><?php echo $item->title; ?></span>
                                            </td>
                                            <td>
                                                <?php echo $curr_symbol . "  " . $item->price * $rate; ?>
                                            </td>
                                            <td class="quant">
                                                <div class="qty">
                                                    <a class="previous" style="cursor: pointer;font-size: 23px;" onClick="UpdateQuantityDown(<?= $item->id; ?>,<?= $item->price; ?>)">-</a>
                                                    <input type="text" id="textb<?= $item->id; ?>" name="quantity" class="input-mini" 
                                                           style="margin-bottom: 0px !important;text-align: center;" value="<?= $item->getQuantity(); ?>" disabled>
                                                    <a class="next" style="cursor: pointer;font-size: 23px;" id="minus" onClick="UpdateQuantityUp(<?= $item->id; ?>,<?= $item->price; ?>)">+</a>
                                                </div>
                                            </td>
                                            <td class="last-one">
                                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/Cart/<?= $item->id ?>?action=remove"><span class="badge badge-important">x</span></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        <?php } ?>
                        <tfoot>
                            <tr>
                                <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/home" class="btn btn-large">Continue Shopping</a></td>
                                <td class="tprice"> 
                                    <span class="">Total Discount</span>  <span id="total_disc" class="numbr"><?php
                                        echo $curr_symbol . ' ';
                                        if (isset($_SESSION['discount'])) {
                                            echo $_SESSION['discount'];
                                        } else {
                                            echo '0';
                                        }
                                        ?></span></td>
                                <td class="tprice"><span class="">Total Price</span>  <span id="total_price" class="numbr"><?php
                                        echo $curr_symbol . " " . Helper::shopping_cost();
                                        ?></span></td>
                                <td>
                                    <?php
                                    $str = 'href="' . Yii::app()->request->baseUrl . '/home/checkout"';
                                    if (Yii::app()->user->isGuest) {
                                        $str = 'href="#login" role="button"  data-toggle="modal"';
                                    }
                                    ?>
                                    <a class="btn btn-follow cont-bt" <?php echo $str; ?>>Proceed CheckOut</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>


                <?php } ?>

            </div>

        </div>

    </div>
</div>




<script>
    function UpdateQuantityUp(flagid, price) {
        var x = document.getElementById('textb' + flagid).value;
        //x = parseInt(z);    
        var quantity = (+x + 1);
        //    var id = <?= $item->id; ?>;
        //var price = document.getElementById('actprice'+flagid).value;
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl; ?>/home/updateCart?quantity=" + quantity + "&id=" + flagid,
            type: 'GET',
            dataType: "json",
            success: function(data)
            {
                if (data.cost != 0) {
                    total = parseFloat(data.cost); //+ parseFloat(cost);
                    document.getElementById('total_price').innerHTML = '<?php echo $curr_symbol; ?> ' + total;
                    document.getElementById('header_cost').innerHTML = '<?php echo $curr_symbol; ?> ' + total;
                    document.getElementById('total_disc').innerHTML = '<?php echo $curr_symbol; ?> ' + data.discount;
                    document.getElementById('textb' + flagid).value = quantity;
                } else {
                    alert('sorry  we can not supply more items from this product currently')
                }
            }
        });
    }

</script>


<script>

    function UpdateQuantityDown(flagid, price)
    {
        var x = document.getElementById('textb' + flagid).value;
        if (x <= 1) {
        } else {
            var quantity = document.getElementById('textb' + flagid).value = (x - 1);
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl; ?>/home/updateCart?quantity=" + quantity + "&id=" + flagid,
                type: 'GET',
                dataType: "json",
                success: function(data)
                {
                    total = parseFloat(data.cost);// + parseFloat(cost);
                    document.getElementById('total_price').innerHTML = '<?php echo $curr_symbol; ?> ' + total;
                    document.getElementById('header_cost').innerHTML = '<?php echo $curr_symbol; ?> ' + total;
                    document.getElementById('total_disc').innerHTML = '<?php echo $curr_symbol; ?> ' + data.discount;
                }
            });
        }
    }

    function test(itemID)
    {
        var v = document.getElementById('test' + itemID);
        v.className = "";
        v.innerHTML = '';
    }

</script>