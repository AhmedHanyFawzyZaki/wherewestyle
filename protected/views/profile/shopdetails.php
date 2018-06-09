<?php
$this->pageTitle = Yii::app()->name . ' - ' . $model->title;
?>

<?php
Yii::app()->clientScript->registerScript('activate', '
    $(".activate").click(function(){
        var ths = $(this);
        var x = ths.attr("pid");
        $.ajax({
            url : "' . Yii::app()->request->baseUrl . '/profile/activateproduct/"+x,
            success : function(data){
                if(data != "error"){
                    ths.html(data);
                }
            }
        });
    });
');
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <h4>Shop : <span class="site"><?php echo $model->title; ?></span></h4>
                    <div class="profile_img_div">
                        <?php if (!$products) { ?>
                            <h3>No Products in these shop Yet</h3>
                        <?php } ?>
                        <a href="<?= Yii::app()->request->baseUrl; ?>/profile/createproduct/<?php echo $model->id; ?>" class="btn btn-follow btn-large">
                            Add product</a>
                    </div>
                    <?php if ($products) { ?>

                        <?php
                        $curr_symbol = Yii::app()->params['dc_symbol'];
                        $rate = '1';
                        if (!Yii::app()->user->isGuest) {
                            $curr_symbol = Yii::app()->user->getState('currency_symbol');
                            $rate = Yii::app()->user->getState('currency_rate');
                        }
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>NAME</th>
                                    <th>PRICE</th>
                                    <th>STOCK</th>
                                    <th>DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/media/products/thumbs_266X300/<?php echo $product->main_image; ?>" class="" width="70px" height="100px" alt="" title=""/>
                                        </td>
                                        <td><?php echo $product->title; ?></td>
                                        <td>
                                            <?php echo $curr_symbol . "  " . $product->price * $rate; ?>
                                        </td>
                                        <td><?php echo $product->stock; ?></td>
                                        <td><?php echo $product->start_date; ?></td>
                                        <td class="margin10px">
                                            <a class="btn btn-follow" role="button"  data-toggle="modal"
                                               href="<?= Yii::app()->request->baseUrl; ?>/profile/editproduct/<?php echo $product->id; ?>">
                                                Edit</a>

                                            <a class="btn btn-follow"
                                               href="<?= Yii::app()->request->baseUrl; ?>/profile/deleteproduct/<?php echo $product->id; ?>">
                                                Delete</a>
                                            <?php
                                            $str = "Activate";
                                            if ($product->active)
                                                $str = 'Deactivate';
                                            ?>
                                            <a class="btn btn-follow activate" pid='<?php echo $product->id; ?>'
                                               href="javascript:void(0)"><?php echo $str; ?></a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>  
                    <?php } ?>
                </div>

            </div>		     
        </div>
    </div>
    <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="addproduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="true">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add Product</h3>
        </div>
        <form class="form-vertical">
            <div class="modal-body login_sys">
                <div class="profile_img_div">
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                </div>
                <div class="profile_img_div">
                    <label class="site site_bold">Product Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                </div>

                <div class="profile_img_div social">
                    <label class="site site_bold">Price : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
                </div>

                <div class="profile_img_div social">
                    <label class="site site_bold">Social Media : </label>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                    <input type="text" placeholder="facebook url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                    <input type="text" placeholder="twitter url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                    <input type="text" placeholder="google+ url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                    <input type="text" placeholder="youtube url ..."/></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Add</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </form>
    </div>
    <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="editproduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="true">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Edit Product</h3>
        </div>
        <form class="form-vertical">
            <div class="modal-body login_sys">
                <div class="profile_img_div">
                    <img src="<?= Yii::app()->request->baseUrl; ?>/img/x.jpg" class="profile_img"/>
                    <input type="file" class="inputf"/>
                </div>
                <div class="profile_img_div">
                    <label class="site site_bold">Product Name : </label>
                    <input type="text" placeholder="Shop name ..."/>
                </div>

                <div class="profile_img_div social">
                    <label class="site site_bold">Price : </label>
                    <textarea id="" name="" cols="50" role="20"></textarea>
                </div>

                <div class="profile_img_div social">
                    <label class="site site_bold">Social Media : </label>
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/facebook.png"></a>
                    <input type="text" placeholder="facebook url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""> <img src="<?= Yii::app()->request->baseUrl; ?>/img/twitter.png"></a>
                    <input type="text" placeholder="twitter url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/google.png"></a>
                    <input type="text" placeholder="google+ url ..."/></div>

                <div class="profile_img_div social">
                    <a href=""><img src="<?= Yii::app()->request->baseUrl; ?>/img/youtube.png"></a>
                    <input type="text" placeholder="youtube url ..."/></div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Save</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </form>
    </div>
