<?php
$this->pageTitle = Yii::app()->name . ' - Followed Shops';
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
Yii::app()->clientScript->registerScript('options_folshops_586587', '
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
                    $filter = "No Filter";
                    $search_filter = "basic";
                    ?>
                    <input type="hidden" name="filter" value="<?php echo $search_filter; ?>" />
                    <input class="" id="appendedInputButtons" name="query" value="" type="text">
                    <button class="btn" type="submit">Search</button>
                    <button class="btn dropdown-toggle" id="op_men" type="button" data-toggle="dropdown"><?php echo $filter; ?>&nbsp;<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a class="op_men_it" filter="basic" href="javascript:void(0)">No Filter</a></li>
                        <li><a class="op_men_it" filter="newest" href="javascript:void(0)">Newest</a></li>
                        <?php if (!Yii::app()->user->isGuest) { ?>
                            <li><a class="op_men_it" filter="following" href="javascript:void(0)">Following</a></li>
                        <?php } ?>
                        <li><a class="op_men_it" filter="random" href="javascript:void(0)">Random</a></li>
                    </ul>
                    <?php
                    $action = Yii::app()->controller->action->id;
                    $url = array('home/followedshops');
                    if ($action == "search_shops") {
                        $url = array('home/search_shops', 'filter' => $filter, 'query' => $query);
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
                <div class="row-fluid shops-banners shops " id="shlist">

                    <?php $this->renderPartial($view, array('shops' => $shops,)); ?> 
                </div>
                <?php
                $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                    'contentSelector' => '#shlist',
                    'itemSelector' => 'div.shan',
                    'pages' => $pages,
                ));
                ?>
            </div>
        </div>
    </div>
</div>

