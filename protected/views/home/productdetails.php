<?php
$this->pageTitle = Yii::app()->name . ' - ' . $model->title;
?>

<?php
Yii::app()->clientScript->registerScript('cart', '
    var limit = parseInt("' . $model->stock . '");
    $("#add_to_cart").click(function(){
        var y = $("#quantity").val();
        var x = "";
        if(y.trim() == ""){
            x = 1;
        }else{
            x = parseInt($("#quantity").val());
        }
        if(y.match(/^[0-9]+$/) == null && y.trim() != ""){
            alert("the quantity should be an integer number");
        }else if(x > limit || x < 1){
            alert("the quantity for this item should be between 1 and "+limit+" items");
        }else{
            $.ajax({
                url : "' . Yii::app()->request->baseUrl . '/home/cart/' . $model->id . '",
                type : "post",
                dataType : "json",
                data : { quantity:x },
                success : function(data){
                    $("#cart_count").html(data.count);
                    $("#header_cost").html("&pound; "+data.cost);
                    $.ajax({
                        url : "' . Yii::app()->request->baseUrl . '/home/cart_drop/",
                        success : function(data){
                            $("#cart_drops_cont").html(data);
                        }
                    });
                    $("#cart_drops_cont").show();
                }
            });
        }
    });
');
?>
<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <ul class="breadcrumb">
                <li><a href="<?= Yii::app()->request->baseUrl; ?>">Home</a> <span class="divider">/</span></li>
                <li class="active"><?= $model->title ?></li>
            </ul>
            <div class="row-fluid">
                <div class="span6 gallery">


                    <div class="product-zoom">
                        <img id="img_01" src="<?= Yii::app()->request->baseUrl . '/media/products/original/' . $model->main_image; ?>" data-zoom-image="<?= Yii::app()->request->baseUrl . '/media/products/original/' . $model->main_image; ?>" class="main-zoom-img"/>

                        <div id="gal1" class="gal1">
                            <a href="#" data-image="<?= Yii::app()->request->baseUrl . '/media/products/original/' . $model->main_image; ?>" data-zoom-image="<?= Yii::app()->request->baseUrl . '/media/products/original/' . $model->main_image; ?>" style="height:95px;overflow: hidden;">
                                <img class="active" style="min-height:95px !important;min-width: 100%;" id="img_01" src="<?= Yii::app()->request->baseUrl . '/media/products/thumbs_266X300/' . $model->main_image; ?>" />
                            </a>
                            <?php if ($gallery) { ?>
                                <?php foreach ($gallery as $image) { ?>
                                    <a href="#" data-image="<?= Yii::app()->getBaseUrl(true) ?>/gallery/<?= $image['id'] ?>.jpg" data-zoom-image="<?= Yii::app()->getBaseUrl(true) ?>/gallery/<?= $image['id'] ?>.jpg" style="height:95px;overflow: hidden;">
                                        <img style="min-height:95px !important;min-width: 100%;" class="active" id="img_01" src="<?= Yii::app()->getBaseUrl(true) ?>/gallery/<?= $image['id'] ?>small.jpg" />
                                    </a>
                                <?php } ?>
                            <?php } ?>


                        </div>
                    </div>

                </div>
                <div class="span6 item_details">
                    <h3><?= $model->title; ?></h3>
                    <div style="min-height: 100px;"><?= $model->desc; ?></div>
                    <hr>
                    <div class="row-fluid item_price">
                        <?php
                        $curr_symbol = Yii::app()->params['dc_symbol'];
                        $rate = '1';
                        if (!Yii::app()->user->isGuest) {
                            $curr_symbol = Yii::app()->user->getState('currency_symbol');
                            $rate = Yii::app()->user->getState('currency_rate');
                        }
                        ?>
                        <div class="fleft" style="line-height: 46px;"><i class="icon-tag icon-2"></i></div>

                        <div class="fleft" style="line-height: 46px;"><?php echo $curr_symbol . "  " . $model->price * $rate; ?></div>
                        <?php if ($model->sale) { ?>
                            <div class="fleft original" style="line-height: 46px;"><?php echo $curr_symbol . "  " . $model->old_price * $rate; ?></div>
                        <?php } ?>

                        <div class="fright"><a href="javascript:void(0)" id="add_to_cart" class="btn btn-large btn-sample">Add to Cart</a></div>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span4">
                            <label>Quantity :</label>
                            <input type="text" id="quantity" name="quantity" placeholder="Quantity" class="quant">
                        </div>


                    </div>
                    <hr>
                    <div class="row-fluid social">
                        <div class="offset7 span5 icons" style="margin-left: 0 !important;width: 100% !important;">
                            <span class="shareit">Share it :</span>

                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style " style="margin-top: 5px;">
                                <a class="addthis_button_facebook_like" fb:like:layout="button_count" style="margin-top: -6px;"></a>
                                <a class="addthis_button_tweet"></a>
                                <a class="addthis_button_google_plusone" g:plusone:size="horizontal" ></a>
                                <a class="addthis_counter addthis_pill_style"></a>
                            </div>
                            <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-526f83c15dee2150"></script>
                            <!--AddThis Button END -->

                        </div>
                    </div>

                </div>

                <div class="row-fluid">
                </div>


            </div>
            <br>
            <?php if ($similar) { ?>
                <div class="row-fluid">
                    <div class="well">
                        <div id="myCarousel" class="carousel slide">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row-fluid">
                                        <?php for ($i = 0; $i < 4; $i++) { ?>
                                            <?php if ($i < count($similar)) { ?>
                                                <?php
                                                $pimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
                                                if ($similar[$i]->main_image) {
                                                    if (file_exists('media/products/original/' . $similar[$i]->main_image)) {
                                                        $pimage = Yii::app()->request->baseUrl . '/media/products/original/' . $similar[$i]->main_image;
                                                    }
                                                }
                                                ?>
                                                <div class="span3">
                                                    <a href="<?= Yii::app()->request->baseUrl . '/home/productDetails/' . $similar[$i]->slug; ?>" class="thumbnail"><img src="<?= $pimage; ?>" alt="Image" style="min-width:100%;min-height: 215px;" /></a>
                                                    <a class="title_prod" href="<?= Yii::app()->request->baseUrl . '/home/productDetails/' . $similar[$i]->slug; ?>"><?= $similar[$i]->title; ?><br><br>&nbsp;<?php echo $curr_symbol . "  " . $similar[$i]->price * $rate; ?></a>
                                                    
													<?php /*if ($similar[$i]->sale) { ?>
                                                        <div class="fleft original" style="line-height: 46px;"><?php echo $curr_symbol . "  " . $similar[$i]->old_price * $rate; ?></div>
                                                    <?php }*/ ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div><!--/row-fluid-->
                                </div><!--/item-->
                                <?php if (count($similar) > 4) { ?>
                                    <div class="item">
                                        <div class="row-fluid">
                                            <?php for ($i = 4; $i < 8; $i++) { ?>
                                                <?php if ($i < count($similar)) { ?>
                                                    <?php
                                                    $pimage = Yii::app()->request->baseUrl . '/img/' . "default_product_image.jpg";
                                                    if ($similar[$i]->main_image) {
                                                        if (file_exists('media/products/original/' . $similar[$i]->main_image)) {
                                                            $pimage = Yii::app()->request->baseUrl . '/media/products/original/' . $similar[$i]->main_image;
                                                        }
                                                    }
                                                    ?>
                                                    <div class="span3">
                                                        <a href="<?= Yii::app()->request->baseUrl . '/home/productDetails/' . $similar[$i]->slug; ?>" class="thumbnail"><img src="<?= $pimage; ?>" alt="Image" style="min-width:100%;min-height: 215px;" /></a>
                                                        <a class="title_prod" href="<?= Yii::app()->request->baseUrl . '/home/productDetails/' . $similar[$i]->slug; ?>"><?= $similar[$i]->title; ?>&nbsp;<br><br><?php echo $curr_symbol . "  " . $similar[$i]->price * $rate; ?></a>
													<?php /*if ($similar[$i]->sale) { ?>
                                                        <div class="fleft original" style="line-height: 46px;"><?php echo $curr_symbol . "  " . $similar[$i]->old_price * $rate; ?></div>
                                                    <?php }*/ ?>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div><!--/row-fluid-->
                                    </div><!--/item-->
                                <?php } ?>
                            </div><!--/carousel-inner-->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                        </div><!--/myCarousel-->
                    </div><!--/well-->
                </div>
            <?php } ?>
        </div>

    </div>

</div>
<script src="<?= Yii::app()->getBaseUrl(true) ?>/js/jquery.elevatezoom.js"></script>
<script>
    $('#img_01').elevateZoom({
        gallery: 'gal1',
        zoomType: "inner",
        cursor: "crosshair",
        easing: true,
    });



    //pass the images to Fancybox
    $("#img_01").bind("click", function(e) {
        var ez = $('#img_01').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });

</script>