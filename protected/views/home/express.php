<script src="<?= Yii::app()->request->baseUrl ?>/js/transit.js"></script>
<script>
    $("document").ready(function() {
        var height = $("#inner_scroll").height();
        var speed = 50000;
        var in_speed = speed;

        $("#inner_scroll").transition({"y": -(height - 320)}, speed);

        $("body").on("click", "#reset", function() {
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": 0});
            $("#inner_scroll").transition({"y": -(height - 320)}, in_speed);
        });

        $("body").on("click", "#pause", function() {
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": 0}, 1000000000);
            $(".media_btn").removeClass("active");
            $(this).addClass("active");
        });

        $("body").on("click", "#play", function() {
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": -(height - 320)}, speed);
            $(".media_btn").removeClass("active");
            $(this).addClass("active");
        });

        $("body").on("click", "#inc", function() {
            speed -= 10000;
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": 0}, 1000000000);
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": -(height - 320)}, speed);
            $(".media_btn").removeClass("active");
            $("#play").addClass("active");
        });
        $("body").on("click", "#dec", function() {
            speed += 10000;
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": 0}, 1000000000);
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": -(height - 320)}, speed);
            $(".media_btn").removeClass("active");
            $("#play").addClass("active");
        });

        $("#scroller").hover(function() {
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": 0}, 1000000000);
            $(".media_btn").removeClass("active");
            $("#play").addClass("pause");
        }, function() {
            $("#inner_scroll").stop();
            $("#inner_scroll").transition({"y": -(height - 320)}, speed);
            $(".media_btn").removeClass("active");
            $("#play").addClass("active");
        });

    });
</script>

<?php if ($products) { ?>

    <div class="container">

        <div class="scroll_controls">
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/play.png" class="media_btn active" id="play" title="play" alt="play"/>
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/pause.png" class="media_btn" title="pause" alt="pause" id="pause"/>
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/inc.png" class="media_btn" title="increase speed" alt="increase speed" id="inc"/>
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/dec.png" class="media_btn" title="decrease speed" alt="decrease speed" id="dec"/>
            <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/reset.png" class="media_btn" title="reset" alt="reset" id="reset"/>
        </div>

    </div>

    <div class="item-page" style="margin-top: 35px;">
        <div id="scroller" style="position: relative;height: 700px;overflow: hidden;">
            <div id="inner_scroll" style="position: absolute;top: 0;">
                <!--
                repeated div auto scroll
                ==============================================================-->
                <?php
                if ($products) {
                    $i = 0;
                    foreach ($products as $product) {
                        if (($i % 4) == 0) {
                            echo '<div class="row-fluid scroll-item">';
                        }
                        ?>
                        <div class="span3">
                        	<div class="prod_div">
                            <?php
                            $pimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
                            if ($product->main_image) {
                                if (file_exists('media/products/thumbs_266X300/' . $product->main_image)) {
                                    $pimage = Yii::app()->request->baseUrl . '/media/products/thumbs_266X300/' . $product->main_image;
                                }
                            }
                            ?>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/productDetails/<?php echo $product->slug; ?>" class="item-img">
                                <img src='<?php echo $pimage; ?>'>
                            </a>
                            <div class="item-cap">
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/productDetails/<?php echo $product->slug; ?>" class="title"><?php echo $product->title; ?></a>
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/productDetails/<?php echo $product->slug; ?>" class="price">
                                    <?php
                                    $curr_symbol = Yii::app()->params['dc_symbol'];
                                    $rate = '1';
                                    if (!Yii::app()->user->isGuest) {
                                        $curr_symbol = Yii::app()->user->getState('currency_symbol');
                                        $rate = Yii::app()->user->getState('currency_rate');
                                    }
                                    ?>
                                    <?php echo $curr_symbol . "  " . $product->price * $rate; ?>
                                    <?php if ($product->sale) { ?>
                                        <del class="original"><?php echo $curr_symbol . "  " . $product->old_price * $rate; ?></del>
                                    <?php } ?>
                                </a>

                            </div>
                            <?php if ($show_shop) { ?>
                                <div class="item-fav">
                                    <div class="fav-left">
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $product->shopName->slug; ?>" class="title"><?php echo $product->shopName->title; ?></a>
                                        <a href="#" class="date"><?php echo Helper::ago(strtotime($product->start_date)); ?></a>
                                    </div>
                                    <?php if (Yii::app()->user->isGuest) { ?>
                                        <a href="#login" role="button"  data-toggle="modal" class="follow">follow</a>
                                    <?php } else { ?>
                                        <?php
                                        $str = "follow";
                                        if (Helper::check_follow_shop($product->shopName->id))
                                            $str = "unfollow";
                                        ?>
                                        <a href="javascript:void(0)" sid='<?php echo $product->shopName->id; ?>' class="follow follow2 shfp_<?php echo $product->shopName->id; ?>"><?php echo $str; ?></a>
                                    <?php } ?>


                                </div>
                            <?php } ?>
                            
                            <!-- cart icon -->
             <a href="javascript:void(0)" data-toggle="tooltip" title="Add to cart" class=" fav cart <?php echo $class; ?>" pid="<?php echo $product->id; ?>" <?php echo $str; ?>><img src="<?= Yii::app()->request->baseUrl; ?>/img/cart3.png"></a>

                            <div class="item-share">
                                <div class="items-div">
                                    <?php
                                    $str = 'href="javascript:void(0)"';
                                    $class = "carting";
                                    if (!Yii::app()->user->id) {
                                        $class = "";
                                        $str = 'href="#login" role="button"  data-toggle="modal"';
                                    }
                                    ?>
                                    <a class='stLarge' target="_blank" data-toggle="tooltip" title="Tweet" href="https://twitter.com/intent/tweet?text=<?php echo $product->title?>&via=WhereWeStyle&url=<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>&image=<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?= $product->main_image; ?>" ></a>
                    
                                    <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button"  data-toggle="modal" class="new_fav fav pfav"><img src="<?= Yii::app()->request->baseUrl; ?>/img/fav.png" width="34"></a>
                            <?php } else { ?>
                                <?php if (Helper::check_favourite_product($product->id)) { ?>
                                    <a  data-toggle="tooltip" href="javascript:void(0)" pid='<?php echo $product->id; ?>' class=" new_fav pfav fav"><img id="prod_<?php echo $product->id; ?>" src="<?= Yii::app()->request->baseUrl; ?>/img/fav-remove.png" width="34"></a>
                                <?php } else { 
                                    if(Yii::app()->user->getState('first_connect') == 1){ ?>
                                    <a  data-toggle="tooltip" title="Save product" href="javascript:void(0)" pid='<?php echo $product->id; ?>' class="new_fav fav pfav"><img id="prod_<?php echo $product->id; ?>" src="<?= Yii::app()->request->baseUrl; ?>/img/fav.png" width="34"></a>  
                                <?php  }else{
                                    ?>
                                    <a  data-toggle="tooltip" title="Save product" href="javascript:void(0)" pid='<?php echo $product->id; ?>' class="new_fav fav pfav"><img id="prod_<?php echo $product->id; ?>" src="<?= Yii::app()->request->baseUrl; ?>/img/fav.png" width="34"></a>
                                <?php } }?>
                            <?php } ?>
                           
                                    <a data-toggle="tooltip" title="Like" class="facebook" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=409482105858611&display=popup&picture=<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?= $product->main_image; ?>&description=I liked this fabulous item at <?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>&caption=<?=Yii::app()->request->getBaseUrl('webroot')?>&name=<?php echo $product->title; ?>&redirect_uri=<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>&link=<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>"></a>

                                    <!--<a class="cart <?php echo $class; ?>" pid="<?php echo $product->id; ?>" <?php echo $str; ?>><img src="<?= Yii::app()->request->baseUrl; ?>/img/cart.png"></a>
                                    <a href="#" class="like"><?php echo Helper::getProductFollowers($product->id); ?>&nbsp;<img src='<?php echo Yii::app()->request->baseUrl; ?>/img/share.png'></a>

                                    <a class="share shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/products/original/<?= $product->main_image; ?>" sname="<?php echo $product->title; ?>" desc="<?php echo strip_tags($product->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a>-->
                                </div>    
                                <?php if ($sale && $product->sale == 1) { ?>
                                    <a href="#" class="sale">sale</a>
                                <?php } ?>                         
                            </div> 
                            </div>  
                             <div class="fb_like">
                <div class="fb-like like_btn" data-href="<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?=$product->slug?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
            </div>                     
                        </div>		
                        <?php
                        if (($i % 4) == 3) {
                            echo '</div>';
                        }
                        $i++;
                    }
                    if (($i % 4) != 3) {
                        echo '</div>';
                    }
                }
                ?>

                <!--
                ==============================================================-->
            </div>
        </div>


    </div>
<?php } else { ?>
    <div style="line-height: 30px;font-size: 20px;margin-bottom: 20px;margin-left: 20px;">there are no products</div>
<?php } ?>



