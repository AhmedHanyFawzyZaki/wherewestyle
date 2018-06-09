<?php
$this->pageTitle = Yii::app()->name . ' - Profile';
?>

<?php
Yii::app()->clientScript->registerScript('inv', '
var flag = true;
var url = "https://www.facebook.com/dialog/apprequests?app_id=409482105858611&message=wherewestyle%20is%20a%20cool%20shopping%20site!&redirect_uri='.Yii::app()->request->getBaseUrl('webroot').'/profile";
$("#ch_all").click(function(){
    if(flag){
        $(".inv_fr").prop("checked", true);
        flag = false;                                
    }else{
        $(".inv_fr").prop("checked", false);
        flag = true;                         
    }
    var ids = new Array();
    var x = $(".inv_fr:checked");
    for(i=0;i<x.size();i++){
        ids[i] = x.attr("id");
    }
    $("#inv_now").attr("href",url + "&to="+ids.join(","));
});

$(".inv_fr").change(function(){
    var ids = new Array();
    var x = $(".inv_fr:checked");
    for(i=0;i<x.size();i++){
        ids[i] = x.attr("id");
    }
    $("#inv_now").attr("href",url + "&to="+ids.join(","));
});



var gm_flag = true;
$("#ch_all_gm").click(function(){
    if(gm_flag){
        $(".inv_fr_gm").prop("checked", true);
        gm_flag = false;                                
    }else{
        $(".inv_fr_gm").prop("checked", false);
        gm_flag = true;                         
    }
});

$("#inv_now_gm").click(function(){
    var x = $(".inv_fr_gm:checked");
    if(x.size() > 0){
        $("#gm_form").submit();
    }else{
        alert("you must select friends to invite");
    }
});
');
?>





<div class="row-fluid">
    <div class="container body-cont">
        <div class="item-page">  
            <h3 class="contitle lspace">Welcome <a href="<?= Yii::app()->request->baseUrl; ?>/home/user/<?php echo $model->username; ?>" class="site capitalize"><?= Yii::app()->user->username; ?></a></h3>
            <div class="row-fluid">

                <?php //$this->renderPartial('profile_sidebar'); ?>

                <div class="span12">
                    <div class="profile_img_div"  style="width:230px !important;float: left">

                        <?php if (!$model->image) { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/img/user.png" class="profile_img"/>
                        <?php } else { ?>
                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/members/thumbs_266X300/<?php echo $model->image; ?>" class="profile_img"/>
                        <?php } ?>
                    </div>
                    
                    <div style="width:750px ;float: left">
                    <div class="profile_img_div">
                        <label class="site" style="font-weight: normal !important;">Full Name: </label>
                        <label style="font-weight: normal !important;"><?php echo $model->fname . " " . $model->lname; ?></label>
                    </div>
                    
                    <div class="profile_img_div social">
                        <label class="site" style="font-weight: normal !important;">Email: </label>
                        <label style="font-weight: normal !important;"><?php echo $model->email; ?></label>
                    </div>

                    <div class="profile_img_div">
                        <label class="site" style="font-weight: normal !important;">Username: </label>
                        <label style="font-weight: normal !important;"><?php echo $model->username; ?></label>
                    </div>

                    <div class="profile_img_div">
                        <label class="site" style="font-weight: normal !important;">Account Type: </label>
                        <label style="font-weight: normal !important;"><?php echo $model->usergroup->group_title; ?></label>
                    </div>
                    
                    </div>


                </div>

            </div>         
        </div>
    </div>