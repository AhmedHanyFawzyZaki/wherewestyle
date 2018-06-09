<?php
$this->pageTitle = Yii::app()->name . ' - ' . $pages->title;
?>

<?php
Yii::app()->clientScript->registerScript('help','
    if($(".blk_sp").first().size() > 0){
        $(".blk_sp").hide();
        $(".blk_sp").first().show();
    }
    $("body").on("click",".blk",function(){
        var x = $(this).attr("blk");
        $(".blk_sp").hide();
        $("#hp_"+x).show();
    });
');
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid">    
                <div class="map">
                    <h3 class="contitle"><?= $pages->title; ?></h3>
                    <?php echo $pages->details; ?>
                </div>


            </div>

        </div>

    </div>