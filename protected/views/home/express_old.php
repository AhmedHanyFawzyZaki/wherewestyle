


    <?php if ($products) { ?>
<div class="item-page">
        <div id="scroller" style="position: relative;height: 394px;overflow: hidden;">
            <div id="inner_scroll" style="position: absolute;top: 0;">
                <!--
                repeated div auto scroll
                ==============================================================-->
                <?php
                if ($products) {
                    foreach ($products as $product) {
                        ?>
                        <div class="row-fluid scroll-item">

                            <div class="span6 gallery">
                                <div class="product-zoom"> <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/products/original/<?php echo $product->main_image; ?>" data-zoom-image="images/large/image1.jpg" class="main-zoom-img"/>
                                </div>
                            </div>

                            <div class="span6 item_details">
                                <h3><?php echo $product->title; ?></h3>
                                <p><?php echo $product->desc; ?></p>
                                <hr>

                                <div class="row-fluid item_price">
                                    <div class="span1"><i class="icon-tag icon-2"></i></div>
                                    <div><?php echo "&pound; " . $product->price; ?></div>
                                    <?php
                                    $str = "";
                                    $class = "carting";
                                    if (!Yii::app()->user->id) {
                                        $class = "";
                                        $str = 'href="#login" role="button"  data-toggle="modal"';
                                    }
                                    ?>
                                    <div class="offset4 span4 <?php echo $class; ?>" pid="<?php echo $product->id; ?>"><a <?php echo $str; ?> href="#" class="btn btn-large btn-sample">Add to Cart</a></div>
                                </div>

                                <hr>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

                <!--
                ==============================================================-->
            </div>
        </div>

        <div class="row-fluid">
            <div class="container">

                <div class="scroll_controls">
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/play.png" class="media_btn active" id="play" title="play" alt="play" id="play"/>
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/pause.png" class="media_btn" title="pause" alt="pause" id="pause"/>
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/inc.png" class="media_btn" title="increase speed" alt="increase speed" id="inc"/>
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/dec.png" class="media_btn" title="decrease speed" alt="decrease speed" id="dec"/>
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/media/reset.png" class="media_btn" title="reset" alt="reset" id="reset"/>
                </div>

            </div>
        </div>
    </div>
    <?php } else { ?>
        <div style="line-height: 30px;font-size: 20px;margin-bottom: 20px;margin-left: 20px;">there are no products</div>
    <?php } ?>



