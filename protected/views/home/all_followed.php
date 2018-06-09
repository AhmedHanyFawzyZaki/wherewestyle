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


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <h3 class="contitle">The shops followed by <a href="<?php echo Yii::app()->request->baseUrl . "/home/user/" . $user->username; ?>"><span style="color: #F62A64;"><?php echo $user->username; ?></span></a></h3>


                <table class="table table-striped">
                    <tbody id="shlist">
                        <?php if ($shops) { ?>
                            <?php $i = 0; ?>
                            <?php while ($i < count($shops)) { ?>
                                <tr class="shan">
                                    <td style="width: 50%;">
                                        <div style="text-align: left;padding: 10px 0px;">
                                            <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $shops[$i]->slug; ?>"><img style="width: 50px;height: 50px;" src="<?= Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $shops[$i]->image; ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $shops[$i]->title; ?></span></a>
                                            <?php if (Yii::app()->user->isGuest) { ?>
                                                <a href="#login" role="button"  data-toggle="modal" class="follow" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;">follow</a>
                                            <?php } else { ?>
                                                <?php
                                                $str = "follow";
                                                if (Helper::check_follow_shop($shops[$i]->id))
                                                    $str = "unfollow";
                                                ?>
                                                <a href="javascript:void(0)" sid='<?php echo $shops[$i]->id; ?>' class="follow2" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;"><?php echo $str; ?></a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <?php $i++; ?>

                                    <td style="width: 50%;">
                                        <?php if ($i < count($shops)) { ?>
                                            <div style="text-align: left;padding: 10px 0px;">
                                                <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/shopDetails/<?php echo $shops[$i]->slug; ?>"><img style="width: 50px;height: 50px;" src="<?= Yii::app()->request->baseUrl; ?>/media/shops/original/<?= $shops[$i]->image; ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $shops[$i]->title; ?></span></a>
                                                <?php if (Yii::app()->user->isGuest) { ?>
                                                    <a href="#login" role="button"  data-toggle="modal" class="follow" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;">follow</a>
                                                <?php } else { ?>
                                                    <?php
                                                    $str = "follow";
                                                    if (Helper::check_follow_shop($shops[$i]->id))
                                                        $str = "unfollow";
                                                    ?>
                                                    <a href="javascript:void(0)" sid='<?php echo $shops[$i]->id; ?>' class="follow2" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;"><?php echo $str; ?></a>
                                                <?php } ?>
                                            </div>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td>this user doesn't follow any shop</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div id="done_img"></div>
                <?php
                $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                    'contentSelector' => '#shlist',
                    'itemSelector' => 'tr.shan',
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
</div>