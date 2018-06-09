<?php
Yii::app()->clientScript->registerScript('follow', "
var flag = true;
$('body').on('click','.follow2',function(){
	if(flag){
		var ths = $(this);
		var x = ths.attr('uid');
		flag = false;
		$.ajax({
			url : '".Yii::app()->request->baseUrl."/home/followuser/'+x,
			success : function(data){
				if(data != 'error'){
					ths.html(data);	
				}
				flag = true;
			}
		});	
	}
});
");
?>
<div class="row-fluid">
  	<div class="container">
  <div class="container item-page-sale">
  <div class="row-fluid shops-filterr">
  			
		    <div class="input-append filter">
            <input class="" id="appendedInputButtons" type="text">
            <button class="btn" type="button">Search</button>
            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Options
            <span class="caret"></span>
            </button>
             <ul class="dropdown-menu">
                <li><a href="#">recently updated</a></li>
                <li><a href="#">newest</a></li>
                <li><a href="#">following</a></li>
                <li><a href="#">store-wide sale</a></li>
                <li><a href="#">number of followers</a></li>
                <li><a href="#">number of transactions</a></li>
                <li><a href="#">feedback rating</a></li>
               
                </ul>
                <? echo CHtml::ajaxLink(
                      "<i class='icon-th icon-white'></i>&nbsp; Grid",
                      Yii::app()->createUrl( 'home/listfu?flag=grid'),
                      array( // ajaxOptions
                        'type' => 'POST',
                        'success' => "function( data )
                                      {
                                        // handle return data                                        
                                            document.getElementById('listing').innerHTML=data;
                                      }",
                     //   'data' => array( 'size' => 'js:$("#size_").val()', 'color' => 'js:$("#color_").val()' )
                      ),
                      array( //htmlOptions
                        'href' => Yii::app()->createUrl( 'home/listfu?flag=grid' ),
                        'class' => 'btn btn-success list',                                              
                    ));?>

                    <? echo CHtml::ajaxLink(
                      "<i class='icon-th-list icon-white'></i>&nbsp; list",
                      Yii::app()->createUrl( 'home/listfu?flag=list'),
                      array( // ajaxOptions
                        'type' => 'POST',
                        'success' => "function( data )
                                      {
                                        // handle return data
                                        document.getElementById('listing').innerHTML=data;
                                        
                                      }",
                     //   'data' => array( 'size' => 'js:$("#size_").val()', 'color' => 'js:$("#color_").val()' )
                      ),
                      array( //htmlOptions
                        'href' => Yii::app()->createUrl( 'home/listfu?flag=list' ),
                        'class' => 'btn btn-success grid',                                              
                    ));?>

            </div>
  </div>
  <div id="listing">
    
<?php $this->renderPartial('_users_grid',array('users'=>$users,)); ?> 
</div>

  