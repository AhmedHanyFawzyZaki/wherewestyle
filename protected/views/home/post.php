<?php
$this->pageTitle = Yii::app()->name . ' - ' . $post->title;
?>

<div class="row-fluid " style="margin-top:20px;">
    <div class="container body-cont">
        <div class="row-fluid item-page-home" style="margin-top:70px;">
            <div class="map" style="margin: 10px;">
                <h1 class="contitle"><?php echo $post->title; ?></h1>



                <div class="row-fluid">
                    <div class="span4">
                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/posts/<?= $post->image; ?>" />
                    </div>
                    <div class="span8">
                        <i class="site"><?php echo date('Y M d', $post->date); ?></i>
                        <p><?php echo $post->content; ?></p>

                        <div style="width: 100%;text-align: center;">
                            <button class="btn btn-block blog" id="comment_btn" style="width: 23%; padding:6px;margin-left: auto;margin-right: auto;float:right; margin-bottom:15px;">View Comments</button>
                        </div>



                    </div>

                    <div class="row-fluid view-comment" id="comment_div" <?php if($flag || Yii::app()->user->hasFlash("comment")){ echo "style='display: block !important;'"; } ?>>
                        <div class="span12">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if ($comments) { ?>
                                        <?php foreach ($comments as $comm) { ?>
                                            <tr>
                                                <td style="border-top:none;width: 50px;">
                                                    <?php if ($comm->user_id) { ?>
                                                        <?php if ($comm->user->image) { ?>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $comm->user->image; ?>" class="coment" />
                                                        <?php } else { ?>
                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="coment" />
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="coment" />
                                                    <?php } ?>
                                                </td>
                                                <td style="border-top:none;">
                                                    <b class="site">
                                                        <?php
                                                        if ($comm->user_id) {
                                                            echo $comm->user->username;
                                                        } else {
                                                            echo $comm->name;
                                                        }
                                                        ?>
                                                    </b>
                                                    <i class="smalltxt"><?php echo date('Y M d', $comm->date); ?></i>
                                                    <p><?php echo $comm->content; ?></p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>



                            <div class="row-fluid">
                                <div class="span12">
                                    <?php
                                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                        'id' => 'comment-form',
                                        'enableAjaxValidation' => false,
                                        'htmlOptions' => array('class' => 'form-normal top10px'),
                                    ));
                                    ?>

                                    <div class="myrow">
                                        <?php if (Yii::app()->user->hasFlash("comment")) { ?>
                                            <div class="alert alert-block success">
                                                <p><?php echo Yii::app()->user->getFlash("comment"); ?></p>
                                            </div>
                                        <?php } ?>
                                        
                                        <?php echo $form->errorSummary($model); ?>
                                        <label>Add Comment</label>
                                        <?php if (Yii::app()->user->isGuest) { ?>
                                            <input type="text" name="Comments[name]" placeholder="your name" />
                                            <input type="text" name="Comments[email]" placeholder="your email" />
                                        <?php } ?>
                                        <textarea name="Comments[content]" style="width:98%;" rows="3"></textarea>
                                    </div>

                                    <div class="myrow">
                                        <label></label>
                                        <button type="submit" class="btn blog">Submit</button>
                                    </div>

                                    <?php $this->endWidget(); ?>
                                    <div class="clear"></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

