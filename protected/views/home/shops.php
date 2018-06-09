<?php
$this->pageTitle = Yii::app()->name . ' - Shops';
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
Yii::app()->clientScript->registerScript('options_shops_586587', '
    $(".op_men_it").click(function(){
        var ths = $(this);
        var x = ths.html();
        if(ths.attr("filter") != $("input[type=hidden][name=filter]").val() || ths.attr("filter")=="random"){
            $("#op_men").html(x+"&nbsp;<span class=\"caret\"></span>");
            $("input[type=hidden][name=filter]").val(ths.attr("filter"));
            $("#search-shops-form").submit();
        }
    });
');
?>

<div class="row-fluid">
    <div class="container">
        <div class="container item-page-sale">
            <div class="row-fluid shops-filterr">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'search-shops-form',
                    'method' => 'get',
                    'action' => Yii::app()->createUrl('/home/search_shops'),
                ));
                ?>
                <div class="input-append filter">
                    <?php
                    $filter = "Recently Updated";
                    if ($search_filter) {
                        if ($search_filter == "newest") {
                            $filter = "Newest";
                        } else if ($search_filter == "following") {
                            $filter = "Following";
                        } else if ($search_filter == "oldest") {
                            $filter = "Oldest";
                        } else if ($search_filter == "random") {
                            $filter = "Random";
                        } else if ($search_filter == "most_followers") {
                            $filter = "Most Followers";
                        } else if ($search_filter == "transactions") {
                            $filter = "Number Of Transactions";
                        } else if ($search_filter == "sws_lh") {
                            $filter = "Store-wide SALE (Low - High)";
                        } else if ($search_filter == "sws_hl") {
                            $filter = "Store-wide SALE (High - Low)";
                        }
                    } else {
                        $search_filter = "recently_updated";
                    }
                    $query = "";
                    if ($search_query) {
                        $query = $search_query;
                    }
                    ?>
                    <input type="hidden" name="filter" value="<?php echo $search_filter; ?>" />
                    <input type="hidden" name="flag" value="<?php echo $flag; ?>" />
                    <input class="" id="appendedInputButtons" name="query" value="<?php echo $query; ?>" type="text" placeholder="Find shop..">
                    <button class="btn" type="submit">Search</button>
                    <button class="btn dropdown-toggle" id="op_men" type="button" data-toggle="dropdown"><?php echo $filter; ?>&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="op_men_it" filter="recently_updated" href="javascript:void(0)">Recently Updated</a></li>
                        <li><a class="op_men_it" filter="newest" href="javascript:void(0)">Newest</a></li>
                        <li><a class="op_men_it" filter="oldest" href="javascript:void(0)">Oldest</a></li>
                        <li><a class="op_men_it" filter="most_followers" href="javascript:void(0)">Most Followers</a></li>
                        <li><a class="op_men_it" filter="transactions" href="javascript:void(0)">Number Of Transactions</a></li>
                        <li><a class="op_men_it" filter="sws_lh" href="javascript:void(0)">Store-wide SALE (Low - High)</a></li>
                        <li><a class="op_men_it" filter="sws_hl" href="javascript:void(0)">Store-wide SALE (High - Low)</a></li>
                        <?php if (!Yii::app()->user->isGuest) { ?>
                            <li><a class="op_men_it" filter="following" href="javascript:void(0)">Following</a></li>
                        <?php } ?>
                        <li><a class="op_men_it" filter="random" href="javascript:void(0)">Random</a></li>
                    </ul>
                    <?php
                    $action = Yii::app()->controller->action->id;
                    $url = array('home/shops');
                    if ($action == "search_shops") {
                        $url = array('home/search_shops', 'filter' => $search_filter, 'query' => $query);
                    }
                    ?>
                    <?php
                    echo CHtml::link(
                            "<i class='icon-th icon-white'></i>&nbsp; Grid", array_merge($url, array('flag' => 'grid')), array(
                        'class' => 'btn btn-success list',
                    ));
                    ?>

                    <?php
                    echo CHtml::link(
                            "<i class='icon-th-list icon-white'></i>&nbsp; List", array_merge($url, array('flag' => 'list')), array(//htmlOptions
                        'class' => 'btn btn-success grid',
                    ));
                    ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div id="listing">
                <div class="row-fluid shops-banners shops ">

                    <?php $this->renderPartial($view, array('shops' => $shops,)); ?> 
                </div>
            </div>
            <div id="done_img"></div>

            <?php
            $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                'contentSelector' => '#shlist',
                'itemSelector' => 'div.shan',
                'pages' => $pages,
                'navigationLinkText'=>'',
                'loadingImg'=> Yii::app()->request->baseUrl.'/img/fav.png',
                'loadingText' => 'Loading...',
            ));
            ?>
        </div>
    </div>
</div>

