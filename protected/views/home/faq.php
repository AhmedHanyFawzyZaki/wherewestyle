<?php
$this->pageTitle = Yii::app()->name . ' - FAQ';
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">
            <div class="row-fluid faq">  


                <div class="page-header">
                    <h2 class="site">FAQ</h2>
                    <p><?php echo Yii::app()->params['faq_intro']; ?></p>
                </div>

                <div class="accordion" id="accordion2">
					<?php if($faqs){ ?>
                    <?php $i=0; ?>
                    <?php foreach($faqs as $faq){ ?>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class=" accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo $i; ?>">
                                <b class="arrow_bold">&darr;&nbsp;</b><?php echo $faq->question; ?>
                            </a>
                        </div>
                        <div id="collapse_<?php echo $i; ?>" class="accordion-body collapse <?php if($i=='0'){ echo'in'; }else{ echo ''; } ?>">
                            <div class="accordion-inner"><?php echo $faq->answer; ?></div>
                        </div>
                    </div>
                    <?php $i++; ?>
                    <?php } ?>
					<?php } ?>

                </div>



            </div>
        </div>	     
    </div>
</div>