
<div class="row-fluid shops-banners shops " id="shlist">

    <?php
    if ($shops) {
        foreach ($shops as $shop) {
            ?>

            <div class="span4 shan">
                <a class="shop_link" href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $shop->slug; ?>">
                    <?php
                    $pimage = Yii::app()->request->baseUrl . '/img/' . "default_shop_image.jpg";
                    if ($shop->image) {
                        if (file_exists('media/shops/original/' . $shop->image)) {
                            $pimage = Yii::app()->request->baseUrl . '/media/shops/original/' . $shop->image;
                        }
                    }
                    ?>
                    <img style="width: 320px;" src="<?= $pimage; ?>">
                </a>
                <span class="shop-name"><?= $shop->title; ?></span>  
                <?php $dsc = mb_substr(strip_tags($shop->desc), 0, 25); ?>
                <?php if ($dsc) { ?>
                    <span class="shop-des-quote"><?= $dsc; ?></span>
                <?php } ?>
                <?php if ($shop->store_wide_sale>0) { ?>
                    <span class="percet"><span>ALL<br><?php echo $shop->store_wide_sale; ?>% <br>OFF</span></span>
                <?php } ?>
                <div class="shop-share">
                    <span class="followers flshp_<?php echo $shop->id; ?>"><?= Helper::getShopFollowers($shop->id); ?></span>

                    <a class="fb shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $shop->image; ?>" sname="<?php echo $shop->title; ?>" desc="<?php echo strip_tags($shop->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/shopDetails-<?php echo $shop->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a> 
                    <?php if (Yii::app()->user->isGuest) { ?>
                        <a href="#login" role="button"  data-toggle="modal" class="follow" style="float: right">follow</a>
                    <?php } else { ?>
                        <?php
                        $str = "follow";
                        if (Helper::check_follow_shop($shop->id))
                            $str = "unfollow";
                        ?>
                        <a href="javascript:void(0)" sid='<?php echo $shop->id; ?>' class="follow follow2" style="float: right;"><?php echo $str; ?></a>
                    <?php } ?>
                </div>
            </div>        

            <?php
        }
        ?>
    <?php } else { ?>
        <div style="line-height: 30px;font-size: 20px;margin-bottom: 20px;margin-left: 20px;">There are no shops.</div>
    <?php } ?>
</div>
