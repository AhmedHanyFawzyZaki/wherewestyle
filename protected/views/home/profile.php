<div class="row-fluid">
<div class="container body-cont">
<div class="item-page">
<div class="row-fluid">    
<h3 class="contitle">User Profile</h3>

    <div class="well">
    <ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
    <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
    <div class="tab-pane active in" id="home">

        <?php
            if(Yii::app()->user->hasFlash('success') )
            {
                ?>

                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Notification !</strong> <?php echo Yii::app()->user->getFlash('success'); ?>.
                </div>

                <?

            }
        ?>

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'user-form',
            'enableAjaxValidation'=>true,            
            'htmlOptions' => array('id'=>'tab'),    
            )); 
        ?>
            <?php echo $form->errorSummary($user); ?>

            <label>Username</label>            
            <?php echo $form->textField($user,'username',array('class'=>'input-xlarge')); ?>

            <label>First Name</label>        
            <?php echo $form->textField($user,'fname',array('class'=>'input-xlarge')); ?>

            <label>Last Name</label>
            <?php echo $form->textField($user,'lname',array('class'=>'input-xlarge')); ?>

            <label>Email</label>
            <?php echo $form->textField($user,'email',array('class'=>'input-xlarge')); ?>

            <label>Address</label>
            <?php echo $form->textArea($user_details,'address',array('class'=>'input-xlarge')); ?>

        
        <div>
        <button type="submit" class="btn btn-primary btn-follow">Update</button>
        </div>
    <?php $this->endWidget(); ?>
    </div>
    <div class="tab-pane fade" id="profile">
    
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'user-form',
        'enableAjaxValidation'=>true,   
        'action'=>$this->createUrl('home/ChangePassword'),         
        'htmlOptions' => array(),    
        )); 
    ?>
            <?php echo $form->errorSummary($user); ?>
            <label>New Password</label>            
            <?php echo $form->passwordField($user,'newpassword',array('class'=>'input-xlarge')); ?>

            <label>Confirm Password</label>            
            <?php echo $form->passwordField($user,'newpassword_repeat',array('class'=>'input-xlarge')); ?>
        
        <div>
            <button type="submit" class="btn btn-primary btn-follow">Update</button>
        </div>
    <?php $this->endWidget(); ?>
    </div>
    </div>

</div>
		     
</div>

</div>