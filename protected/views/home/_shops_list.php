<div id="shlist">
    <?php
    if ($shops) {
        foreach ($shops as $shop) {
            ?>
            <div class="row-fluid shops-banners shops shan">
                <div class="span12 shop-list">
                    <div class="span4">
                        <?php
                        $pimage = Yii::app()->request->baseUrl . '/img/' . "default_shop_image.jpg";
                        if ($shop->image){
                            if (file_exists('media/shops/original/' . $shop->image)) {
                                $pimage = Yii::app()->request->baseUrl . '/media/shops/original/' . $shop->image;
                            }
                        }
                        ?>
                        <a class="shops_list_link" href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $shop->slug; ?>"><img src='<?php echo $pimage; ?>'></a>

                        <div class="shop-share">
                            <span class="followers flshp_<?php echo $shop->id; ?>"><?php echo Helper::getShopFollowers($shop->id); ?></span>

                            <a class="fb shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $shop->image; ?>" sname="<?php echo $shop->title; ?>" desc="<?php echo strip_tags($shop->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/shopDetails-<?php echo $shop->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a> 
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button" data-toggle="modal" class="follow" style="float: right">follow</a>
                            <?php } else { ?>
                                <?php
                                $str = "follow";
                                if (Helper::check_follow_shop($shop->id))
                                    $str = "unfollow";
                                ?>
                                <a href="javascript:void(0)" sid='<?php echo $shop->id; ?>' class="follow follow2" style="float: right"><?php echo $str; ?></a>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="span6" style="margin-top:20px;">
                        <span class="shops-name"><?php echo $shop->title; ?></span>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $shop->slug; ?>" class="disc"><?php echo mb_substr(strip_tags($shop->desc), 0, 200); ?></a>
                    </div> 
                    <div class="span2" style="float:right">
                    </div>   

                </div>

            </div>  
            <?php
        }
        ?>
    <?php } else { ?>
        <div style="line-height: 30px;font-size: 20px;margin-bottom: 20px;margin-left: 20px;">There are no shops.</div>
    <?php } ?>
</div>