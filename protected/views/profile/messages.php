<?php
$this->pageTitle = Yii::app()->name . ' - Messages';
?>


<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo Yii::app()->user->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <?php if ($messages) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>DATE</th>
                                    <th>SENDER</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $message) { ?>
                                    <?php
                                    $class = "";
                                    if ($message->status == '0') {
                                        $class = 'class="activetr"';
                                    }
                                    ?>
                                    <tr <?php echo $class; ?>>
                                        <td><?php echo date("M j , Y", $message->date); ?></td>
                                        <td><?php echo $message->sender->username; ?></td>
                                        <td><a class="btn btn-follow"
                                               href="<?= Yii::app()->request->baseUrl; ?>/profile/viewmessage/<?php echo $message->id; ?>"><i class="icon-white icon-eye-open"></i> View</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-follow" href="<?= Yii::app()->request->baseUrl; ?>/profile/deletemessage/<?php echo $message->id; ?>"><i class="icon-white icon-remove"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>  
                    <?php } else { ?>
                        <h4>Sorry, you have no messages.</h4>
                    <?php } ?>
                </div>

            </div>		     
        </div>
    </div>

