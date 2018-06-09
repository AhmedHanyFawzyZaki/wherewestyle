<?php
$this->pageTitle = Yii::app()->name . ' - ' . $model->title;
?>

<?php
Yii::app()->clientScript->registerScript('scroll', '
    
    

');
?>
<?php
Yii::app()->clientScript->registerScript('follow', "
var flag = true;
$('body').on('click','.follow2',function(){
  if(flag){
    var ths = $(this);
    var x = ths.attr('sid');
    flag = false;
    $.ajax({
      url : '" . Yii::app()->request->baseUrl . "/home/followshop?id='+x+'&type=shop',
      dataType:'json',
      success : function(data){
        if(data.result != 'error'){
          ths.html(data.result);  
          $('.shfp_'+x).html(data.result);
          $('#shppp').html(data.count);
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
                var sts = ths.attr('status');
                setTimeout(function(){
                    if(sts == 'fvd'){
                        ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav.png');
                    }else if(sts == 'unfvd'){
                        ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav-remove.png');
                    }
                },500);
		$.ajax({
			url : '" . Yii::app()->request->baseUrl . "/home/favproduct/'+x,
			success : function(data){
				flag = true;
				if(data == 'fav'){
					//ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav-remove.png');
                                        ths.attr('status','fvd');
                                        $('#itm_'+x).animate({top : -55},100);
                                        $('#itm_'+x).attr('chk','no');
                                        
                                        $('#temp_'+x).html('Product saved! Add to cart? <img src=\'http://www.mazeguy.net/basic/smile.gif\' />');
                                        $('#temp_'+x).animate({top : 0},100).delay(3000).animate({top : -55},100,function(){
                                            $('#itm_'+x).attr('chk','true');
                                            if($('#itm_'+x).parent('.span3').is(':hover')){
                                                $('#itm_'+x).animate({top : 0},100); 
                                            }
                                            $('#temp_'+x).html('');
                                        });
                                        
				}else if(data == 'removed'){
					//ths.children('img').attr('src','" . Yii::app()->request->baseUrl . "/img/fav.png');
                                        ths.attr('status','unfvd');
                                        $('#itm_'+x).animate({top : -55},100);
                                        $('#itm_'+x).attr('chk','no');
                                        
                                        $('#temp_'+x).html('Product Removed!');
                                        $('#temp_'+x).animate({top : 0},100).delay(3000).animate({top : -55},100,function(){ 
                                            $('#itm_'+x).attr('chk','true');
                                            if($('#itm_'+x).parent('.span3').is(':hover')){
                                                $('#itm_'+x).animate({top : 0},100); 
                                            }
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
                    $.ajax({
                        url : "' . Yii::app()->request->baseUrl . '/home/cart_drop/",
                        success : function(data){
                            $("#cart_drops_cont").html(data);
                        }
                    });
                    $("#cart_drops_cont").show();
                }
            });
    });
');
?>
<?php
Yii::app()->clientScript->registerScript('options_shop_586587', '
    $(".op_men_it").click(function(){
        var ths = $(this);
        var x = ths.html();
        if(ths.attr("filter") != $("input[type=hidden][name=filter]").val()){
            $("#op_men").html(x+"&nbsp;<span class=\"caret\"></span>");
            $("input[type=hidden][name=filter]").val(ths.attr("filter"));
            $("#search-products-form").submit();
        }
    });
');
?>


<div class="row-fluid">
    <div class="container">
        <div class="shops-banners item-page-sale" style="width: 100%;">
            <div class="row-fluid shops-filterr">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'search-products-form',
                    'method' => 'get',
                    'action' => Yii::app()->createUrl('/home/search_products'),
                ));
                ?>
                <div class="input-append filter">
                    <?php
                    $filter = "No Filter";
                    $search_filter = "basic";
                    ?>
                    <input type="hidden" name="filter" value="<?php echo $search_filter; ?>" />
                    <input type="hidden" name="type" value="shop" />
                    <input type="hidden" name="spec_id" value="<?php echo $model->id; ?>" />
                    <input type="hidden" name="min_price" id="min_price" value="" />
                    <input type="hidden" name="max_price" id="max_price" value="" />
                    <input class="" id="appendedInputButtons" name="query" value="" type="text">
                    <button class="btn" type="submit">Search</button>
                    <button class="btn dropdown-toggle" id="op_men" type="button" data-toggle="dropdown"><?php echo $filter; ?>&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="op_men_it" filter="basic" href="javascript:void(0)">No Filter</a></li>
                        <li><a class="op_men_it" filter="newest" href="javascript:void(0)">Newest</a></li>
                        <li><a class="op_men_it" filter="price_low_high" href="javascript:void(0)">Price (Low - High)</a></li>
                        <li><a class="op_men_it" filter="price_high_low" href="javascript:void(0)">Price (High - Low)</a></li>
                        <li><a class="op_men_it" filter="recently_bought" href="javascript:void(0)">Recently Bought</a></li>
                        <li><a class="op_men_it" filter="store_sale" href="javascript:void(0)">Store-wide Sale</a></li>
                        <?php if (!Yii::app()->user->isGuest) { ?>
                            <li><a class="op_men_it" filter="following" href="javascript:void(0)">Following</a></li>
                            <li><a class="op_men_it" filter="saved" href="javascript:void(0)">Saved</a></li>
                        <?php } ?>
                    </ul>
                    <?php
                    echo CHtml::link(
                            "<i class='icon-th icon-white'></i>&nbsp; Grid", array('home/shopDetails',
                        'flag' => 'grid', 'slug' => $slug,
                            ), array(
                        'class' => 'btn btn-success list',
                    ));
                    ?>

                    <?php
                    echo CHtml::link(
                            "<i class='icon-th-list icon-white'></i>&nbsp; List", array('home/shopDetails',
                        'flag' => 'list', 'slug' => $slug,
                            ), array(
                        'class' => 'btn btn-success grid',
                    ));
                    ?>

                    <?php
                    echo CHtml::link(
                            "<i class='icon-white icon-random'></i>&nbsp; Express", array('home/shopDetails',
                        'flag' => 'express', 'slug' => $slug,
                            ), array(
                        'class' => 'btn btn-success express',
                    ));
                    ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>

            <div class="row-fluid shops-banners shops">
               
                <div class="row-fluid" style="border-top: 1px solid #ccc;">
                    <div class="pull-right">
                        <span class="followers" id="shppp" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?= Helper::getShopFollowers($model->id, ''); ?></span>
                        <span class="followers" id="shppp2" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?= Helper::following_count($model->seller_id, 'shop'); ?></span>
                        <?php if (Yii::app()->user->isGuest) { ?>
                            <a href="#login" role="button"  data-toggle="modal" class="follow"  style="float: left;border-right: 1px solid #ccc;padding: 10px;">follow</a>
                        <?php } else { ?>
                            <?php
                            $str = "follow";
                            if (Helper::check_follow_shop($model->id))
                                $str = "unfollow";
                            ?>
                            <a href="javascript:void(0)" sid='<?php echo $model->id; ?>' class="follow follow2" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?php echo $str; ?></a>
                        <?php } ?>

                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/user/<?php echo $model->seller->username; ?>" class="follow " style="float: left;border-right: 1px solid #ccc;padding: 10px;" ><?php echo $model->seller->username; ?></a>


                        <a class="" simage="<?= Yii::app()->getBaseUrl(true) . Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $model->image; ?>" sname="<?php echo $model->title; ?>" desc="<?php echo strip_tags($model->desc); ?>" link="<?php echo Yii::app()->getBaseUrl(true); ?>/home/shopDetails/<?php echo $model->slug; ?>" role="button" data-toggle="modal" href="#share_popup" style="float: left;padding: 6px 10px;"><img src="<?= Yii::app()->request->baseUrl; ?>/img/share2.png"></a> 

                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid shops-banners item-page-sale" style="margin-top:10px;">
            <?php
            $st = "";
            if ($view == "express") {
                $st = "padding-top: 70px;";
            }
            ?>
            <div class="row-fluid shops-banners" style="margin-top:0px;<?php echo $st; ?>" id='listing'>
                <?php $this->renderPartial($view, array('products' => $products, 'sale' => true, 'show_shop' => false)); ?>
            </div>
            <div id="done_img"></div>
            <?php if ($view != 'express') { ?>
                <?php
                    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                        'contentSelector' => '#listing',
                        'itemSelector' => 'div.shan',
                        'loadingText' => 'Loading...',
                        'donetext' => '',
                        'pages' => $pages,
                        'navigationLinkText'=>'',
                        'loadingImg'=> Yii::app()->request->baseUrl.'/img/fav.png',
                    ));
                ?>
            <?php } ?>
        </div>


    </div>
</div>