<?php
if ($products) {
    foreach ($products as $product) {
        ?>
        <div class="row-fluid shops-banners mrg shan">	
        <div class="prod_div">                                            	
            <div class="span12" style="border:1px #ccc solid; background-color:#fff;">
                <div class="span3">
            <?php
            $pimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
            if ($product->main_image) {
                if (file_exists('media/products/thumbs_266X300/' . $product->main_image)) {
                    $pimage = Yii::app()->request->baseUrl . '/media/products/thumbs_266X300/' . $product->main_image;
                }
            }
            ?>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/productDetails-<?php echo $product->slug; ?>" class="item-img product_img"><img src='<?php echo $pimage; ?>'></a>
            <?php if ($show_shop) { ?>
                <div class="item-fav" id="itm_<?php echo $product->id; ?>" chk='true'>
                    <div class="fav-left">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $product->shopName->slug; ?>" class="title"><?php echo $product->shopName->title; ?></a>
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

            <?php if (!Yii::app()->user->isGuest) { ?>
                <div class="item-temp-mess" id="temp_<?php echo $product->id; ?>"></div>
            <?php } ?>

            <!-- cart icon -->
             <a href="javascript:void(0)" data-toggle="tooltip" title="Add to cart" class=" fav cart <?php echo $class; ?>" pid="<?php echo $product->id; ?>" <?php echo $str; ?>><img src="<?= Yii::app()->request->baseUrl; ?>/img/cart3.png"></a>

            <div class="item-share">
                <div class="items-div">
                    <?php
                    $str = 'href="javascript:void(0)"';
                    $class = "carting";
                    if (!Yii::app()->user->id) {
                        //$class = "";
                        //$str = 'href="#login" role="button"  data-toggle="modal"';
                    }
                    ?>
                    <!--<a class="cart <?php echo $class; ?>" pid="<?php echo $product->id; ?>" <?php echo $str; ?>><img src="<?= Yii::app()->request->baseUrl; ?>/img/cart.png"></a>
                    <a href="#" class="like"><?php echo Helper::getProductFollowers($product->id); ?>&nbsp;<img src='<?php echo Yii::app()->request->baseUrl; ?>/img/share.png'></a>

                    <!--<a href="#" class="share"><img src='<?php echo Yii::app()->request->baseUrl; ?>/img/share2.png'></a>-->
                    <!--<a class="share shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/products/original/<?= $product->main_image; ?>" sname="<?php echo $product->title; ?>" desc="<?php echo strip_tags($product->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a>-->
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
   
                </div>    
                <?php if ($sale && $product->sale == 1) { ?>
                    <a href="#" class="sale">sale</a>
                <?php } ?>                         
            </div>  
            <div class="item-cap item-cap2">
            <div class="fb_like fb_like2">
                <div class="fb-like like_btn" data-href="<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?=$product->slug?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
            </div>
            </div>
                                
        </div> 
          
         
            
                <div class="span6">  
                    <div class="items-cap">
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/productDetails-<?php echo $product->slug; ?>" class="title"><?php echo $product->title; ?></a>
                        <br>
                        <a href="#" class="disc"><?php echo mb_substr(strip_tags($product->desc),0,200); ?></a>
                    </div>
                </div>    
                <div class="span2 new-span">   
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/productDetails-<?php echo $product->slug; ?>" class="price">
                        <?php
                        $curr_symbol = Yii::app()->params['dc_code'];
                        $rate = '1';
                        if (!Yii::app()->user->isGuest) {
                            $curr_symbol = Yii::app()->user->getState('currency_code');
                            $rate = Yii::app()->user->getState('currency_rate');
                        }
                        ?>

                        <?php if ($product->sale) { ?>
                            <del class="original"><?php echo $curr_symbol . "  " . $product->old_price * $rate; ?></del>
                        <?php } ?>
                        <?php echo $curr_symbol . "  " . $product->price * $rate; ?>
                    </a>
                    <?php
                    $str = 'href="javascript:void(0)"';
                    $class = "carting";
                    if (!Yii::app()->user->id) {
                        $class = "";
                        $str = 'href="#login" role="button"  data-toggle="modal"';
                    }
                    ?>
                    <div class=" btn btn-warning <?php echo $class; ?>" pid="<?php echo $product->id; ?>" <?php echo $str; ?> style="width:110px;">buy now</div>
                </div> 
            </div>
            </div>
        </div>
        <br>

    <?php } ?>
<?php } else { ?>
    <?php
    $no_str = "There are no products.";
    $act = Yii::app()->controller->action->id;
    if ($act == "searchProducts" || $act == "search_products") {
        $no_str = "There are no search results.";
    }else if ($act == "followedProducts") {
        $no_str = "You have not followed any shops with products, therefore there are no products here.";
    }
    ?>
    <div style="line-height: 30px;font-size: 20px;margin-bottom: 20px;margin-left: 20px;margin-top: 20px;"><?php echo $no_str; ?></div>
<?php } ?>

    