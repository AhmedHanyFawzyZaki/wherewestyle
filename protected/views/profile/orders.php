<?php
$this->pageTitle = Yii::app()->name . ' - Orders';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>DATE</th>
                                <th>ORDER NUMBER</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php if($orders){ ?>
								<?php foreach($orders as $order){ ?>
                                    <tr>
                                        <td><?php echo $order->order_date; ?></td>
                                        <td><?php echo $order->id; ?></td>
                                        <td><?php echo $order->status->status; ?></td>
                                        <td>
                                        	<a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/orderDetails/<?php echo $order->id; ?>">Details</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>  


                </div>

            </div>		     
        </div>
    </div>

