<?php if ($cart) { ?>
    <?php foreach ($cart as $item) { ?>
        <li style="   border-bottom: 1px solid #ddd;width:100%;
        float:left;padding-bottom:5px;margin-bottom:5px;">
            <a>
                <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $item->main_image; ?>" class="dropimg">
                <ul class="block_ul">
                    <li style="float:left;"><b><?php echo $item->title; ?></b></li>
                    <li>
                        <?php
                        $curr_symbol = Yii::app()->params['dc_symbol'];
                        $rate = '1';
                        if (!Yii::app()->user->isGuest) {
                            $curr_symbol = Yii::app()->user->getState('currency_symbol');
                            $rate = Yii::app()->user->getState('currency_rate');
                        }
                        ?>
                        <?php echo $curr_symbol . "  " . $item->price * $rate; ?>
                    </li>
                    <li>QTY <?php echo $item->getQuantity(); ?></li>
                </ul>
                <div class="clear"></div>
            </a>
        </li>
    <?php } ?>
        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shoppingCart" class="all-not2 smalltxt">Check Out</a></li>
    <?php } else { ?>
    <li><a href="javascript:void(0)" class="all-not2 smalltxt">Your cart is currently empty.</a></li>
<?php } ?>










