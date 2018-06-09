<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
        <?php
        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['meta_desc'], 'description');
        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['meta_author'], 'author');
        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['meta_keywords'], 'keywords');
        ?>

        <!-- Le styles -->
        <link href="<?= Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">

        <link href="<?= Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/css/flexslider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl; ?>/css/user-dashbord.css"/>


        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->

        <link rel="shortcut icon" href="">
        
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=409482105858611";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">
		stLight.options({publisher: "ebf579d1-ed95-47e9-8c16-2fa5d7ef21aa", doNotHash: false, doNotCopy: false, hashAddressBar: false});
        </script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5398023d08abee83"></script>

<script type="text/javascript">stLight.options({publisher: "ur-70927be3-71ea-d8d7-a857-4b1ccf3b26c3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>

<body>
  
    
    <?php
    Yii::app()->clientScript->registerScript('carte', '
    $("body").on("click",".carting1",function(){
        var y = $(this).attr("pid");
            $.ajax({
                url : "' . Yii::app()->request->baseUrl . '/home/cart/"+y,
                dataType : "json",
                success : function(data){
                    $("#cart_count").html(data.count);
                    $("#header_cost").html("&pound; "+data.cost);
                }
            });
    });
');
    ?>
    <?php
    Yii::app()->clientScript->registerScript('cart_drop', '
    $("#cart_drops").hover(function(){
        $("#cart_drops_cont").show();
        cart_drops();
    },function(){
        $("#cart_drops_cont").hide();
    });
    
    function cart_drops(){
        $.ajax({
                url : "' . Yii::app()->request->baseUrl . '/home/cart_drop/",
                success : function(data){
                    $("#cart_drops_cont").html(data);
                }
            });
    }
    cart_drops();
');
    ?>
    <?php
    Yii::app()->clientScript->registerScript('notifs', "
    var flag = true;
    $('#not_butt').hover(function(){
            if(flag){
                    var ths = $(this);
                    $('#not_butt').children('ul').stop().show();
                    flag = false;
                    $.ajax({
                            url : '" . Yii::app()->request->baseUrl . "/home/notification_view/',
                            success : function(data){
                                    if(data == 0){
                                       $('#not_butt a').css({color: '#fff', background: '#ccc'});  
                                    }
                                    ths.children('a').html(data);
                                    flag = true;
                            }
                    });  
            }
    },function(){
         $('#not_butt').children('ul').stop().hide();
    });
    ");
    ?>

    <?php
    Yii::app()->clientScript->registerScript('options', '
    $("#price_toggle").click(function(){
        $("#price_div").slideToggle();
    });
');
    ?>

    <?php
    Yii::app()->clientScript->registerScript('drops', '
        $(".mdrp").hover(function(){
            $(this).children("ul").stop().show();
        },function(){
            $(this).children("ul").stop().hide();
        });
    ');
    ?>

    <div class="row-fluid header navbar-fixed-top">




        <div class="container" style="position:relative">
            <!--floating boxes-->

            <?php if (!Yii::app()->user->isGuest) { ?>
                <?php
                $currencies = Currency::model()->findAll();


                $curr_symbol = Yii::app()->user->getState('currency_symbol');
                $rate = Yii::app()->user->getState('currency_rate');
                $icon = Yii::app()->user->getState('currency_icon');
                $code = Yii::app()->user->getState('currency_code');
                ?>
                <div class="curr">
                    <button data-toggle="dropdown" class="btn dropdown-toggle">
                        <img class="flag" src="<?= Yii::app()->request->baseUrl; ?>/media/<?php echo $icon; ?>"><p><?php echo $curr_symbol; ?> <?php echo $code; ?></p>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li cid="SGD" class="curr_sel"><a href="javascript:void(0)"><img class="flag" src="<?= Yii::app()->request->baseUrl; ?>/media/sing_flag.gif"><span><?php echo Yii::app()->params['dc_symbol'] . " " . Yii::app()->params['dc_code']; ?></span></a></li>
                        <?php if ($currencies) { ?>
                            <?php foreach ($currencies as $cr) { ?>
                                <li cid="<?php echo $cr->iso_code; ?>" class="curr_sel"><a href="javascript:void(0)"><img class="flag" src="<?= Yii::app()->request->baseUrl; ?>/media/<?php echo $cr->icon; ?>"><span><?php echo $cr->symbol; ?> <?php echo $cr->iso_code; ?></span></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <form action="<?php echo Yii::app()->request->baseUrl ?>/home/change_curr" method="post" id="cu_fo" >
                    <input type="hidden" name="curr" value="<?php echo $code; ?>" id="curr_04" />
                    <input type="hidden" name="url" value="http://<?php echo Yii::app()->request->getServerName() . Yii::app()->request->requestUri; ?>" />
                </form>
                <?php
                Yii::app()->clientScript->registerScript('dfgddfg', '
                    $(".curr_sel").click(function(){
                        var c = $("#curr_04").val();
                        if(c != $(this).attr("cid")){
                            $("#curr_04").val($(this).attr("cid"));
                            $("#cu_fo").submit();
                        }
                    });
                ');
                ?>
            <?php } ?>

            <?php if (Yii::app()->controller->action->id == "index" && Yii::app()->controller->id == "home") { ?>
                <div class="fav-bar" style="left:-105px;text-align: center;padding-top: 10px;padding-bottom: 10px;width: 95px;">
                    <div class="fb-like" data-href="<?= Settings::model()->findByPk(1)->facebook; ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
                    <!-- Place this tag where you want the widget to render. -->
                    <div style="margin: 10px 0 6px 0;">
                        <div class="g-follow" data-annotation="vertical-bubble" style="width:58px;" data-height="15" data-href="<?= Settings::model()->findByPk(1)->google; ?>" data-rel="author"></div>

                        <!-- Place this tag after the last widget tag. -->
                        <script type="text/javascript">
                            (function() {
                                var po = document.createElement('script');
                                po.type = 'text/javascript';
                                po.async = true;
                                po.src = 'https://apis.google.com/js/platform.js';
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(po, s);
                            })();
                        </script>
                    </div>
                    <a href="<?= Settings::model()->findByPk(1)->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-width="58px"  data-align="right">Follow @twitterapi</a>

                    <script>!function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (!d.getElementById(id)) {
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "http://platform.twitter.com/widgets.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }
                        }(document, "script", "twitter-wjs");</script>
                </div>
            <?php } ?>


            <?php if ((Yii::app()->controller->action->id == "sale" || Yii::app()->controller->action->id == "browse" || Yii::app()->controller->action->id == "followedProducts" || Yii::app()->controller->action->id == "shopDetails" || Yii::app()->controller->action->id == "favouriteProducts" || Yii::app()->controller->action->id == "search_products") && Yii::app()->controller->id == "home") { ?>

                <?php
                Yii::app()->clientScript->registerScript('price', '
            $("#search_price").click(function(){
                var min = parseFloat($("#pr_min").val());
                var max = parseFloat($("#pr_max").val());
                var flag = false;
                if(!isNaN(min) && isFinite(min)){
                    $("#min_price").val(min);
                    flag = true
                }
                if(!isNaN(max) && isFinite(max)){
                    $("#max_price").val(max);
                    flag = true
                }
                if(flag){
                    $("#search-products-form").submit();
                }
            });
            ');
                ?>

                <div style="left:-95px;text-align: center;padding-top: 10px;width:80px;" class="fav-bar">
                    <div id="price_toggle" style="margin-bottom: 10px;cursor: pointer;">
                        <span style="margin-bottom: 10px">PRICE</span>
                        <b class="caret" style="margin-top: 7px;margin-right:10px;"></b>
                    </div>
                    <div id="price_div" style="display: none;">
                        <?php
//                        $form = $this->beginWidget("CActiveForm", array(
//                            'id' => 'price-search',
//                            'method' => 'get',
//                            'action' => Yii::app()->request->baseUrl . "/home/search_price",
//                        ));
                        ?>
                        <?php
                        $max = "";
                        if ($_GET['max_price']) {
                            $max = $_GET['max_price'];
                        }
                        $min = "";
                        if ($_GET['min_price']) {
                            $min = $_GET['min_price'];
                        }
                        ?>
                        <input type="text" name="min" id="pr_min" value="<?php echo $min; ?>" placeholder="min" style="width:35px;"/>
                        <input type="text" name="max" id="pr_max" value="<?php echo $max; ?>" placeholder="max" style="width:35px;"/>
                        <input type="button" id="search_price" style="background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;margin: 0 0 10px 0;padding: 3px 12px;border: none;" value="search" />
                        <?php // $this->endWidget();  ?>
                    </div>
                </div>
            <?php } ?>

            <!--end floating boxes-->

            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php" class="logo"><img src="<?= Yii::app()->request->baseUrl; ?>/img/logo1.png" alt=""></a>
            <ul class="main-nav">
                <?php if (!Yii::app()->user->isGuest) { ?>
                    <li class="dropdown mdrp">
                    	<a href="<?= Yii::app()->request->baseUrl; ?>/followedProducts" class="dropdown-toggle" ><span class="pull-left">Following</span>
                         <?php
                            if(Helper::get_follow_pro_notif()>0)
                            {
                                    $num=Helper::get_follow_pro_notif();
                                    $st='background: #F9D6E0 ;color: #FD2B68 ;font-size: 12px;display: block;line-height: 20px;margin-left: 5px;padding: 0 5px !important;';
                            }
                            else
                            {
                                    $num=0;
                                    $st='background: #ccc;color: #fff;font-size: 12px;display: block;line-height: 20px;margin-left: 5px;padding: 0 5px !important;';
                            }
                         ?>
                    		<p style="<?=$st;?>" class="dropdown-toggle numberCircle"><?=$num;?></p>
                    		<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" style="margin-top: 0;">
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/followedProducts" style="text-transform: none; color:#000 !important;">Products of shops followed</a></li>
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/followedShops" style="text-transform: none; color:#000 !important;">Shops followed</a></li>
                        </ul>
                    </li>
                    <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/home/followedShops">Following</a></li>-->
                <?php } ?>
                <li class="dropdown mdrp"><a href="javascript:void(0)" >Browse<b class="caret"></b></a>
                    <?php $cats = Category::model()->findAll(); ?>
                    <?php if ($cats) { ?>
                        <ul class="dropdown-menu" style="margin-top: 0;">
                            <li><a href="<?php echo yii::app()->getBaseUrl(true) . '/All_' ?>" style="text-transform: none; color:#000 !important;">All</a></li>
                            <?php foreach ($cats as $cat) { ?>
                                <li><a href="<?php echo yii::app()->getBaseUrl(true) . '/' .$cat->slug.'_'; ?>" style="text-transform: none; color:#000 !important;"><?php echo $cat->title; ?></a></li>
                            <?php } ?>
                        </ul>   
                    <?php } ?>

                </li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/sale" style="color: red;">Sale</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/shops">Shops</a></li>
            </ul>

            <form class="form-search" action="<?php echo Yii::app()->request->baseUrl; ?>/home/SearchProducts" method="get">                           
                <div class="input-prepend">                    

                    <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'name' => 'search_keyword',
                        'value' => $_GET['search_keyword'],
                        //  'source'=>$people, // <- use this for pre-set array of values
                        'source' => Yii::app()->request->baseUrl . '/home/autosearch', // <- path to controller which returns dynamic data
                        // additional javascript options for the autocomplete plugin
                        'options' => array(
                            'minLength' => '1', // min chars to start search
                            'select' => 'js:function(event, ui) { console.log(ui.item.id +":"+ui.item.value); }'
                        ),
                        'htmlOptions' => array(
                            'id' => 'inputIcon',
                            'rel' => 'val',
                            'class' => 'search-query',
                            'placeholder' => 'Search Products..',
                        ),
                    ));
                    ?>
                    <button type="submit" class="search-btn"><i class="icon-search"></i></button>
                </div>
            <!-- <input type="submit" value="" class="search-btn">-->
            </form>


            <div id="cart_drops" class="cart">

                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shoppingCart" class="cart-price">
                    <?php
                    $curr_symbol = Yii::app()->params['dc_symbol'];
                    if (!Yii::app()->user->isGuest) {
                        $curr_symbol = Yii::app()->user->getState('currency_symbol');
                    }
                    ?>
                    <span class="price" id="header_cost"><?php echo $curr_symbol . "  " . Helper::shopping_cost(); ?></span>

                    <span class="items">
                        <span id="cart_count"><?php
                            if (Yii::app()->shoppingCart->getCount() > 0) {
                                echo Yii::app()->shoppingCart->getCount();
                            } else {
                                echo "0";
                            };
                            ?></span> Item</span>
                </a>


                <div class="btn-group">
                    <!-- -->
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shoppingCart"
                       class="cart-icon dropdown-toggle"><img src="<?= Yii::app()->request->baseUrl; ?>/img/cart.png" alt=""></a>
                    <ul class="dropdown-menu" id="cart_drops_cont" style="margin: 0 !important;padding:5px 10px; min-width:220px !important; height:425px; overflow-x:hidden; overflow-y:scroll; margin-bottom:10px;">
                        <!-- dropdown menu links -->

                        <!--                        <li>
                                                    <a>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/7675-iTour20_1024x1024.jpg" class="dropimg">
                                                        <ul class="block_ul">
                                                            <li><b>Product name</b></li>
                                                            <li>&pound; 155</li>
                                                            <li>3 followers</li>
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/7675-iTour20_1024x1024.jpg" class="dropimg">
                                                        <ul class="block_ul">
                                                            <li><b>Product name</b></li>
                                                            <li>&pound; 155</li>
                                                            <li>3 followers</li>
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/7675-iTour20_1024x1024.jpg" class="dropimg">
                                                        <ul class="block_ul">
                                                            <li><b>Product name</b></li>
                                                            <li>&pound; 155</li>
                                                            <li>3 followers</li>
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/7675-iTour20_1024x1024.jpg" class="dropimg">
                                                        <ul class="block_ul">
                                                            <li><b>Product name</b></li>
                                                            <li>&pound; 155</li>
                                                            <li>3 followers</li>
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </a>
                                                </li>
                        
                                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shoppingCart" class="site_hint">Open Shopping Cart</a></li>-->
                    </ul>
                </div>


            </div>


            <ul class="main-nav fright">          

                <?php if (Yii::app()->user->isGuest) { ?>
                    <li><a href="#join" role="button"  data-toggle="modal">Join</a></li>
                    <!--class="signupForm" <?= Yii::app()->request->baseUrl; ?>/home/register-->
                    <li><a href="#login" role="button"  data-toggle="modal">Login</a></li>
                    <!--class="loginForm"<?php echo Yii::app()->request->baseUrl; ?>/home/login/-->
                <?php } else { ?>
                    <li class="dropdown notf-menu" id="not_butt" style="margin-right: 2px;">
                        <?php
                        $notif_count = 0;
                        $criteria = new CDbCriteria;
                        $criteria->condition = 'user_id=' . Yii::app()->user->id;
                        $criteria->addCondition('status = 0');

                        $n_c = Notifications::model()->count($criteria);
                        $style = "";

                        if ($n_c == 0) {
                            $style = "background: #ccc;color: #fff;";
                        }

                        if ($n_c > 900) {
                            $notif_count = "+900";
                        } else {
                            $notif_count = $n_c;
                        }
                        ?>
                        <a href="#" class="dropdown-toggle numberCircle" style="<?php echo $style; ?>font-size: 12px;display: block;line-height: 20px;margin-top: 9px;margin-right: 5px;padding: 0 5px !important;" >
                            <?php echo $notif_count; ?>
                            <!--<img src="<?= Yii::app()->request->baseUrl; ?>/img/notf_img.png" alt="" class="userimg">-->
                        </a>
                        <ul class="dropdown-menu" style="margin-top: 0;">     
                            <?php
                            $criteria = new CDbCriteria;
                            $criteria->condition = 'user_id=' . Yii::app()->user->id;
                            $criteria->order = 'id DESC';
                            $criteria->limit = 5;
                            $notifs = Notifications::model()->findAll($criteria);
                            ?>
                            <?php if ($notifs) { ?>
                                <?php foreach ($notifs as $nt) { ?>
                                    <?php
                                    $str = "";
                                    if ($nt->notif_type == 5 || $nt->notif_type == 7) {
                                        $str = "<a style='font-size: 13px;' class='notf_links' href='" . Yii::app()->request->baseUrl . "/home/user/" . $nt->other->username . "'>" . $nt->other->username . "</a> " . $nt->notification->type;
                                    } else {
                                        $str = $nt->notification->type;
                                    }
                                    ?>
                                    <li style="font-size: 14px;"><span style="font-size: 13px;"><?php echo $str; ?></span></li>   
                                <?php } ?>
                            <?php } ?>  
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/notifications" style="text-transform: none;" class="all-not smalltxt">View All Notifications</a></li>         
                        </ul>                        

                    <li class="dropdown mdrp"><a href="javascript:void(0)" >
                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/user_img.png" alt="" class="userimg"></a>
                        <ul class="dropdown-menu" style="margin-top: 0;">                      
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->getState("username"); ?>" style="text-transform: none; color:#000 !important;">My Profile</a></li>  
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile" style="text-transform: none; color:#000 !important;">My Account</a></li>   
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/settings" style="text-transform: none; color:#000 !important;">Account Settings</a></li> 
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/messages" style="text-transform: none; color:#000 !important;">Messages</a></li> 
                            <?php if (Yii::app()->user->getState('group') != '2') { ?>
                                <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/createShop" style="text-transform: none; color:#000 !important;">Apply for a Shop</a></li> 
                            <?php } ?>
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/orders" style="text-transform: none; color:#000 !important;">My Purchases</a></li>
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/logout" style="text-transform: none; color:#000 !important;">Logout</a></li>               
                        </ul>                        
                    </li>
                    <?php if (!Yii::app()->user->isGuest) { ?>
                        <?php if (Yii::app()->user->getState('group') == '2') { ?>
                            <?php $m_shop = Shop::model()->findByAttributes(array('seller_id' => Yii::app()->user->id)); ?>
                            <?php if ($m_shop) { ?>
                                <li class="dropdown mdrp"><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $m_shop->slug; ?>" >
                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/shop.png" />
                                    </a>
                                    <ul class="dropdown-menu" style="margin-top: 0;">                      
                                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/shopDetails-<?php echo $m_shop->slug; ?>" style="text-transform: none; color:#000 !important;">My Shop</a></li> 
                                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/profile/shop" style="text-transform: none; color:#000 !important;">Shop Settings</a></li> 
                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/payouts?filter=completed" style="text-transform: none; color:#000 !important;">Orders</a></li>
                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/products" style="text-transform: none; color:#000 !important;">Manage Products</a></li>
                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/createproduct" style="text-transform: none; color:#000 !important;">Add Product</a></li>
                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/payouts" style="text-transform: none; color:#000 !important;">Payouts</a></li>
                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/profile/coupons" style="text-transform: none; color:#000 !important;">Coupons</a></li>               
                                    </ul>                        
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>

                <li class="dropdown mdrp"><a href="javascript:void(0)" ><b class="caret"></b></a>
                    <ul class="dropdown-menu" style="margin-top: 0;">
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/about_us" style="text-transform: none; color:#000 !important;">About Us</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(4); ?>" style="text-transform: none; color:#000 !important;">How to use Paypal to pay</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(5); ?>" style="text-transform: none; color:#000 !important;">Buyers Help Page</a></li>
                        <?php $sel_flag = false; ?>
                        <?php if (Yii::app()->user->isGuest) { ?>
                            <?php $sel_flag = true; ?>
                        <?php } else if (Yii::app()->user->getState('group') === 1 || Yii::app()->user->getState('group') === 6) { ?>
                            <?php $sel_flag = true; ?>
                        <?php } else { ?>
                            <?php $sel_flag = false; ?>
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(6); ?>" style="text-transform: none; color:#000 !important;">Sellers Manual</a></li>
                        <?php } ?>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(2); ?>" style="text-transform: none; color:#000 !important;">Privacy Policy</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(3); ?>" style="text-transform: none; color:#000 !important;">Terms & Conditions</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(7); ?>" style="text-transform: none; color:#000 !important;">Billing Policy</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/contact" style="text-transform: none; color:#000 !important;">Contact Us</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/faq" style="text-transform: none; color:#000 !important;">FAQ</a></li>
                        <?php if ($sel_flag) { ?>
                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink2(9); ?>" style="text-transform: none; color:#000 !important;">Sell With Us?</a></li>
                        <?php } ?>
                    </ul>                        
                </li>
            </ul>

        </div>
    </div>
    <div class="row-fluid">
        <div class="container" style="position:relative">
             <div id="fav_bar">
        <?php if (!Yii::app()->user->isGuest) { ?>
            <?php $this->renderPartial('//home/favourite_bar'); ?>
        <?php } ?>
            </div>   
        </div>
    </div>
    


    <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="join" class="modal hide fade modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h3 id="myModalLabel">Join</h3>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-register-form',
            'action' => Yii::app()->createUrl('/home/register'),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'class' => 'form-horizontal',
            ),
        ));
        ?>
        <div class="modal-body login_sys">

            <div class="control-group" id="reg-error-div" style="">
            </div>
            <div class="control-group">
                <label class="control-label" for="inputName" style="font-weight: normal;">First name</label>
                <div class="controls">
                    <?php echo $form->textField($this->user_signUp, 'fname', array()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail" style="font-weight: normal;">Last name</label>
                <div class="controls">
                    <?php echo $form->textField($this->user_signUp, 'lname', array()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword" style="font-weight: normal;">Username</label>
                <div class="controls">
                    <?php echo $form->textField($this->user_signUp, 'username', array()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputConfirm" style="font-weight: normal;">Email</label>
                <div class="controls">
                    <?php echo $form->textField($this->user_signUp, 'email', array()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword" style="font-weight: normal;">Password</label>
                <div class="controls">
                    <?php echo $form->passwordField($this->user_signUp, 'password', array()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputConfirm" style="font-weight: normal;">Confirm password</label>
                <div class="controls">
                    <?php echo $form->passwordField($this->user_signUp, 'password_repeat', array()); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php
            echo CHtml::ajaxSubmitButton(
                    'Submit', array('/home/register'), array(
                'beforeSend' => 'function(){
                                             $("#reg").attr("disabled",true);
            }',
                'complete' => 'function(){
                                             //$("#user-register-form").each(function(){ this.reset();});
                                             $("#reg").attr("disabled",false);
                                        }',
                'success' => 'function(data){  
                   var x=data.split("*-*");
                                             if(x[0] == "wrong"){
                         $("#reg-error-div").show();
                                                $("#reg-error-div").html("<h5>Register failed!</h5>");$("#reg-error-div").append(x[1]);
                                        
                                      }
          else{
           $("#user-register-form").html("<h4 style=\"color:#000;text-align:center;margin-left=10px;line-height: 45px;font-weight:normal;font-size:16px;\">An activation email has been sent to your inbox. Kindly verify your email address to complete registration.</h4>");
                //parent.location.href = "' . Yii::app()->request->baseUrl . '/home";
                                                
                                             }
 
                                        }'
                    ), array("id" => "reg", "class" => "btn btn-primary btn-follow")
            );
            ?>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>
<!--========================================== end modal ================================================-->


<!--============================================ modal===================================================-->
<!-- Modal -->
<div id="login" class="modal hide fade modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Login</h3>
    </div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'action' => Yii::app()->createUrl('/home/Login'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => false,
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal',
        ),
    ));
    ?>
    <div class="modal-body login_sys">
        <div id="login-error-div" class="errorMessage" style="display: none;"></div>
        <div class="control-group">
            <label class="control-label" for="inputEmail" style="font-weight: normal;">Username</label>
            <div class="controls">
                <?php echo $form->textField($this->user_login, 'username', array('placeholder' => '')); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword" style="font-weight: normal;">Password</label>
            <div class="controls">
                <?php echo $form->passwordField($this->user_login, 'password', array()); ?>
            </div>
        </div>
        <div class="control-group" style="float:left;">
            <div class="controls">
                <!--<a href="<?php echo Yii::app()->getBaseUrl(true); ?>#collapseTwo" class="accordion-toggle forget" data-parent="#accordion2" data-toggle="collapse">Forget your password?</a>-->
                <a href="#fgt" role="button" style="color: #666;" class=""  data-dismiss="modal" aria-hidden="true" data-toggle="modal">Forgot your password?</a>
            </div>
        </div>
    </div>
    <div class="modal-footer">

        <?php
        $lk = 'parent.location.href = "' . Yii::app()->request->baseUrl . '/home";';
        if ($this->action->Id == "shoppingCart") {
            $lk = 'parent.location.href = "' . Yii::app()->request->baseUrl . '/home/checkout";';
        }
        ?>
        <?php
        echo CHtml::ajaxSubmitButton(
                'Log In', array('/home/login'), array(
            'beforeSend' => 'function(){
                                             $("#login2").attr("disabled",true);
                          }',
            'complete' => 'function(){
                                             $("#login-form").each(function(){ this.reset();});
                                             $("#login2").attr("disabled",false);
                                        }',
            'success' => 'function(data){  
                      if(data != "done"){
                      $("#login-error-div").show();
                      $("#login-error-div").html("<h4>Login failed! "+data+".</h4>");
                    }else{
                      $("#login-form").html("<h4 style=\"margin-left: 10px;font-weight: normal !important;\">Login Successful! Please Wait...</h4>");
                      ' . $lk . '
                    }
 
                                        }'
                ), array("id" => "login2", "class" => "btn btn-primary btn-follow")
        );
        ?>
        <a href="#join" role="button"  class="btn"  data-dismiss="modal" aria-hidden="true" data-toggle="modal">Register</a>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

    </div>
    <?php $this->endWidget(); ?>
</div>



<div id="fgt" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="width: 530px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Reset Password</h3>
    </div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'fg-form',
        'action' => Yii::app()->createUrl('/home/forgotpass'),
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'validateOnType' => false,
        ),
        'htmlOptions' => array(
            'class' => 'form-vertical',
        ),
    ));
    ?>
    <div class="modal-body login_sys">
        <div class="errorMessage" style="font-size: 14px;">Please enter your email and we will send you a link to change your password.</div>
        <div id="fg-error-div" class="errorMessage" style="display: none;color: red;font-size: 14px;"></div>
        <div class="control-group" style="margin-bottom: 0 !important;">
            <label class="control-label" for="inputEmail" style="font-weight: normal;"></label>
            <div class="controls" id="fgt_em">
                <input type="text" name="email" style="width: 485px !important;" />
            </div>
        </div>
    </div>
    <div class="modal-footer">

        <?php
        $lk = 'parent.location.href = "' . Yii::app()->request->baseUrl . '/home";';
        ?>
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reset password', array('/home/forgotpass'), array(
            'beforeSend' => 'function(){
                                             $("#fg2").attr("disabled",true);
                          }',
            'complete' => 'function(){
                                             $("#fg-form").each(function(){ this.reset();});
                                             $("#fg2").attr("disabled",false);
                                        }',
            'success' => 'function(data){  
                      $("#fg-error-div").show();
					  if(data!="2")
					  {
						  $("#fg-error-div").html("<h4>"+data+"</h4>");
						  $("#fgt_em").hide();
						  $("#fg2").hide();
					  }
                                        }'
                ), array("id" => "fg2", "class" => "btn btn-primary btn-follow")
        );
        ?>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

    </div>
    <?php $this->endWidget(); ?>
</div>



<?php
Yii::app()->clientScript->registerScript('share', '
                $("body").on("click",".shr",function(){
                    $("#share_fb").attr("href","https://www.facebook.com/dialog/feed?app_id=409482105858611&display=popup&picture="+$(this).attr("simage")+"&description="+$(this).attr("desc")+"&caption='.Yii::app()->request->getBaseUrl('webroot').'&name="+$(this).attr("sname")+"&redirect_uri="+$(this).attr("link")+"&link="+$(this).attr("link"));
                    $("#share_tw").attr("href","https://twitter.com/share?url="+$(this).attr("link"));
                });
            ');
?>

<div id="share_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Share</h3>
    </div>
    <div class="modal-body share-div">
        <a id="share_fb" target="_blank" href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/fb-share.png"></a><br />
        <a id="share_tw" target="_blank" href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/tw-share.png"></a>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('favourited', "
var flag = true;
$('body').on('click','.delfav',function(){
  if(flag){
    var ths = $(this);
    var x = ths.attr('pid');
    flag = false;
    $.ajax({
      url : '" . Yii::app()->request->baseUrl . "/home/favproduct/'+x,
      success : function(data){
                                $.ajax({
                                    url : '" . Yii::app()->request->baseUrl . "/home/update_favourite/',
                                    success : function(data){
                                        if(data != 'z'){
                                            $('#fav_bar').html(data);
                                        }
                                    }
                                });
                                if($('img#prod_'+ths.attr('pid')).size() > 0){
                                $('img#prod_'+ths.attr('pid')).attr('src','" . Yii::app()->request->baseUrl . "/img/fav.png');
                                }
        flag = true;
      }
    });  
  }
});
");
?>