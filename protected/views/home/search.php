<?php
$this->pageTitle = Yii::app()->name . ' - Search';
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
			url : '" . Yii::app()->request->baseUrl . "/home/followshop/'+x,
			dataType : 'json',
			success : function(data){
				if(data.result != 'error'){
					ths.html(data.result);
					$('.shfp_'+x).html(data.result);	
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
				}
                                $.ajax({
                                    url : '" . Yii::app()->request->baseUrl . "/home/update_favourite/',
                                    success : function(data){
                                        if(data != 'z'){
                                            $('#fav_bar').html(data);
                                            
                                        }
                                    }
                                });
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
<div class="row-fluid">
    <div class="container">

        <div class="row-fluid shops-banners item-page-sale">
            <div id="listing">
                <?php $this->renderPartial('_products_grid', array('products' => $products, 'sale' => false, 'show_shop' => true)); ?> 
            </div>
            <div id="done_img"></div>
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
        </div>      
    </div>
</div>