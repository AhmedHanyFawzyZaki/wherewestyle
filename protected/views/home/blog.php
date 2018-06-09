<?php
$this->pageTitle = Yii::app()->name . ' - Blog';
?>

<div class="row-fluid " style="margin-top:20px;">
    <div class="container body-cont">
        <div class="row-fluid item-page-home" style="margin-top:70px;">
            <div class="map">
                <h1 class="contitle">Blog</h1>

                <div class="row-fluid row-fluid-custom">

                    <?php if ($posts) { ?>
                        <?php foreach ($posts as $post) { ?>
                            <div class="span3 home_block">
                                <p class="header_l"><?php echo mb_substr($post->title, 0, 22); ?>...</p>
                                <a href="<?php echo Yii::app()->createUrl('home/post', array('id' => $post->id)); ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/media/posts/<?= $post->image; ?>" /></a>
                                <i class="txt"><?php echo date('d M Y'); ?></i>
                                <a href="<?php echo Yii::app()->createUrl('home/post', array('id' => $post->id)); ?>" class="btn btn-block blog">see more</a>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>



            </div>
        </div>
    </div>
</div>

<div class="row-fluid" style="font-size:18px;">
    <div class="span12">
        <div class="pagination pagination-centered">
            <div class="pagination">
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'header' => '',
                    'selectedPageCssClass' => 'active',
                    'nextPageLabel' => 'next',
                    'prevPageLabel' => 'prev',
                    'lastPageLabel' => 'last',
                    'firstPageLabel' => 'first',
                    'htmlOptions' => array('class' => 'inline_ul control_dir float_r'),
                ));
                ?>
            </div>
        </div>
    </div>
</div>