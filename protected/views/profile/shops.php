<?php
$this->pageTitle = Yii::app()->name . ' - Shops';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span9">

                    <div class="profile_img_div">
                        <?php if (!$shops) { ?>
                            <h3>No Shops Created Yet</h3>
                        <?php } ?>
                        <a href="<?= Yii::app()->request->baseUrl; ?>/profile/createshop" class="btn btn-follow btn-large">Create Shop</a>
                    </div>
                    <?php if ($shops) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>SOCIAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($shops as $shop) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/shops/thumbs_266X300/<?php echo $shop->image; ?>" width="70px" height="100px" alt="" title=""/>
                                        </td>
                                        <td style="width:300px;"><?php echo $shop->title; ?></td>
                                        <td style="width:76px;" class="margin10px">
                                            <?php $flag = true; ?>
                                            <?php if ($shop->facebook) { ?>
                                                <a href="<?php echo $shop->facebook; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                                                <?php $flag = false; ?>
                                            <?php } ?>
                                            <?php if ($shop->twitter) { ?>
                                                <a href="<?php echo $shop->twitter; ?>"> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                                                <?php $flag = false; ?>
                                            <?php } ?>
                                            <?php if ($shop->googleplus) { ?>
                                                <a href="<?php echo $shop->googleplus; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                                                <?php $flag = false; ?>
                                            <?php } ?>
                                            <?php if ($shop->youtube) { ?>
                                                <a href="<?php echo $shop->youtube; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                                                <?php $flag = false; ?>
                                            <?php } ?>
                                            <?php if ($flag) { ?>
                                                No social links for this shop
                                            <?php } ?>

                                        </td>

                                        <td class="margin10px">
                                            <a class="btn btn-follow" role="button"  data-toggle="modal" href="<?= Yii::app()->request->baseUrl; ?>/profile/editshop/<?php echo $shop->id; ?>">Edit</a>

                                            <a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/deleteshop/<?php echo $shop->id; ?>">Delete</a>

                                            <a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/shopdetails/<?php echo $shop->id; ?>">Details</a>
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

