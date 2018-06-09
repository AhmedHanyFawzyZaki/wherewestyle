
<?php
$this->pageTitle = Yii::app()->name . ' - Home';
//Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl.'/img/logo.png', 'image');
//Yii::app()->clientScript->registerMetaTag('where we style is your choice to start your business in selling and buying products', 'description');
?>

<?php
Yii::app()->clientScript->registerScript('follow', "
var flag = true;
$('.follow2').click(function(){
  if(flag){
    var ths = $(this);
    var x = ths.attr('sid');
    flag = false;
    $.ajax({
      url : '" . Yii::app()->request->baseUrl . "/home/followshop/'+x,
          dataType : 'json',
      success : function(data){
        if(data != 'error'){
          ths.html(data.result);    
          $('.shfp_'+x).html(data.result);
          $('.flshp_'+x).html(data.count);
        }
        flag = true;
      }
    });  
  }
});
");
?>
<?php
Yii::app()->clientScript->registerScript('followbig', "
var flag = true;
$('.follow_big').click(function(){
  if(flag){
    var ths = $(this);
    var x = ths.attr('big_id');
    flag = false;
    $.ajax({
      url : '" . Yii::app()->request->baseUrl . "/home/followshop/'+x,
          dataType : 'json',
      success : function(data){
        if(data != 'error'){
          ths.html(data.result);    
          $('.shfp_'+x).html(data.result);
          $('.flshp_'+x).html(data.count);
        }
        flag = true;
      }
    });  
  }
});
");
?>
<?php
Yii::app()->clientScript->registerScript('followsmall', "
var flag = true;
$('.follow_small').click(function(){
  if(flag){
    var ths = $(this);
    var x = ths.attr('small_id');
    flag = false;
    $.ajax({
      url : '" . Yii::app()->request->baseUrl . "/home/followshop/'+x,
          dataType: 'json',
      success : function(data){
        if(data != 'error'){
          ths.html(data.result);    
          $('.shfp_'+x).html(data.result);
          $('.flshp_'+x).html(data.count);
        }
        flag = true;
      }
    });  
  }
});
");
?>
<?php
Yii::app()->clientScript->registerScript('favourite', "
var flag = true;
$('body').on('click','.pfav',function(){
	if(flag){
            var ths = $(this);
            var x = ths.attr('pid');
            flag = false;
    
    	    ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/load-heart.gif');
            $.ajax({
                url : '" . Yii::app()->request->baseUrl . "/home/favproduct/'+x,
                success : function(data){
                    if(data == 'fav'){                        
                        ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav-remove.png');
                        $('#itm_'+x).animate({top : -55},100);
                        $('#itm_'+x).attr('chk','no');

                        $('#temp_'+x).html('Product saved! Add to cart? <img src=\'http://www.mazeguy.net/basic/smile.gif\' />');
                        $('#temp_'+x).animate({top : 0},100).delay(3000).animate({top : -55},100,function(){
                        $('#itm_'+x).attr('chk','true');
                        $('#temp_'+x).html('');
                        });

                    }else if(data == 'first_connect'){
                        
                        ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav-remove.png');
                        $('#itm_'+x).animate({top : -55},100);
                        $('#itm_'+x).attr('chk','no');

                        $('#temp_'+x).html('Product saved! Add to cart? <img src=\'http://www.mazeguy.net/basic/smile.gif\' />');
                        $('#temp_'+x).animate({top : 0},100).delay(3000).animate({top : -55},100,function(){
                        $('#itm_'+x).attr('chk','true');
                        $('#temp_'+x).html('');
                        });
                        $('#first_fb_connect').click();
                        
                    }else if(data == 'removed'){
                        ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav.png');
                        $('#itm_'+x).animate({top : -55},100);
                        $('#itm_'+x).attr('chk','no');

                        $('#temp_'+x).html('Product Removed!');
                        $('#temp_'+x).animate({top : 0},100).delay(3000).animate({top : -55},100,function(){ 
                        $('#itm_'+x).attr('chk','true');
                        $('#temp_'+x).html('');
                        });
                        $('#fav_pr_'+x).fadeOut('slow');
                    }
                    setTimeout(function(){
                        $.ajax({
                            url : '" . Yii::app()->request->baseUrl . "/home/update_favourite/',
                            success : function(data){
                                if(data != 'z'){
                                    $('#fav_bar').html(data);
                                    $( '#fav_pr_'+x ).hide().delay(100).slideDown('slow');
                                }
                            }
                        });
                        flag = true;
                    },1000);
            }
        });	
    }
});
");
?>
<?php
$curr_symbol = Yii::app()->params['dc_symbol'];
if (!Yii::app()->user->isGuest) {
    $curr_symbol = Yii::app()->user->getState('currency_symbol');
}
Yii::app()->clientScript->registerScript('cart', '
    $("body").on("click",".carting",function(){
        var y = $(this).attr("pid");
            $.ajax({
                url : "' . Yii::app()->request->baseUrl . '/home/cart/"+y,
                dataType : "json",
                success : function(data){
                    $("#cart_count").html(data.count);
                    $("#header_cost").html("' . $curr_symbol . ' "+data.cost);
                }
            });
    });
');
?>


<div class="row-fluid slider-row">
    <div class="container">
        <div id="myCarousel" class="carousel slide carousel1">
            <ol class="carousel-indicators">
                <?php
                $j = 1;
                foreach ($banners as $banner) {
                    if ($j == 1) {
                        $class1 = 'active';
                    } else {
                        $class1 = '';
                    }
                    ?>

                    <li data-target="#myCarousel" data-slide-to="<?= $j - 1 ?>" class="<?= $class1 ?>"><span><?= $j ?></span></li>
                    <?php
                    $j++;
                }
                ?>

            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">        
                <?php
                $i = 0;
                foreach ($banners as $banner) {
                    if ($i == 0) {
                        $class = 'active item';
                    } else {
                        $class = 'item';
                    }
                    ?>

                    <div class="<?= $class; ?>">
                        <a href="<?php echo $banner->link; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/media/banner/<?= $banner->image; ?>" alt=""/></a>
                    </div>
                    <?php
                    $i++;
                }
                ?>

            </div>
            <!-- Carousel nav -->

        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="container item-page-home">
        <section class="slider">
            <div class="flexslider carousel">
                <ul class="slides">
                    <?php foreach ($smallShops as $small) { ?>
                        <li class="subslider shops" style="position:relative;">
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button"  data-toggle="modal" class="followh">follow</a>
                            <?php } else { ?>
                                <?php
                                $str = 'follow';
                                if (Helper::check_follow_shop($small->id))
                                    $str = 'unfollow';
                                ?>
                                <a href="javascript:void(0)" small_id='<?php echo $small->id; ?>'
                                   class="followh follow_small shfp_<?php echo $small->id; ?>"><?php echo $str; ?></a>
                               <?php } ?>

                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $small->slug; ?>">
                                <?php
                                $pimage = Yii::app()->request->baseUrl . '/img/' . "default_shop_image.jpg";
                                if ($small->image) {
                                    if (file_exists('media/shops/thumbs_266X300/' . $small->image)) {
                                        $pimage = Yii::app()->request->baseUrl . '/media/shops/thumbs_266X300/' . $small->image;
                                    }
                                }
                                ?>
                                <img style="width: 168px;height: 184px;" src="<?= $pimage; ?>" />
                            </a>

                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $small->slug; ?>"
                               class="cap"><?= $small->title; ?></a>


                            <span class="shop-des-quote2"><?= mb_substr(strip_tags($small->desc), 0, 25); ?></span>
                            <div class="shop-sharex">
                                <span class="followers flshp_<?php echo $small->id; ?>"><?= Helper::getShopFollowers($small->id); ?></span>
                                <a class="fb shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $small->image; ?>" sname="<?php echo $small->title; ?>" desc="<?php echo strip_tags($small->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/shopDetails-<?php echo $small->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a> 

                                                                <!--                                        <a class="tw" target="_blank" href="https://twitter.com/share?url=<?php echo Yii::app()->getBaseUrl(true); ?>/home/shopDetails/<?php echo $small->slug; ?>"><img src="/projects/team-a/wherewestyle/img/tw.png"></a>
                                                                                                        <a class="fb" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=224710701038219&picture=<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $small->image; ?>&display=popup&description=<?php echo strip_tags($small->desc); ?>&caption=wherewestyle.domains4reg.com&name=<?php echo $small->title; ?>&redirect_uri=<?php echo Yii::app()->getBaseUrl(true); ?>/home/shopDetails/<?php echo $small->slug; ?>&link=<?php echo Yii::app()->getBaseUrl(true); ?>/home/shopDetails/<?php echo $small->slug; ?>"><img src="/projects/team-a/wherewestyle/img/fb.png"></a>
                                -->


                            </div>

                        </li>    
                    <?php } ?>               
                </ul>
            </div>
        </section>

        <div class="wrap">
            <div class="row-fluid shops-banners shops">

                <?php foreach ($bigShops as $big) { ?>
                    <div class="span4">
                        <a class="shops_banner_link" href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $big->slug; ?>">
                            <?php
                            $psimage = Yii::app()->request->baseUrl . '/img/' . "default_shop_image.jpg";
                            if ($big->image) {
                                if (file_exists('media/shops/original/' . $big->image)) {
                                    $psimage = Yii::app()->request->baseUrl . '/media/shops/original/' . $big->image;
                                }
                            }
                            ?>
                            <img src="<?= $psimage; ?>">
                        </a>

                        <span class="shop-name"><?= $big->title; ?></span>
                        <span class="shop-des-quote"><?= mb_substr(strip_tags($big->desc), 0, 25); ?></span>
                        <div class="shop-share">
                            <span class="followers flshp_<?php echo $big->id; ?>"><?= Helper::getShopFollowers($big->id); ?></span>

                            <a class="fb shr" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $big->image; ?>" sname="<?php echo $big->title; ?>" desc="<?php echo strip_tags($big->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/shopDetails-<?php echo $big->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a>
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button"  data-toggle="modal" class="follow" style="float: right">follow</a>
                            <?php } else { ?>
                                <?php
                                $str = 'follow';
                                if (Helper::check_follow_shop($big->id))
                                    $str = 'unfollow';
                                ?>
                                <a href="javascript:void(0)" big_id='<?php echo $big->id; ?>' style="float: right" class="follow follow_big shfp_<?php echo $big->id; ?>"><?php echo $str; ?></a>
                            <?php } ?>
                        </div>

                                                                                                                                            <!--<a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $big->slug; ?>" class="go-shop">visit shop</a>-->
                    </div>                
                <?php } ?>

            </div>

            <div class="row-fluid shops-banners">
                <?php
                if ($products != '') {
                    foreach ($products as $product) {
                        ?>     
                        <div class="span3 img_container">
                        <div class="prod_div">
                            <?php
                            $ppimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
                            if ($product->main_image) {
                                if (file_exists('media/products/thumbs_266X300/' . $product->main_image)) {
                                    $ppimage = Yii::app()->request->baseUrl . '/media/products/thumbs_266X300/' . $product->main_image;
                                }
                            }
                            ?>
                            <a href="<?= Yii::app()->request->baseUrl . '/productDetails-' . $product->slug; ?>" class="item-img product_img">
                                <!--<img src="<?= $ppimage; ?>" >-->
                                <img src="<?= Yii::app()->request->baseUrl ?>/media/products/thumbs_266X300/194-item-img.png" >
                            </a>
                            <div class="item-cap">
                                <a href="<?= Yii::app()->request->baseUrl . '/productDetails-' . $product->slug; ?>" class="title"><?= $product->title; ?></a>
                                <a href="<?= Yii::app()->request->baseUrl . '/productDetails-' . $product->slug; ?>" style="text-align: right;" class="price">

                                    <?php
                                    $curr_symbol = Yii::app()->params['dc_code'];
                                    $rate = '1';
                                    if (!Yii::app()->user->isGuest) {
                                        $curr_symbol = Yii::app()->user->getState('currency_code');
                                        $rate = Yii::app()->user->getState('currency_rate');
                                    }
                                    ?>
                                    <?php echo $curr_symbol . "  " . $product->price * $rate; ?>
                                    <?php if ($product->sale) { ?>
                                        <del class="original"><?php echo $curr_symbol . "  " . $product->old_price * $rate; ?></del>
                                    <?php } ?>
                                </a>
                                
                            </div>
                            
                            <div class="item-fav" id="itm_<?php echo $product->id; ?>" chk='true'>
                                <div class="fav-left">
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $product->shopName->slug; ?>" class="title"><?= $product->shopName->title; ?></a>
                                    <a href="#" class="date"><?= Helper::ago(strtotime($product->start_date),$product->end_date) ?></a>
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

                                <!--<a href="#" class="like"><?= Helper::getProductFollowers($product->id) ?> &nbsp;<img src="<?= Yii::app()->request->baseUrl; ?>/img/share.png"></a><span class="st_fblike_hcount" ></span>-->
                                <a class='stLarge' target="_blank" data-toggle="tooltip" title="Tweet" href="https://twitter.com/intent/tweet?text=<?php echo $product->title?>&via=WhereWeStyle&url=<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?php echo $product->slug; ?>&image=<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?= $product->main_image; ?>" ></a>

                                
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
                            
                                    <a href="#Modal2" id="first_fb_connect" role="button" class="btn" data-toggle="modal" style="display: none;">Launch demo modal</a>

                            
                              <!--  <a data-toggle="tooltip" title="Like" class="facebook" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=409482105858611&display=popup&picture=<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?= $product->main_image; ?>&description=I liked this fabulous item at <?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?php echo $product->slug; ?>&caption=<?=Yii::app()->request->getBaseUrl('webroot')?>&name=<?php echo $product->title; ?>&redirect_uri=<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?php echo $product->slug; ?>&link=<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?php echo $product->slug; ?>"></a>-->
    <!--<div class="fb-like facebook" data-href="<?= Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
   <a class="facebook" href="<?= Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>" title="Like"></a>                      -->
<!--<span class='st_twitter_large' displayText='Tweet' st_title='<?php echo $product->title?>' st_url='<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php echo $product->slug; ?>' st_image='<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?= $product->main_image; ?>' st_via='WhereWeStyle'></span>-->

                                <!--<a class="share shr" simage="<?= Yii::app()->getBaseUrl(true); ?>/media/products/original/<?//= $product->main_image; ?>" sname="<?php //echo $product->title; ?>" desc="<?php //echo strip_tags($product->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/home/productDetails/<?php //echo $product->slug; ?>" role="button" data-toggle="modal" href="#share_popup"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a>-->
                            </div>

                                <?php if ($product->sale == 1) { ?>
                                    <a href="#" class="sale">sale</a>
                                <?php } ?>                                   
                            </div> 
                            
                            </div>
                        <div class="fb_like">                           
                            <!--<div class="addthis_native_toolbox"></div>-->
                    <div class="fb-like like_btn" data-href="<?php echo Yii::app()->getBaseUrl(true); ?>/productDetails-<?=$product->slug?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                        </div>
                        </div>      
                        <?php
                    }
                }
                ?>
            </div>
        </div>


<div id="Modal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Share On FB</h3>
    </div>
    <div class="modal-body">
        <p>Connect to your FaceBook and share your favorite product </p>
    </div>
    <div class="modal-footer">
        <a  onclick="enable_sharing(0)" href="<?php echo Yii::app()->facebook->getLoginUrl(array('scope' => 'publish_stream')); ?>" class="btn btn-primary btn-follow">Yes</a>
        <a href="" class="btn">No</a>
    </div>
</div>

    </div>
</div>

<div class="row-fluid " style="margin-top:20px;">
    <div class="container body-cont">
        <div class="row-fluid item-page-home">
            <div class="map">
                <h1 class="contitle" style="margin: 10px;">Top Blog Articles</h1>

                <div class="row-fluid">

                    <?php if ($posts) { ?>
                        <?php foreach ($posts as $post) { ?>
                            <div class="span3 home_block">
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/post/<?php echo $post->id; ?>" class="header_l"><?php echo $post->title; ?></a>
                                <p style=""><?php echo mb_substr(strip_tags($post->content), 0, 200); ?>...</p>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="row-fluid">
                    <div class="span12 bottom10px" style="text-align: center;">
                        <a href="<?php echo Yii::app()->createUrl('home/blog'); ?>" style="padding:10px 0; color:#FFF; width:96%; text-align:center; background:#F62A64;margin: 0 2%;float: left;">View Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function enable_sharing(val){
        
     $.ajax({
      url:"<?=Yii::app()->request->baseUrl?>/home/updateUserSharing/"+val,
    });
    }
</script>

