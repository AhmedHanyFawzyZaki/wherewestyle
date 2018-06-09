<?php
$this->pageTitle = Yii::app()->name . ' - Payouts';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <!--<h4>Shop : <span class="site">Shop A</span></h4>
                    <h4>Category : <span class="site">Category A</span></h4>-->
                    <?php if ($orders) { ?>
                        <?php
                        $curr_symbol = Yii::app()->params['dc_symbol'];
                        $rate = '1';
                        if (!Yii::app()->user->isGuest) {
                            $curr_symbol = Yii::app()->user->getState('currency_symbol');
                            $rate = Yii::app()->user->getState('currency_rate');
                        }
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>NAME</th>
                                    <th>QUANTITY</th>
                                    <th>PRICE</th>
                                    <?php if ($filter == 'all') { ?>
                                        <th>STATUS</th>
                                    <?php } ?>
                                    <th>
                                        <a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/deleteallpayouts?filter=<?php echo $filter; ?>">Delete All</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php foreach ($orders as $order) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $order->product->main_image; ?>" class="" width="70px" height="100px" alt="" title=""/>
                                        </td>
                                        <td><?php echo $order->product->title; ?></td>
                                        <td><?php echo $order->qty; ?></td>
                                        <td>
                                            <?php echo $curr_symbol . "  " . $order->cost * $rate; ?>
                                        </td>
                                        <?php if ($filter == 'all') { ?>
                                            <td>
                                                <?php echo $order->order->status->status; ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/deletepayout/<?php echo $order->id; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $total += $order->cost; ?>
                                <?php } ?>
                            </tbody>
                        </table>  
                        <h3 style="float:right;">TOTAL : <span class="site"><?php echo $curr_symbol . "  " . $total * $rate; ?></span></h3>
                        <?php } else { ?>

                        <?php if ($filter == "completed") { ?>
                            <p>Sorry, you currently have no orders.</p>
                        <?php } else { ?>
                            <p>Sorry, you have no payouts.</p>
                        <?php } ?>
                    <?php } ?>
                </div>

            </div>		     
        </div>
    </div>