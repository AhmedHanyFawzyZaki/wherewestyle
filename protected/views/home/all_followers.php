<?php
$this->pageTitle = Yii::app()->name . ' - Followers';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <h3 class="contitle">Users following <a href="<?php echo Yii::app()->request->baseUrl . "/home/shopDetails/" . $model->slug; ?>"><span style="color: #F62A64;"><?php echo $model->title; ?></span></a></h3>

                <div class="row-fluid shops-banners shops">
                    <div class="row-fluid topBanner clear s " style="height: 120px;">
                        <div class="span5" style="margin-left: 15px;">
                            <div class="linh">
                                <span class="shops-name"><?php echo $model->title; ?></span>
                                <span class="row-fluid " style="line-height:20px;max-height: 60px;overflow: hidden;display: block;"><?php echo $model->desc; ?></span>
                            </div>
                        </div>
                        <div class="span5">
                        </div> 
                    </div>
                    <div class="row-fluid" style="border-top: 1px solid #ccc;">
                        <div class="pull-right">
                            <span class="followers" id="shppp_<?php echo $model->id; ?>" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?= Helper::getShopFollowers($model->id, 'shop'); ?></span>
                            <span class="followers" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?= Helper::following_count($model->seller_id, 'shop'); ?></span>
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <a href="#login" role="button"  data-toggle="modal" class="follow"  style="float: left;border-right: 1px solid #ccc;padding: 10px;">follow</a>
                            <?php } else { ?>
                                <?php
                                $str = "follow";
                                if (Helper::check_follow_shop($model->id))
                                    $str = "unfollow";
                                ?>
                                <a href="javascript:void(0)" sid='<?php echo $model->id; ?>' class="follow follow2 shfp_<?php echo $model->id; ?>" style="float: left;border-right: 1px solid #ccc;padding: 10px;"><?php echo $str; ?></a>
                            <?php } ?>

                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/user/<?php echo $model->seller->username; ?>" class="follow " style="float: left;padding: 10px;" ><?php echo $model->seller->username; ?></a>

                        </div>
                    </div>
                </div>


                <table class="table table-striped">
                    <tbody id="shlist">
                        <?php if ($users) { ?>
                            <?php $i = 0; ?>
                            <?php while ($i < count($users)) { ?>
                                <tr class="shan">
                                    <td style="width: 50%;">
                                        <?php $shop = Shop::model()->findByAttributes(array('seller_id' => $users[$i]->id)); ?>
                                        <div style="text-align: left;padding: 10px 0px;">
                                            <?php
                                            if (!$users[$i]->image) {
                                                $bath = Yii::app()->request->baseUrl . "/img/user.png";
                                            } else {
                                                $bath = Yii::app()->request->baseUrl . "/media/members/thumbs_266X300/" . $users[$i]->image;
                                            }
                                            ?>
                                            <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/user/<?php echo $users[$i]->username; ?>"><img style="width: 50px;height: 50px;" src="<?= $bath ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $users[$i]->username; ?></span></a>
                                            <?php if ($shop) { ?>
                                                <?php if (Yii::app()->user->isGuest) { ?>
                                                    <a href="#login" role="button" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;"  data-toggle="modal" class="follow">follow</a>
                                                <?php } else { ?>
                                                    <?php
                                                    $str = "follow";
                                                    if (Helper::check_follow_shop($shop->id))
                                                        $str = "unfollow";
                                                    ?>
                                                    <a href="javascript:void(0)" sid='<?php echo $shop->id; ?>' style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;" class="follow follow2 shfp_<?php echo $shop->id; ?>"><?php echo $str; ?></a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <?php $i++; ?>
                                    <td style="width: 50%;">   
                                        <?php if ($i < count($users)) { ?>
                                            <?php $shop = Shop::model()->findByAttributes(array('seller_id' => $users[$i]->id)); ?>
                                            <div style="text-align: left;padding: 10px 0px;">
                                                <?php
                                                if (!$users[$i]->image) {
                                                    $bath = Yii::app()->request->baseUrl . "/img/user.png";
                                                } else {
                                                    $bath = Yii::app()->request->baseUrl . "/media/members/thumbs_266X300/" . $users[$i]->image;
                                                }
                                                ?>
                                                <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/home/user/<?php echo $users[$i]->username; ?>"><img style="width: 50px;height: 50px;" src="<?= $bath ?>" /><span style="margin-left: 5px;font-size: 16px;"><?php echo $users[$i]->username; ?></span></a>

                                                <?php if ($shop) { ?>
                                                    <?php if (Yii::app()->user->isGuest) { ?>
                                                        <a href="#login" role="button" style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;"  data-toggle="modal" class="follow">follow</a>
                                                    <?php } else { ?>
                                                        <?php
                                                        $str = "follow";
                                                        if (Helper::check_follow_shop($shop->id))
                                                            $str = "unfollow";
                                                        ?>
                                                        <a href="javascript:void(0)" sid='<?php echo $shop->id; ?>' style="float: right;background: linear-gradient(to bottom, #FF2B69 0%, #E6275C 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius: 4px;color: #FFFFFF;float: right;margin: 13px 10px;padding: 3px 12px;" class="follow follow2 shfp_<?php echo $shop->id; ?>"><?php echo $str; ?></a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td>This user doesn't have followers</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                    'contentSelector' => '#shlist',
                    'itemSelector' => 'tr.shan',
                    'pages' => $pages,
                ));
                ?>
            </div>	

        </div>
    </div>
</div>



<?php
Yii::app()->clientScript->registerScript('follow2', "
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
          $('#shppp_'+x).html(data.count);
        }
        flag = true;
      }
    });  
  }
});
");
?>