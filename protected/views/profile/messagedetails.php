<?php
$this->pageTitle = Yii::app()->name . ' - Message';
?>

<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <h4>Sender : <span class="site"><?php echo $message->sender->username; ?></span></h4>
                    <h4>Date : <span class="site"><?php echo date('M j , Y', $message->date); ?></span></h4>

                    <table class="table">
                        <thead>
                        </thead>
                        <tbody>                                     
                            <tr>
                                <td style="width: 60px;">
                                    <?php if (!$message->sender->image) { ?>
                                        <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="msg_user"/>
                                    <?php } else { ?>
                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $message->sender->image; ?>" class="msg_user"/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="msg_txt"><?php echo $message->content; ?></span>
                                </td>
                            </tr>
                            <?php if ($replies) { ?>
                                <?php foreach ($replies as $reply) { ?>
                                    <tr>
                                        <td>
                                            <?php if (!$reply->sender->image) { ?>
                                                <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="msg_user"/>
                                            <?php } else { ?>
                                                <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $reply->sender->image; ?>" class="msg_user"/>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="msg_txt"><?php echo $reply->content; ?></span>
                                        </td>
                                    </tr>   
                                <?php } ?> 
                            <?php } ?>                     
                        </tbody>
                    </table>  

                    <div class="profile_img_div">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'reply-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array(
                                'class' => 'form-vertical',
                            ),
                        ));
                        ?>		
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $form->textArea($new, 'content', array('id' => "inputmsg", 'cols' => '50', 'role' => '20', 'class' => 'width300px')); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-follow" ><i class="icon-white icon-comment"></i> Reply</button>
                            </div>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>



                    <div class="profile_img_div">
                        <a class="btn btn-follow" style="float:right;"
                           href="<?= Yii::app()->request->baseUrl; ?>/profile/messages">
                            <i class="icon-white icon-repeat"></i>
                            Back</a>
                    </div>

                </div>

            </div>		     
        </div>
    </div>

            <!--============================================ modal===================================================-->
    <!-- Modal -->
    <div id="contactSeller" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
         aria-hidden="true">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Contact seller</h3>
        </div>
        <form class="form-vertical">
            <div class="modal-body login_sys">
                <div class="control-group">
                    <label class="control-label" for="inputtxt">Subject</label>
                    <div class="controls">
                        <input id="inputtxt" type="text"  name=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputmsg">Subject</label>
                    <div class="controls">
                        <textarea id="inputmsg" name="" cols="50" role="20"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-follow" >Send</button>
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </form>
    </div>